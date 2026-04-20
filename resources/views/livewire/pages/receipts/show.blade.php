<?php

use App\Models\Payment;
use function Livewire\Volt\{layout, state};

layout('components.layouts.app');

state([
    'payment' => fn () => Payment::with(['course', 'user'])
        ->where('reference', request()->route('reference'))
        ->where('user_id', auth()->id())
        ->firstOrFail(),
]);

?>

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Payment Receipt</h1>
                <p class="mt-1 text-sm text-gray-600">
                    Receipt for your course payment
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center justify-center rounded-full border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                wire:navigate
            >
                Back to Dashboard
            </a>
        </div>

        {{-- RECEIPT CARD --}}
        <div class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-200">

            {{-- TOP BRAND BAR --}}
            <div class="bg-hero-gradient px-6 py-6 text-white sm:px-8">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold">DreyCoding School</h2>
                        <p class="text-sm text-purple-100">Course Payment Receipt</p>
                    </div>

                    <div class="text-sm text-purple-100">
                        <p><span class="font-semibold text-white">Ref:</span> {{ $this->payment->reference }}</p>
                        <p class="mt-1">
                            <span class="font-semibold text-white">Date:</span>
                            {{ $this->payment->paid_at ? $this->payment->paid_at->format('d M Y, h:i A') : $this->payment->created_at->format('d M Y, h:i A') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="p-6 sm:p-8">

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                    {{-- STUDENT --}}
                    <div class="rounded-2xl bg-gray-50 p-5">
                        <h3 class="text-lg font-semibold text-gray-900">Student Details</h3>

                        <div class="mt-3 space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium text-gray-800">Name:</span> {{ $this->payment->user->name }}</p>
                            <p><span class="font-medium text-gray-800">Email:</span> {{ $this->payment->user->email }}</p>
                            <p><span class="font-medium text-gray-800">WhatsApp:</span> {{ $this->payment->user->whatsapp_number }}</p>
                        </div>
                    </div>

                    {{-- PAYMENT --}}
                    <div class="rounded-2xl bg-gray-50 p-5">
                        <h3 class="text-lg font-semibold text-gray-900">Payment Details</h3>

                        <div class="mt-3 space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium text-gray-800">Course:</span> {{ $this->payment->course->title }}</p>

                            <p><span class="font-medium text-gray-800">Amount:</span>
                                <span class="font-bold text-brand-primary text-base">
                                    ₦{{ number_format($this->payment->amount, 0) }}
                                </span>
                            </p>

                            <p><span class="font-medium text-gray-800">Method:</span> {{ ucfirst($this->payment->payment_method) }}</p>

                            <p>
                                <span class="font-medium text-gray-800">Status:</span>
                                <span class="ml-1 rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">
                                    {{ ucfirst($this->payment->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                </div>

                {{-- SUCCESS MESSAGE --}}
                <div class="mt-8 rounded-2xl bg-green-50 p-5 border border-green-200">
                    <p class="text-sm leading-6 text-green-800">
                        This receipt confirms that your payment was successfully received by DreyCoding School.
                        You will be contacted via WhatsApp or email with further class instructions.
                    </p>
                </div>

                {{-- ACTIONS --}}
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                    <button
                        onclick="window.print()"
                        class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5"
                    >
                        Print Receipt
                    </button>

                    <a
                        href="{{ route('courses.index') }}"
                        class="inline-flex items-center justify-center rounded-full border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        wire:navigate
                    >
                        Browse Courses
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>