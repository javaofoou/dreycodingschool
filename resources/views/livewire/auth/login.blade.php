<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) return;

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-10">

    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-200">

        {{-- HEADER --}}
        <div class="bg-hero-gradient px-6 py-8 text-center text-white">
            <h1 class="text-2xl font-bold">Welcome Back 👋</h1>
            <p class="mt-2 text-sm text-purple-100">
                Log in to continue your learning journey
            </p>
        </div>

        {{-- BODY --}}
        <div class="px-6 py-8">

            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form wire:submit="login" class="space-y-5">

                {{-- EMAIL --}}
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
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="input-field"
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="relative">
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

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="absolute right-0 top-0 text-xs font-medium text-brand-primary hover:underline"
                        >
                            Forgot?
                        </a>
                    @endif

                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- REMEMBER --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" wire:model="remember" class="rounded border-gray-300">
                        Remember me
                    </label>
                </div>

                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="btn-brand-gradient w-full rounded-full px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                >
                    Log In
                </button>

            </form>

            {{-- FOOTER --}}
            <p class="mt-6 text-center text-sm text-gray-600">
                Don’t have an account?
                <a href="{{ route('register') }}" class="font-semibold text-brand-primary hover:underline" wire:navigate>
                    Sign up
                </a>
            </p>

        </div>

    </div>

</div>
