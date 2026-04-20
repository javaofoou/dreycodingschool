<?php

use App\Models\Course;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    use WithFileUploads;

    public Course $course;
    public string $title = '';
    public string $short_description = '';
    public string $full_description = '';
    public string $price = '';
    public string $duration = '';
    public string $level = '';
    public bool $is_active = true;
    public $image = null;

    public function mount(Course $course): void
    {
        $this->course = $course;
        $this->title = $course->title;
        $this->short_description = $course->short_description;
        $this->full_description = $course->full_description ?? '';
        $this->price = (string) $course->price;
        $this->duration = $course->duration ?? '';
        $this->level = $course->level ?? '';
        $this->is_active = (bool) $course->is_active;
    }

    public function update(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'full_description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageUrl = $this->course->image;
        $imagePublicId = $this->course->image_public_id;

        if ($this->image) {
            try {
                $cloudinary = new \Cloudinary\Cloudinary(env('CLOUDINARY_URL'));

                if ($imagePublicId) {
                    try {
                        $cloudinary->uploadApi()->destroy($imagePublicId);
                    } catch (\Throwable $e) {
                    }
                }

                $result = $cloudinary->uploadApi()->upload(
                    $this->image->getRealPath(),
                    [
                        'folder' => 'dreycodingschool/courses',
                        'resource_type' => 'image',
                    ]
                );

                $imageUrl = $result['secure_url'] ?? null;
                $imagePublicId = $result['public_id'] ?? null;
            } catch (\Throwable $e) {
                $this->addError('image', 'Course image upload failed.');
                return;
            }
        }

        $this->course->update([
            'title' => $validated['title'],
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'level' => $validated['level'],
            'is_active' => $validated['is_active'],
            'image' => $imageUrl,
            'image_public_id' => $imagePublicId,
        ]);

        session()->flash('success', 'Course updated successfully.');

        $this->redirect(route('admin.courses.index', absolute: false), navigate: true);
    }
};
?>

<div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Course</h1>
        <p class="mt-2 text-sm text-gray-600">Update course details.</p>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
        <form wire:submit="update" class="space-y-5">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Course Title</label>
                <input type="text" wire:model.defer="title" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Current Image</label>
                @if ($course->image)
                    <img src="{{ $course->image }}" class="mt-2 h-28 w-40 rounded-2xl object-cover">
                @else
                    <p class="text-sm text-gray-500">No image uploaded.</p>
                @endif
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Replace Image</label>
                <input type="file" wire:model="image" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="mt-3 h-28 w-40 rounded-2xl object-cover">
                @endif
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Short Description</label>
                <textarea wire:model.defer="short_description" rows="3" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"></textarea>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Full Description</label>
                <textarea wire:model.defer="full_description" rows="6" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <input type="number" wire:model.defer="price" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm" placeholder="Price">
                <input type="text" wire:model.defer="duration" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm" placeholder="Duration">
                <input type="text" wire:model.defer="level" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm" placeholder="Level">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model.defer="is_active" id="is_active" class="rounded border-gray-300">
                <label for="is_active" class="text-sm font-medium text-gray-700">Active Course</label>
            </div>

            <button type="submit" class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                Update Course
            </button>
        </form>
    </div>
</div>