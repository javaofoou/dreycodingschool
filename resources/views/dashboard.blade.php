<x-layouts.app :title="__('Dashboard')">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- ALERTS --}}
        @if (session('success'))
            <div class="mb-4 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- PROFILE CARD --}}
        <div class="rounded-3xl bg-hero-gradient p-6 text-white shadow-xl sm:p-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center">
                <div class="shrink-0">
                    @if(auth()->user()->profile_image)
                        <img
                            src="{{ auth()->user()->profile_image }}"
                            class="h-24 w-24 rounded-full object-cover ring-4 ring-white/30"
                        >
                    @else
                        <div class="flex h-24 w-24 items-center justify-center rounded-full bg-white/20 text-2xl font-bold">
                            {{ auth()->user()->initials() }}
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <h1 class="text-2xl font-bold sm:text-3xl">
                        Welcome, {{ auth()->user()->name }}
                    </h1>

                    <div class="mt-3 space-y-1 text-sm text-purple-100 sm:text-base">
                        <p><span class="font-semibold text-white">Email:</span> {{ auth()->user()->email }}</p>
                        <p><span class="font-semibold text-white">WhatsApp:</span> {{ auth()->user()->whatsapp_number }}</p>
                        <p><span class="font-semibold text-white">Role:</span> {{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- GRID --}}
        <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- COURSES --}}
            <div class="xl:col-span-2 rounded-3xl bg-white p-6 shadow-lg ring-1 ring-gray-200">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">My Courses</h2>
                </div>

                @php
                    $enrollments = auth()->user()->enrollments()->with(['course', 'payment'])->latest()->get();
                @endphp

                @if ($enrollments->count())
                    <div class="space-y-4">
                        @foreach ($enrollments as $enrollment)
                            <div class="rounded-2xl border border-gray-200 p-5 transition hover:shadow-md">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $enrollment->course->title ?? 'Course not found' }}
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-600">
                                            Status:
                                            <span class="ml-1 rounded-full bg-purple-100 px-2 py-1 text-xs font-semibold text-brand-primary">
                                                {{ ucfirst($enrollment->status) }}
                                            </span>
                                        </p>

                                        <p class="mt-1 text-sm text-gray-600">
                                            WhatsApp Group:
                                            <span class="font-medium text-brand-primary">
                                                {{ $enrollment->added_to_whatsapp_group ? 'Joined' : 'Pending' }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="text-sm text-gray-600">
                                        <p><span class="font-semibold text-gray-800">Amount:</span>
                                            ₦{{ number_format($enrollment->payment->amount ?? 0, 0) }}
                                        </p>
                                        <p class="mt-1">
                                            <span class="font-semibold text-gray-800">Date:</span>
                                            {{ $enrollment->created_at->format('d M Y') }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl border border-dashed border-gray-300 p-6 text-center">
                        <p class="text-sm text-gray-600">You have not enrolled in any course yet.</p>
                    </div>
                @endif
            </div>

            {{-- PAYMENTS --}}
            <div class="rounded-3xl bg-white p-6 shadow-lg ring-1 ring-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Payment History</h2>

                @php
                    $payments = auth()->user()->payments()->with('course')->latest()->get();
                @endphp

                @if ($payments->count())
                    <div class="mt-5 space-y-4">
                        @foreach ($payments as $payment)
                            <div class="rounded-2xl border border-gray-200 p-4 transition hover:shadow-md">

                                <h3 class="font-semibold text-gray-900">
                                    {{ $payment->course->title ?? 'Course not found' }}
                                </h3>

                                <p class="mt-2 text-sm text-gray-600">
                                    Amount: ₦{{ number_format($payment->amount, 0) }}
                                </p>

                                <p class="mt-1 text-sm text-gray-600">
                                    Ref: {{ $payment->reference }}
                                </p>

                                <p class="mt-1 text-sm text-gray-600">
                                    Status:
                                    <span class="ml-1 rounded-full bg-purple-100 px-2 py-1 text-xs font-semibold text-brand-primary">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </p>

                                <p class="mt-1 text-sm text-gray-600">
                                    Paid At:
                                    {{ $payment->paid_at ? $payment->paid_at->format('d M Y h:i A') : 'Not available' }}
                                </p>

                                <div class="mt-3">
                                    <a
                                        href="{{ route('receipts.show', $payment->reference) }}"
                                        class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-4 py-2 text-xs font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                                        wire:navigate
                                    >
                                        View Receipt
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="mt-5 rounded-2xl border border-dashed border-gray-300 p-6 text-center">
                        <p class="text-sm text-gray-600">No payment history yet.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-layouts.app>