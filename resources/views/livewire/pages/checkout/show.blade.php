<?php

use App\Models\Course;
use function Livewire\Volt\{layout, state};

layout('components.layouts.app');

state([
    'course' => fn () => Course::where('slug', request()->route('slug'))
        ->where('is_active', true)
        ->firstOrFail(),
]);

?>

<div class="min-h-screen bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="mt-2 text-sm text-gray-600">
                Review your selected course before proceeding to payment.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <div class="lg:col-span-2 rounded-3xl bg-white p-6 shadow-lg ring-1 ring-gray-200 sm:p-8">
                <div class="flex flex-col gap-6 sm:flex-row">
                    <div class="h-48 w-full overflow-hidden rounded-2xl bg-gray-100 sm:w-64">
                        @if ($this->course->image)
                            <img
                                src="{{ $this->course->image }}"
                                alt="{{ $this->course->title }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="flex h-full items-center justify-center bg-gradient-to-br from-purple-100 to-orange-50 text-sm font-medium text-gray-500">
                                No course image
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $this->course->title }}</h2>

                            <span class="rounded-full bg-purple-100 px-4 py-2 text-sm font-semibold text-brand-primary">
                                ₦{{ number_format($this->course->price, 0) }}
                            </span>
                        </div>

                        <p class="mt-3 text-sm leading-6 text-gray-600">
                            {{ $this->course->short_description }}
                        </p>

                        <div class="mt-5 flex flex-wrap gap-3">
                            @if($this->course->duration)
                                <span class="rounded-full bg-gray-100 px-4 py-2 text-sm text-gray-700">
                                    ⏱ {{ $this->course->duration }}
                                </span>
                            @endif

                            @if($this->course->level)
                                <span class="rounded-full bg-gray-100 px-4 py-2 text-sm text-gray-700">
                                    🎯 {{ $this->course->level }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-8 rounded-2xl border border-purple-100 bg-purple-50 p-5">
                    <h3 class="text-lg font-semibold text-gray-900">Important Notice</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-700">
                        After successful payment, your registration will be confirmed and you will be contacted through your WhatsApp number and email address for class updates and group access.
                    </p>
                </div>

                <div class="mt-6 rounded-2xl border border-green-200 bg-green-50 p-5">
                    <h3 class="text-lg font-semibold text-gray-900">What happens next?</h3>
                    <ul class="mt-3 space-y-2 text-sm text-gray-700">
                        <li>✔ Your payment will be processed securely via Paystack</li>
                        <li>✔ Your enrollment will be recorded automatically</li>
                        <li>✔ You’ll receive further class instructions after confirmation</li>
                    </ul>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-lg ring-1 ring-gray-200 sm:p-8">
                <h3 class="text-xl font-bold text-gray-900">Order Summary</h3>

                <div class="mt-6 space-y-4 text-sm text-gray-700">
                    <div class="flex items-center justify-between gap-4 border-b border-gray-100 pb-4">
                        <span>Course</span>
                        <span class="max-w-[180px] text-right font-medium text-gray-900">
                            {{ $this->course->title }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-4 border-b border-gray-100 pb-4">
                        <span>Price</span>
                        <span class="font-medium text-gray-900">
                            ₦{{ number_format($this->course->price, 0) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-4 text-base">
                        <span class="font-semibold text-gray-900">Total</span>
                        <span class="text-lg font-bold text-brand-primary">
                            ₦{{ number_format($this->course->price, 0) }}
                        </span>
                    </div>
                </div>

                <div class="mt-8 space-y-3">
                    <form method="POST" action="{{ route('payment.initialize', $this->course->slug) }}">
                        @csrf

                        <button
                            type="submit"
                            class="btn-brand-gradient inline-flex w-full items-center justify-center rounded-full px-4 py-3 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5"
                        >
                            Proceed to Paystack
                        </button>
                    </form>

                    <a
                        href="{{ route('courses.show', $this->course->slug) }}"
                        class="inline-flex w-full items-center justify-center rounded-full border border-gray-300 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        wire:navigate
                    >
                        Back to Course
                    </a>
                </div>

                <div class="mt-6 rounded-2xl bg-gray-50 p-4 text-sm text-gray-600">
                    Secure payment powered by
                    <span class="font-semibold text-gray-900">Paystack</span>.
                </div>
            </div>

        </div>
    </div>
</div>