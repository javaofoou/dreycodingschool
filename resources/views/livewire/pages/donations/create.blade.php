<?php

use function Livewire\Volt\{layout};

layout('components.layouts.auth.simple');

?>

<div class="min-h-screen bg-gray-50">

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-hero-gradient text-white">
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-72 w-72 rounded-full bg-pink-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.3em] text-purple-200">
                    Support DreyCoding School
                </p>

                <h1 class="text-4xl font-extrabold sm:text-5xl">
                    Donate & Support the Platform ❤️
                </h1>

                <p class="mt-5 text-purple-100 text-base sm:text-lg">
                    Your support helps us train more developers, improve resources, and grow our tech community.
                </p>
            </div>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            <x-flash-messages />

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                {{-- LEFT --}}
                <div class="rounded-3xl bg-white/80 backdrop-blur p-6 shadow-lg ring-1 ring-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900">Why Donate?</h2>

                    <div class="mt-5 space-y-4 text-sm text-gray-600">
                        <p>Your support helps us grow and empower more developers.</p>

                        <ul class="space-y-3">
                            <li>✔ Improve learning resources</li>
                            <li>✔ Build better platform features</li>
                            <li>✔ Support student growth</li>
                            <li>✔ Expand tech community</li>
                        </ul>
                    </div>

                    <div class="mt-6 rounded-2xl bg-purple-50 p-4 text-sm text-brand-primary">
                        Every donation counts 💜
                    </div>
                </div>

                {{-- FORM --}}
                <div class="lg:col-span-2 rounded-3xl bg-white p-6 shadow-xl ring-1 ring-gray-200 sm:p-8">

                    <h2 class="text-2xl font-bold text-gray-900">Donation Form</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Fill the form below to support the platform.
                    </p>

                    <form method="POST" action="{{ route('donations.initialize') }}" class="mt-8 space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <input name="full_name" type="text" value="{{ old('full_name') }}"
                                placeholder="Full Name"
                                class="input-field">
                            @error('full_name') <p class="error">{{ $message }}</p> @enderror

                            <input name="email" type="email" value="{{ old('email') }}"
                                placeholder="Email Address"
                                class="input-field">
                            @error('email') <p class="error">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Select Amount (₦)
                            </label>

                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                                @foreach ([1000, 2000, 5000, 10000] as $amt)
                                    <button type="button"
                                        onclick="document.querySelector('input[name=amount]').value={{ $amt }}"
                                        class="rounded-xl border border-gray-300 px-4 py-2 text-sm font-semibold hover:bg-purple-50">
                                        ₦{{ number_format($amt) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <input name="amount" type="number" min="1" value="{{ old('amount') }}"
                            placeholder="Custom Amount"
                            class="input-field">
                        @error('amount') <p class="error">{{ $message }}</p> @enderror

                        <textarea name="message" rows="5"
                            placeholder="Optional message..."
                            class="input-field">{{ old('message') }}</textarea>
                        @error('message') <p class="error">{{ $message }}</p> @enderror

                        <button
                            type="submit"
                            class="btn-brand-gradient w-full rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5">
                            Donate Now
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </section>
</div>