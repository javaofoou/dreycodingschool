<?php
use App\Models\Course;
use function Livewire\Volt\{layout, state};

layout('components.layouts.auth.simple');

state([
    'courses' => Course::where('is_active', true)->latest()->get(),
]);

?>

<div class="min-h-screen w-full overflow-x-hidden  bg-gray-50 flex flex-col items-center">
<div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-hero-gradient text-white">
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-72 w-72 rounded-full bg-pink-500/20 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-3xl text-center">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.3em] text-purple-200">
                    DreyCoding School
                </p>

                <h1 class="text-4xl font-extrabold sm:text-5xl">
                    Explore Our Courses 🚀
                </h1>

                <p class="mt-5 text-purple-100 text-base sm:text-lg">
                    Practical, real-world tech training designed to help you become confident and job-ready.
                </p>
            </div>
        </div>
    </section>

    {{-- COURSES --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mb-10 flex flex-col items-center text-center gap-3">
    <div class="mx-auto max-w-2xl">
                    <h2 class="text-3xl font-bold text-gray-900">Available Courses</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Choose a course and start building real skills.
                    </p>
                </div>
            </div>

            @if ($this->courses->count())

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

                    @foreach ($this->courses as $course)

                        <div class="group flex h-full flex-col overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

    {{-- IMAGE --}}
    <div class="h-52 w-full overflow-hidden">
        @if ($course->image)
            <img
                src="{{ $course->image }}"
                alt="{{ $course->title }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-110"
            >
        @else
            <div class="flex h-full items-center justify-center bg-gradient-to-br from-purple-100 to-orange-50 text-sm font-medium text-gray-500">
                No course image
            </div>
        @endif
    </div>

    {{-- CONTENT --}}
    <div class="flex flex-1 flex-col p-6">

        {{-- TITLE --}}
        <h3 class="text-lg font-bold text-gray-900 line-clamp-2">
            {{ $course->title }}
        </h3>

        {{-- PRICE --}}
        <div class="mt-2">
            <span class="inline-block rounded-full bg-purple-100 px-3 py-1 text-sm font-semibold text-brand-primary">
                ₦{{ number_format($course->price, 0) }}
            </span>
        </div>

        {{-- DESCRIPTION --}}
        <p class="mt-3 text-sm text-gray-600 line-clamp-3">
            {{ $course->short_description }}
        </p>

        {{-- TAGS --}}
        <div class="mt-4 flex flex-wrap gap-2">
            @if($course->duration)
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-700">
                    ⏱ {{ $course->duration }}
                </span>
            @endif

            @if($course->level)
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-700">
                    🎯 {{ $course->level }}
                </span>
            @endif
        </div>

        {{-- PUSH BUTTONS DOWN --}}
        <div class="mt-auto pt-6 flex gap-3">

            <a
                href="{{ route('courses.show', $course->slug) }}"
                class="flex-1 text-center rounded-full border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                wire:navigate
            >
                Details
            </a>

            @auth
                <a
                    href="{{ route('checkout.show', $course->slug) }}"
                    class="flex-1 text-center btn-brand-gradient px-4 py-2 text-sm font-semibold text-white"
                    wire:navigate
                >
                    Enroll
                </a>
            @else
                <a
                    href="{{ route('register', ['course' => $course->slug]) }}"
                    class="flex-1 text-center btn-brand-gradient px-4 py-2 text-sm font-semibold text-white"
                    wire:navigate
                >
                    Register
                </a>
            @endauth

        </div>

    </div>
</div>
                    @endforeach

                </div>

            @else

                <div class="rounded-3xl bg-white p-10 text-center shadow-md ring-1 ring-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">No courses available yet</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Courses will appear here once they are added.
                    </p>
                </div>

            @endif

        </div>
    </section>
</div>
</div>