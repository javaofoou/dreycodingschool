<?php

use App\Models\Testimonial;
use function Livewire\Volt\{layout, state};

layout('components.layouts.auth.simple');

state([
    'testimonials' => Testimonial::where('is_active', true)->latest()->get(),
]);

?>

<div class="min-h-screen bg-gray-50">

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-hero-gradient text-white">
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-72 w-72 rounded-full bg-pink-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.3em] text-purple-200">
                    DreyCoding School
                </p>

                <h1 class="text-4xl font-extrabold leading-tight sm:text-5xl">
                    What Our Students Say
                </h1>

                <p class="mt-5 text-base text-purple-100 sm:text-lg">
                    Hear from our students and see how DreyCoding School is transforming lives through practical tech training.
                </p>
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if ($this->testimonials->count())

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

                    @foreach ($this->testimonials as $testimonial)

                        <div class="group rounded-3xl bg-white/80 backdrop-blur p-6 shadow-lg ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                            {{-- USER --}}
                            <div class="flex items-center gap-4">
                                <div class="shrink-0">

                                    @if ($testimonial->student_image)
                                        <img
                                            src="{{ $testimonial->student_image }}"
                                            alt="{{ $testimonial->student_name }}"
                                            class="h-16 w-16 rounded-full object-cover ring-2 ring-purple-100"
                                        >
                                    @else
                                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-purple-100 text-lg font-bold text-brand-primary">
                                            {{ strtoupper(substr($testimonial->student_name, 0, 1)) }}
                                        </div>
                                    @endif

                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">
                                        {{ $testimonial->student_name }}
                                    </h2>

                                    @if($testimonial->course_taken)
                                        <p class="text-sm font-medium text-brand-primary">
                                            {{ $testimonial->course_taken }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- COMMENT --}}
                            <p class="mt-5 text-sm leading-7 text-gray-600 sm:text-base">
                                “{{ $testimonial->comment }}”
                            </p>

                            {{-- DECORATIVE LINE --}}
                            <div class="mt-6 h-1 w-12 rounded-full bg-gradient-to-r from-purple-500 via-pink-500 to-orange-400"></div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="rounded-3xl bg-white p-10 text-center shadow-md ring-1 ring-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        No testimonials available yet
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Student testimonials will appear here.
                    </p>
                </div>

            @endif

        </div>
    </section>
</div>