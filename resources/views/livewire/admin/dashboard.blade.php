<?php

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\ProjectRequest;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\User;
use function Livewire\Volt\{layout, state};

layout('components.layouts.app');

state([
    'courseCount' => Course::count(),
    'paymentCount' => Payment::count(),
    'enrollmentCount' => Enrollment::count(),
    'projectRequestCount' => ProjectRequest::count(),
    'testimonialCount' => Testimonial::count(),
    'studentCount' => User::count(),
    'faqCount' => Faq::count(),
    'recentPayments' => Payment::with(['user', 'course'])->latest()->take(5)->get(),
    'recentProjectRequests' => ProjectRequest::latest()->take(5)->get(),
]);

?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="mt-2 text-sm text-gray-600">
            Manage your school platform, students, payments, and client requests.
        </p>
    </div>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-sm font-medium text-gray-500">Courses</h2>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ $this->courseCount }}</p>
        </div>
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-sm font-medium text-gray-500">Payments</h2>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ $this->paymentCount }}</p>
        </div>
        
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
    <h2 class="text-sm font-medium text-gray-500">Students</h2>
    <p class="mt-3 text-3xl font-bold text-gray-900">{{ $this->studentCount }}</p>
</div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-sm font-medium text-gray-500">Enrollments</h2>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ $this->enrollmentCount }}</p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-sm font-medium text-gray-500">Project Requests</h2>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ $this->projectRequestCount }}</p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-sm font-medium text-gray-500">Testimonials</h2>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ $this->testimonialCount }}</p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <h2 class="text-sm font-medium text-gray-500">FAQs</h2>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ $this->faqCount }}</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-8 xl:grid-cols-2">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Recent Payments</h2>
                <a href="{{ route('admin.payments.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700" wire:navigate>
                    View all
                </a>
            </div>

            <div class="space-y-4">
                @forelse ($this->recentPayments as $payment)
                    <div class="rounded-2xl border border-gray-200 p-4">
                        <p class="font-semibold text-gray-900">{{ $payment->user->name ?? 'Unknown User' }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ $payment->course->title ?? 'Unknown Course' }}</p>
                        <p class="mt-1 text-sm text-gray-600">₦{{ number_format($payment->amount, 0) }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ ucfirst($payment->status) }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-600">No payments yet.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Recent Project Requests</h2>
                <a href="{{ route('admin.project-requests.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700" wire:navigate>
                    View all
                </a>
            </div>

            <div class="space-y-4">
                @forelse ($this->recentProjectRequests as $request)
                    <div class="rounded-2xl border border-gray-200 p-4">
                        <p class="font-semibold text-gray-900">{{ $request->full_name }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ $request->project_type }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ $request->email }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ ucfirst($request->status) }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-600">No project requests yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>