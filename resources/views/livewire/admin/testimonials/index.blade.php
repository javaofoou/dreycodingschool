<?php

use App\Models\Testimonial;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public $testimonials;

    public function mount(): void
    {
        $this->testimonials = Testimonial::latest()->get();
    }

    public function deleteTestimonial(int $id): void
    {
        Testimonial::findOrFail($id)->delete();
        $this->testimonials = Testimonial::latest()->get();
        session()->flash('success', 'Testimonial deleted successfully.');
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Testimonials</h1>
            <p class="mt-2 text-sm text-gray-600">View all testimonials.</p>
        </div>

        <a href="{{ route('admin.testimonials.create') }}" class="rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700" wire:navigate>
            Add Testimonial
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($this->testimonials as $testimonial)
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex items-center gap-4">
                    @if ($testimonial->student_image)
                        <img src="{{ $testimonial->student_image }}" alt="{{ $testimonial->student_name }}" class="h-14 w-14 rounded-full object-cover">
                    @else
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                            {{ strtoupper(substr($testimonial->student_name, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <h2 class="font-semibold text-gray-900">{{ $testimonial->student_name }}</h2>
                        <p class="text-sm text-indigo-600">{{ $testimonial->course_taken }}</p>
                    </div>
                </div>

                <p class="mt-4 text-sm leading-7 text-gray-600">
                    {{ $testimonial->comment }}
                </p>

                <p class="mt-3 text-sm text-gray-500">
                    Status: {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                </p>

                <div class="mt-4 flex gap-2">
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="rounded-xl bg-blue-600 px-3 py-2 text-xs font-semibold text-white hover:bg-blue-700" wire:navigate>
                        Edit
                    </a>
                    <button wire:click="deleteTestimonial({{ $testimonial->id }})" wire:confirm="Are you sure?" class="rounded-xl bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="rounded-3xl bg-white p-10 text-center shadow-sm ring-1 ring-gray-200 md:col-span-2 xl:col-span-3">
                <p class="text-sm text-gray-600">No testimonials found.</p>
            </div>
        @endforelse
    </div>
</div>