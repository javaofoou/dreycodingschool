<?php

use App\Models\ProjectRequest;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.auth.simple');

new class extends Component {
    public string $full_name = '';
    public string $email = '';
    public string $whatsapp_number = '';
    public string $project_type = '';
    public string $budget_range = '';
    public string $project_description = '';

    public function submit(): void
    {
        $validated = $this->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'whatsapp_number' => ['required', 'string', 'max:20'],
            'project_type' => ['required', 'string', 'max:255'],
            'budget_range' => ['nullable', 'string', 'max:255'],
            'project_description' => ['required', 'string', 'min:10'],
        ]);

        ProjectRequest::create([
            ...$validated,
            'status' => 'new',
        ]);

        $this->reset();

        session()->flash('success', 'Your project request has been submitted successfully. We will contact you soon.');
    }
};
?>

<div class="min-h-screen bg-gray-50">

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-hero-gradient text-white">
        <div class="absolute -left-20 top-0 h-72 w-72 bg-purple-600/20 blur-3xl rounded-full"></div>
        <div class="absolute -right-20 bottom-0 h-72 w-72 bg-pink-500/20 blur-3xl rounded-full"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.3em] text-purple-200">
                    DreyCoding School
                </p>

                <h1 class="text-4xl font-extrabold sm:text-5xl">
                    Let’s Build Your Project 🚀
                </h1>

                <p class="mt-5 text-purple-100 text-base sm:text-lg">
                    Tell us your idea — we’ll design, build, and deliver a powerful solution tailored to your needs.
                </p>
            </div>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                {{-- LEFT SIDE --}}
                <div class="lg:col-span-1 rounded-3xl bg-white/80 backdrop-blur p-6 shadow-lg ring-1 ring-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900">Why Work With Us?</h2>

                    <div class="mt-5 space-y-4 text-sm text-gray-600">
                        <p>We build modern, scalable and real-world digital solutions.</p>

                        <ul class="space-y-3">
                            <li class="flex gap-2">✔ Business Websites</li>
                            <li class="flex gap-2">✔ E-commerce Platforms</li>
                            <li class="flex gap-2">✔ School Portals</li>
                            <li class="flex gap-2">✔ Web Applications</li>
                            <li class="flex gap-2">✔ Mobile Apps</li>
                            <li class="flex gap-2">✔ Custom Software</li>
                        </ul>
                    </div>

                    <div class="mt-6 rounded-2xl bg-purple-50 p-4 text-sm text-brand-primary">
                        Fast delivery • Clean UI • Professional support
                    </div>
                </div>

                {{-- FORM --}}
                <div class="lg:col-span-2 rounded-3xl bg-white p-6 shadow-xl ring-1 ring-gray-200 sm:p-8">

                    <h2 class="text-2xl font-bold text-gray-900">Project Request Form</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Fill in your details and we’ll contact you shortly.
                    </p>

                    <form wire:submit="submit" class="mt-8 space-y-5">

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <input type="text" wire:model.defer="full_name" placeholder="Full Name"
                                class="input-field">
                            @error('full_name') <p class="error">{{ $message }}</p> @enderror

                            <input type="email" wire:model.defer="email" placeholder="Email Address"
                                class="input-field">
                            @error('email') <p class="error">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <input type="text" wire:model.defer="whatsapp_number" placeholder="WhatsApp Number"
                                class="input-field">
                            @error('whatsapp_number') <p class="error">{{ $message }}</p> @enderror

                            <select wire:model.defer="project_type" class="input-field">
                                <option value="">Select Project Type</option>
                                <option>Business Website</option>
                                <option>E-commerce Website</option>
                                <option>School Website</option>
                                <option>Portfolio Website</option>
                                <option>Web App</option>
                                <option>Mobile App</option>
                                <option>Custom Project</option>
                            </select>
                            @error('project_type') <p class="error">{{ $message }}</p> @enderror
                        </div>

                        <input type="text" wire:model.defer="budget_range" placeholder="Budget (Optional)"
                            class="input-field">
                        @error('budget_range') <p class="error">{{ $message }}</p> @enderror

                        <textarea wire:model.defer="project_description" rows="6"
                            placeholder="Describe your project..."
                            class="input-field"></textarea>
                        @error('project_description') <p class="error">{{ $message }}</p> @enderror

                        <button
                            type="submit"
                            class="btn-brand-gradient w-full rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5">
                            Submit Project Request
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </section>
</div>