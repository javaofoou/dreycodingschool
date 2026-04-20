<?php

use App\Models\Enrollment;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public $enrollments;

    public function mount(): void
    {
        $this->enrollments = Enrollment::with(['user', 'course', 'payment'])->latest()->get();
    }

    public function markAdded(int $id): void
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update(['added_to_whatsapp_group' => true]);

        $this->enrollments = Enrollment::with(['user', 'course', 'payment'])->latest()->get();

        session()->flash('success', 'Student marked as added to WhatsApp group.');
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Enrollments</h1>
        <p class="mt-2 text-sm text-gray-600">View all student enrollments.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-5">
        @forelse ($this->enrollments as $enrollment)
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $enrollment->user->name ?? 'Unknown Student' }}</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ $enrollment->course->title ?? 'Unknown Course' }}</p>
                        <p class="mt-1 text-sm text-gray-600">Status: {{ ucfirst($enrollment->status) }}</p>
                    </div>

                    <div class="text-sm text-gray-600">
                        <p>WhatsApp Group: {{ $enrollment->added_to_whatsapp_group ? 'Added' : 'Pending' }}</p>
                        <p class="mt-1">Payment Ref: {{ $enrollment->payment->reference ?? 'N/A' }}</p>
                    </div>
                </div>

                @if (!$enrollment->added_to_whatsapp_group)
                    <div class="mt-4">
                        <button
                            wire:click="markAdded({{ $enrollment->id }})"
                            class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
                        >
                            Mark as Added to WhatsApp Group
                        </button>
                    </div>
                @endif
            </div>
        @empty
            <div class="rounded-3xl bg-white p-10 text-center shadow-sm ring-1 ring-gray-200">
                <p class="text-sm text-gray-600">No enrollments found.</p>
            </div>
        @endforelse
    </div>
</div>