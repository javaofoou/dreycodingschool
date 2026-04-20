<?php

use App\Models\Faq;
use function Livewire\Volt\{layout, state};

layout('components.layouts.auth.simple');

state([
    'faqs' => Faq::where('is_active', true)->latest()->get(),
]);

?>

<div class="min-h-screen bg-gray-50">
    <section class="relative overflow-hidden bg-hero-gradient text-white">
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-72 w-72 rounded-full bg-pink-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.3em] text-purple-200">
                    DreyCoding School
                </p>

                <h1 class="text-4xl font-extrabold leading-tight sm:text-5xl">
                    Frequently Asked Questions
                </h1>

                <p class="mt-5 text-base text-purple-100 sm:text-lg">
                    Find answers to common questions about our courses, payments, and training process.
                </p>
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            @if ($this->faqs->count())
                <div class="space-y-5">
                    @foreach ($this->faqs as $faq)
                        <div class="rounded-3xl bg-white p-6 shadow-md ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="flex items-start gap-4">
                                <div class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-100 font-bold text-brand-primary">
                                    ?
                                </div>

                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">
                                        {{ $faq->question }}
                                    </h2>

                                    <p class="mt-3 text-sm leading-7 text-gray-600 sm:text-base">
                                        {{ $faq->answer }}
                                    </p>

                                    <div class="mt-5 h-1 w-14 rounded-full bg-gradient-to-r from-purple-500 via-pink-500 to-orange-400"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-3xl bg-white p-10 text-center shadow-md ring-1 ring-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">No FAQs available yet</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Frequently asked questions will appear here.
                    </p>
                </div>
            @endif
        </div>
    </section>
</div>