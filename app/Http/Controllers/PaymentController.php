<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function initialize(Request $request, string $slug)
    {
        try {
            $user = Auth::user();

            $course = Course::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            $reference = 'DREY-' . strtoupper(Str::random(12));

            $response = Http::withToken(config('services.paystack.secret_key'))
                ->post(config('services.paystack.payment_url') . '/transaction/initialize', [
                    'email' => $user->email,
                    'amount' => (int) ($course->price * 100),
                    'reference' => $reference,
                    'callback_url' => route('payment.callback'),
                    'currency' => 'NGN',
                    'metadata' => [
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                        'course_slug' => $course->slug,
                    ],
                ]);

            if (! $response->successful() || ! data_get($response->json(), 'status')) {
                return back()->with('error', 'Unable to initialize payment. Please try again.');
            }

            return redirect(data_get($response->json(), 'data.authorization_url'));
        } catch (\Throwable $e) {
            return back()->with('error', 'A payment error occurred. Please try again.');
        }
    }

    public function callback(Request $request)
    {
        try {
            $reference = $request->query('reference');

            if (! $reference) {
                return redirect()->route('dashboard')->with('error', 'Missing payment reference.');
            }

            $response = Http::withToken(config('services.paystack.secret_key'))
                ->get(config('services.paystack.payment_url') . '/transaction/verify/' . $reference);

            if (! $response->successful() || ! data_get($response->json(), 'status')) {
                return redirect()->route('dashboard')->with('error', 'Unable to verify payment.');
            }

            $data = data_get($response->json(), 'data');

            if (($data['status'] ?? null) !== 'success') {
                return redirect()->route('dashboard')->with('error', 'Payment was not successful.');
            }

            $metadata = $data['metadata'] ?? [];
            $userId = $metadata['user_id'] ?? null;
            $courseId = $metadata['course_id'] ?? null;

            if (! $userId || ! $courseId) {
                return redirect()->route('dashboard')->with('error', 'Payment metadata is incomplete.');
            }

            $existingPayment = Payment::where('reference', $reference)->first();

            if (! $existingPayment) {
                $payment = Payment::create([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'amount' => ($data['amount'] ?? 0) / 100,
                    'reference' => $reference,
                    'payment_method' => 'paystack',
                    'status' => 'success',
                    'paid_at' => now(),
                ]);

                Enrollment::firstOrCreate(
                    [
                        'user_id' => $userId,
                        'course_id' => $courseId,
                    ],
                    [
                        'payment_id' => $payment->id,
                        'status' => 'active',
                        'added_to_whatsapp_group' => false,
                    ]
                );
            }

            return redirect()->route('dashboard')->with('success', 'Payment successful. You have been enrolled.');
        } catch (\Throwable $e) {
            return redirect()->route('dashboard')->with('error', 'An unexpected payment verification error occurred.');
        }
    }
}