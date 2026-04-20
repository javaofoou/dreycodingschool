<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-10">

    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-200">

        {{-- HEADER --}}
        <div class="bg-hero-gradient px-6 py-8 text-center text-white">
            <h1 class="text-2xl font-bold">Confirm Password 🔒</h1>
            <p class="mt-2 text-sm text-purple-100">
                This is a secure area. Please confirm your password.
            </p>
        </div>

        {{-- BODY --}}
        <div class="px-6 py-8">

            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form wire:submit="confirmPassword" class="space-y-5">

                {{-- PASSWORD --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">
                        Password
                    </label>

                    <input
                        wire:model="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="input-field"
                    >

                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="btn-brand-gradient w-full rounded-full px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                >
                    Confirm Password
                </button>

            </form>

        </div>

    </div>

</div>