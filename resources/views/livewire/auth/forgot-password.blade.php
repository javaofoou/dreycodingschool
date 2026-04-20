<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-10">
    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-200">

        <div class="bg-hero-gradient px-6 py-8 text-center text-white">
            <h1 class="text-2xl font-bold">Forgot Password?</h1>
            <p class="mt-2 text-sm text-purple-100">
                Enter your email to receive a password reset link
            </p>
        </div>

        <div class="px-6 py-8">
            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form wire:submit="sendPasswordResetLink" class="space-y-5">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <input
                        wire:model="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        placeholder="email@example.com"
                        class="input-field"
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="btn-brand-gradient w-full rounded-full px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                >
                    Email Password Reset Link
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Or, return to
                <a href="{{ route('login') }}" class="font-semibold text-brand-primary hover:underline" wire:navigate>
                    log in
                </a>
            </p>
        </div>
    </div>
</div>
