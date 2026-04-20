<?php

use App\Models\Course;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout, state};

layout('components.layouts.app');

new class extends Component {
    public $courses;

    public function mount(): void
    {
        $this->courses = Course::latest()->get();
    }

    public function deleteCourse(int $id): void
    {
        $course = Course::findOrFail($id);
        $course->delete();

        $this->courses = Course::latest()->get();

        session()->flash('success', 'Course deleted successfully.');
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manage Courses</h1>
            <p class="mt-2 text-sm text-gray-600">View, create, edit, and delete courses.</p>
        </div>

        <a
            href="{{ route('admin.courses.create') }}"
            class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
            wire:navigate
        >
            Add New Course
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Title</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Price</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Created</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($this->courses as $course)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $course->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">₦{{ number_format($course->price, 0) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $course->is_active ? 'Active' : 'Inactive' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $course->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <div class="flex flex-wrap gap-2">
                                    <a
                                        href="{{ route('admin.courses.edit', $course->id) }}"
                                        class="rounded-xl bg-blue-600 px-3 py-2 text-xs font-semibold text-white hover:bg-blue-700"
                                        wire:navigate
                                    >
                                        Edit
                                    </a>

                                    <button
                                        wire:click="deleteCourse({{ $course->id }})"
                                        wire:confirm="Are you sure you want to delete this course?"
                                        class="rounded-xl bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-600">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>