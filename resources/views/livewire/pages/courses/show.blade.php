<?php

use App\Models\Course;
use function Livewire\Volt\{layout, state};

layout('components.layouts.auth.simple');

state([
    'slug' => request()->route('slug'),
    'course' => fn () => Course::where('slug', request()->route('slug'))
        ->where('is_active', true)
        ->firstOrFail(),
]);

?>

<div class="min-h-screen bg-gray-50">

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-hero-gradient text-white">
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-72 w-72 rounded-full bg-pink-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">

            <a
                href="{{ route('courses.index') }}"
                class="inline-flex items-center text-sm text-purple-200 hover:text-white"
                wire:navigate
            >
                ← Back to Courses
            </a>

            <div class="mt-8 grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-center">

                {{-- LEFT --}}
                <div>
                    <p class="mb-3 text-sm font-semibold uppercase tracking-[0.3em] text-purple-200">
                        Course Details
                    </p>

                    <h1 class="text-4xl font-extrabold sm:text-5xl">
                        {{ $this->course->title }}
                    </h1>

                    <p class="mt-5 text-purple-100 text-base sm:text-lg">
                        {{ $this->course->short_description }}
                    </p>

                    {{-- TAGS --}}
                    <div class="mt-6 flex flex-wrap gap-3">
                        <span class="rounded-full bg-white/10 px-4 py-2 text-sm font-medium">
                            ₦{{ number_format($this->course->price, 0) }}
                        </span>

                        @if($this->course->duration)
                            <span class="rounded-full bg-white/10 px-4 py-2 text-sm font-medium">
                                ⏱ {{ $this->course->duration }}
                            </span>
                        @endif

                        @if($this->course->level)
                            <span class="rounded-full bg-white/10 px-4 py-2 text-sm font-medium">
                                🎯 {{ $this->course->level }}
                            </span>
                        @endif
                    </div>

                    {{-- CTA --}}
                    <div class="mt-8 flex flex-col gap-4 sm:flex-row">

                        @auth
                            <a
                                href="{{ route('checkout.show', $this->course->slug) }}"
                                class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5"
                                wire:navigate
                            >
                                Enroll Now
                            </a>
                        @else
                            <a
                                href="{{ route('register', ['course' => $this->course->slug]) }}"
                                class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5"
                                wire:navigate
                            >
                                Register to Enroll
                            </a>
                        @endauth

                    </div>

                </div>

                {{-- IMAGE --}}
                <div class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-white/10">
                    @if ($this->course->image)
                        <img
                            src="{{ $this->course->image }}"
                            alt="{{ $this->course->title }}"
                            class="h-[340px] w-full object-cover"
                        >
                    @else
                        <div class="flex h-[340px] items-center justify-center bg-gradient-to-br from-purple-100 to-orange-50 text-sm font-medium text-gray-500">
                            No course image
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- DETAILS --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                {{-- DESCRIPTION --}}
                <div class="lg:col-span-2 rounded-3xl bg-white p-6 shadow-lg ring-1 ring-gray-200 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-900">About this course</h2>

                    <div class="mt-4 text-sm leading-7 text-gray-600 sm:text-base">
                        {!! nl2br(e($this->course->full_description ?: $this->course->short_description)) !!}
                    </div>
                </div>

                {{-- SIDEBAR --}}
                <div class="rounded-3xl bg-white p-6 shadow-lg ring-1 ring-gray-200 sm:p-8">

                    <h3 class="text-xl font-bold text-gray-900">Ready to begin?</h3>

                    <p class="mt-3 text-sm text-gray-600">
                        Register, make payment, and get added to your WhatsApp training group.
                    </p>

                    <div class="mt-6 space-y-3">

                        <a
                            href="{{ route('register') }}"
                            class="btn-brand-gradient inline-flex w-full items-center justify-center rounded-full px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                            wire:navigate
                        >
                            Register Now
                        </a>

                        <a
                            href="https://wa.me/2349024686942?text=Hello%20I%20want%20to%20make%20an%20inquiry%20about%20{{ urlencode($this->course->title) }}"
                            target="_blank"
                            class="inline-flex w-full items-center justify-center rounded-full border border-green-500 px-4 py-3 text-sm font-semibold text-green-600 transition hover:bg-green-50"
                        >
                            Ask on WhatsApp
                        </a>

                    </div>

                    {{-- TRUST BOX --}}
                    <div class="mt-6 rounded-2xl bg-purple-50 p-4 text-sm text-brand-primary">
                        ✔ Beginner Friendly <br>
                        ✔ Practical Training <br>
                        ✔ Certificate Included
                    </div>

                </div>

            </div>

        </div>
    </section>
</div>