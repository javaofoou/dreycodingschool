<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use function Livewire\Volt\{layout};

layout('components.layouts.auth.simple');

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $whatsapp_number = '';
    public $profile_image = null;
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'whatsapp_number' => ['required', 'string', 'max:20'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $profileImageUrl = null;
        $profileImagePublicId = null;

        if ($this->profile_image) {
            try {
                $cloudinaryUrl = env('CLOUDINARY_URL');

                if (!$cloudinaryUrl) {
                    $this->addError('profile_image', 'Cloudinary is not configured.');
                    return;
                }

                $cloudinary = new \Cloudinary\Cloudinary($cloudinaryUrl);

                $result = $cloudinary->uploadApi()->upload(
                    $this->profile_image->getRealPath(),
                    [
                        'folder' => 'dreycodingschool/users',
                        'resource_type' => 'image',
                    ]
                );

                $profileImageUrl = $result['secure_url'] ?? null;
                $profileImagePublicId = $result['public_id'] ?? null;
            } catch (\Throwable $e) {
                $this->addError('profile_image', 'Image upload failed: ' . $e->getMessage());
                return;
            }
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'profile_image' => $profileImageUrl,
            'profile_image_public_id' => $profileImagePublicId,
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        session()->regenerate();

        $courseSlug = request()->query('course');

        if ($courseSlug) {
            $this->redirect(route('checkout.show', $courseSlug, absolute: false), navigate: true);
            return;
        }

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-10">
    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-200">

        <div class="bg-hero-gradient px-6 py-8 text-center text-white">
            <h1 class="text-2xl font-bold">Create Account</h1>
            <p class="mt-2 text-sm text-purple-100">
                Register for DreyCoding School
            </p>
        </div>

        <div class="px-6 py-8">
            <form wire:submit="register" class="space-y-5">

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Full Name</label>
                    <input
                        type="text"
                        wire:model.defer="name"
                        class="input-field"
                        placeholder="Enter your full name"
                    >
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Email Address</label>
                    <input
                        type="email"
                        wire:model.defer="email"
                        class="input-field"
                        placeholder="Enter your email"
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">WhatsApp Number</label>
                    <input
                        type="text"
                        wire:model.defer="whatsapp_number"
                        class="input-field"
                        placeholder="Enter your WhatsApp number"
                    >
                    @error('whatsapp_number')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Profile Image</label>
                    <input
                        type="file"
                        wire:model="profile_image"
                        class="input-field file:mr-4 file:rounded-full file:border-0 file:bg-purple-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-primary hover:file:bg-purple-200"
                    >

                    @error('profile_image')
                        <p class="error">{{ $message }}</p>
                    @enderror

                    <div wire:loading wire:target="profile_image" class="mt-2 text-sm text-brand-primary">
                        Uploading image...
                    </div>

                    @if ($profile_image)
                        <div class="mt-4 flex items-center gap-3">
                            <img
                                src="{{ $profile_image->temporaryUrl() }}"
                                alt="Preview"
                                class="h-20 w-20 rounded-full object-cover ring-2 ring-purple-100"
                            >
                            <span class="text-sm text-gray-600">Image preview</span>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        wire:model.defer="password"
                        class="input-field"
                        placeholder="Enter your password"
                    >
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input
                        type="password"
                        wire:model.defer="password_confirmation"
                        class="input-field"
                        placeholder="Confirm your password"
                    >
                    @error('password_confirmation')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="btn-brand-gradient w-full rounded-full px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                >
                    Register
                </button>

                <p class="text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-brand-primary hover:underline" wire:navigate>
                        Sign in
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>