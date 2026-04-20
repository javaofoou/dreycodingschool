<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4">

    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-200">

        {{-- HEADER --}}
        <div class="bg-hero-gradient px-6 py-8 text-center text-white">
            <h1 class="text-2xl font-bold">Verify Your Email</h1>
            <p class="mt-2 text-sm text-purple-100">
                Secure your account to continue
            </p>
        </div>

        {{-- BODY --}}
        <div class="px-6 py-8">

            <div class="text-center text-sm text-gray-600">
                Please verify your email address by clicking the link we sent to your email.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mt-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-center text-sm text-green-700">
                    A new verification link has been sent to your email.
                </div>
            @endif

            <div class="mt-6 space-y-3">

                <button
                    wire:click="sendVerification"
                    class="btn-brand-gradient w-full rounded-full px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                >
                    Resend Verification Email
                </button>

                <button
                    wire:click="logout"
                    type="button"
                    class="w-full rounded-full border border-gray-300 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Log Out
                </button>

            </div>

        </div>

    </div>

</div>
