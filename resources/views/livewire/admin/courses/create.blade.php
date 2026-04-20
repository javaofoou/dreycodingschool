<?php

use App\Models\Course;
use Illuminate\Support\Str;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    use WithFileUploads;

    public string $title = '';
    public string $short_description = '';
    public string $full_description = '';
    public string $price = '';
    public string $duration = '';
    public string $level = '';
    public bool $is_active = true;
    public $image = null;

    public function save(): void
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

        $imageUrl = null;
        $imagePublicId = null;

        if ($this->image) {
            try {
                $cloudinary = new \Cloudinary\Cloudinary(env('CLOUDINARY_URL'));

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

        Course::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'level' => $validated['level'],
            'is_active' => $validated['is_active'],
            'image' => $imageUrl,
            'image_public_id' => $imagePublicId,
        ]);

        session()->flash('success', 'Course created successfully.');

        $this->redirect(route('admin.courses.index', absolute: false), navigate: true);
    }
};
?>

<div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Create Course</h1>
        <p class="mt-2 text-sm text-gray-600">Add a new course to the platform.</p>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
        <form wire:submit="save" class="space-y-5">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Course Title</label>
                <input type="text" wire:model.defer="title" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Course Image</label>
                <input type="file" wire:model="image" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="mt-3 h-28 w-40 rounded-2xl object-cover">
                @endif
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Short Description</label>
                <textarea wire:model.defer="short_description" rows="3" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"></textarea>
                @error('short_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Full Description</label>
                <textarea wire:model.defer="full_description" rows="6" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" wire:model.defer="price" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                    @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Duration</label>
                    <input type="text" wire:model.defer="duration" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Level</label>
                    <input type="text" wire:model.defer="level" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model.defer="is_active" id="is_active" class="rounded border-gray-300">
                <label for="is_active" class="text-sm font-medium text-gray-700">Active Course</label>
            </div>

            <button type="submit" class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                Save Course
            </button>
        </form>
    </div>
</div>