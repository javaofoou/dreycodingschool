<?php

use App\Models\Testimonial;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public string $student_name = '';
    public string $course_taken = '';
    public string $comment = '';
    public string $student_image = '';
    public bool $is_active = true;

    public function save(): void
    {
        $validated = $this->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'course_taken' => ['nullable', 'string', 'max:255'],
            'comment' => ['required', 'string'],
            'student_image' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        Testimonial::create([
            'student_name' => $validated['student_name'],
            'course_taken' => $validated['course_taken'],
            'comment' => $validated['comment'],
            'student_image' => $validated['student_image'],
            'student_image_public_id' => null,
            'is_active' => $validated['is_active'],
        ]);

        session()->flash('success', 'Testimonial created successfully.');

        $this->redirect(route('admin.testimonials.index', absolute: false), navigate: true);
    }
};
?>

<div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Create Testimonial</h1>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
        <form wire:submit="save" class="space-y-5">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Student Name</label>
                <input type="text" wire:model.defer="student_name" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Course Taken</label>
                <input type="text" wire:model.defer="course_taken" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Student Image URL</label>
                <input type="text" wire:model.defer="student_image" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Comment</label>
                <textarea wire:model.defer="comment" rows="5" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"></textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model.defer="is_active" id="testimonial_active" class="rounded border-gray-300">
                <label for="testimonial_active" class="text-sm font-medium text-gray-700">Active</label>
            </div>

            <button type="submit" class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                Save Testimonial
            </button>
        </form>
    </div>
</div>