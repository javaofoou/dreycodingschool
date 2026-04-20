<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function initialize(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'message' => ['nullable', 'string'],
        ]);

        try {
            $reference = 'DON-' . strtoupper(Str::random(12));

            Donation::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'amount' => $validated['amount'],
                'reference' => $reference,
                'payment_method' => 'paystack',
                'status' => 'pending',
                'message' => $validated['message'] ?? null,
            ]);

            $response = Http::withToken(config('services.paystack.secret_key'))
                ->post(config('services.paystack.payment_url') . '/transaction/initialize', [
                    'email' => $validated['email'],
                    'amount' => (int) ($validated['amount'] * 100),
                    'reference' => $reference,
                    'callback_url' => route('donations.callback'),
                    'currency' => 'NGN',
                    'metadata' => [
                        'donation' => true,
                    ],
                ]);

            if (! $response->successful() || ! data_get($response->json(), 'status')) {
                return back()->with('error', 'Unable to initialize donation payment. Please try again.');
            }

            return redirect(data_get($response->json(), 'data.authorization_url'));
        } catch (\Throwable $e) {
            return back()->with('error', 'A donation error occurred. Please try again.');
        }
    }

    public function callback(Request $request)
    {
        try {
            $reference = $request->query('reference');

            if (! $reference) {
                return redirect()->route('donations.create')->with('error', 'Missing donation reference.');
            }

            $response = Http::withToken(config('services.paystack.secret_key'))
                ->get(config('services.paystack.payment_url') . '/transaction/verify/' . $reference);

            if (! $response->successful() || ! data_get($response->json(), 'status')) {
                return redirect()->route('donations.create')->with('error', 'Unable to verify donation.');
            }

            $data = data_get($response->json(), 'data');

            if (($data['status'] ?? null) !== 'success') {
                return redirect()->route('donations.create')->with('error', 'Donation payment was not successful.');
            }

            $donation = Donation::where('reference', $reference)->first();

            if (! $donation) {
                return redirect()->route('donations.create')->with('error', 'Donation record not found.');
            }

            $donation->update([
                'status' => 'success',
                'paid_at' => now(),
            ]);

            return redirect()->route('donations.create')->with('success', 'Thank you. Your donation was successful.');
        } catch (\Throwable $e) {
            return redirect()->route('donations.create')->with('error', 'An unexpected donation verification error occurred.');
        }
    }
}
