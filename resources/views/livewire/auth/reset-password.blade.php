<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->string('email');
    }

    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PasswordReset) {
            $this->addError('email', __($status));
            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-10">
    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-200">

        <div class="bg-hero-gradient px-6 py-8 text-center text-white">
            <h1 class="text-2xl font-bold">Reset Password</h1>
            <p class="mt-2 text-sm text-purple-100">
                Please enter your new password below
            </p>
        </div>

        <div class="px-6 py-8">
            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form wire:submit="resetPassword" class="space-y-5">

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <input
                        wire:model="email"
                        id="email"
                        type="email"
                        name="email"
                        required
                        autocomplete="email"
                        class="input-field"
                        placeholder="Enter your email"
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
                        New Password
                    </label>
                    <input
                        wire:model="password"
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="input-field"
                        placeholder="Enter new password"
                    >
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <input
                        wire:model="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="input-field"
                        placeholder="Confirm new password"
                    >
                    @error('password_confirmation')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="btn-brand-gradient w-full rounded-full px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                >
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</div>
