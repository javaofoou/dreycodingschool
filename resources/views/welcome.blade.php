<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('partials.head')
</head>
<body class="bg-gray-50 text-gray-900">
   <header class="sticky top-0 z-40 border-b border-white/10 bg-brand-primary/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-center px-4 py-4 sm:px-6 lg:px-8 md:justify-between">

        <a href="{{ route('home') }}" class="flex items-center justify-center gap-3 text-center">
           <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/v1776687647/1002774238-removebg-preview_thfrai.png"
                alt="DreyCoding School Logo"
                class="h-12 w-auto max-h-12 shrink-0 drop-shadow-lg">
            <span class="text-xl font-extrabold tracking-wide text-white">
                DreyCoding School
            </span>
        </a>

        <nav class="hidden items-center gap-6 md:flex">
            <a href="{{ route('home') }}" class="text-sm font-medium text-white/80 transition hover:text-white">Home</a>
            <a href="{{ route('courses.index') }}" class="text-sm font-medium text-white/80 transition hover:text-white">Courses</a>
            <a href="{{ route('project-requests.create') }}" class="text-sm font-medium text-white/80 transition hover:text-white">Hire Us</a>
            <a href="{{ route('faq.index') }}" class="text-sm font-medium text-white/80 transition hover:text-white">FAQ</a>
            <a href="{{ route('testimonials.index') }}" class="text-sm font-medium text-white/80 transition hover:text-white">Testimonials</a>
        </nav>

        <div class="hidden md:block">
            <a
                href="{{ route('register') }}"
                class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-900/30 transition hover:-translate-y-0.5"
            >
                Get Started
            </a>
        </div>
    </div>
</header>
    <section class="relative overflow-hidden bg-hero-gradient text-white">
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-72 w-72 rounded-full bg-pink-500/20 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-28">
            <div class="flex flex-col justify-center">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.25em] text-purple-200">
                    Learn. Build. Grow.
                </p>

                <h1 class="text-4xl font-extrabold leading-tight sm:text-5xl lg:text-6xl">
                    Practical Tech Training for
                    <span class="bg-gradient-to-r from-yellow-300 via-pink-300 to-purple-200 bg-clip-text text-transparent">
                        Future Developers
                    </span>
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-7 text-purple-100 sm:text-lg">
                    DreyCoding School helps beginners and aspiring developers learn web development,
                    software development, Python, and mobile app development through practical online training.
                </p>

                <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:flex-wrap">
                    <a
                        href="{{ route('courses.index') }}"
                        class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-900/30 transition hover:-translate-y-0.5"
                    >
                        View Courses
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-full border border-white/25 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
                    >
                        Enroll Now
                    </a>

                    <a
                        href="{{ route('project-requests.create') }}"
                        class="inline-flex items-center justify-center rounded-full border border-white/25 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
                    >
                        Hire Us
                    </a>

                    <a
                        href="{{ route('donations.create') }}"
                        class="inline-flex items-center justify-center rounded-full border border-white/25 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
                    >
                        Donate
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap gap-4 text-sm text-purple-200">
                    <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2">Beginner Friendly</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2">Hands-on Learning</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2">Mentorship & Support</span>
                </div>
            </div>

<div class="relative">

    <div class="swiper heroSwiper h-[320px] sm:h-[380px] lg:h-[420px] rounded-3xl overflow-hidden">

        <div class="swiper-wrapper">

            <!-- SLIDE 1 -->
            <div class="swiper-slide relative">
                <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/q_auto/f_auto/v1776654440/file_00000000da847206ab119cd7518a75dc_gtpa4c.png"/>
                {{-- <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-6">
                    <h3 class="text-2xl font-bold text-white">Learn Web Development</h3>
                    <p class="text-sm text-gray-200 mt-2">Start from beginner to pro</p>
                    <a href="{{ route('courses.index') }}"
                       class="mt-4 btn-brand-gradient px-5 py-2 text-sm rounded-full">
                        View Courses
                    </a>
                </div> --}}
            </div>

            <!-- SLIDE 2 -->
            <div class="swiper-slide relative">
                <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/q_auto/f_auto/v1776654445/file_00000000682471f6bc55cdeb7ce59b8e_opy27q.png"/>
                {{-- <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-6">
                    <h3 class="text-2xl font-bold text-white">Build Real Projects</h3>
                    <p class="text-sm text-gray-200 mt-2">Hands-on training</p>
                    <a href="{{ route('project-requests.create') }}"
                       class="mt-4 btn-brand-gradient px-5 py-2 text-sm rounded-full">
                        Hire Us
                    </a>
                </div> --}}
            </div>

            <!-- SLIDE 3 -->
            <div class="swiper-slide relative">
                <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/q_auto/f_auto/v1776654444/file_00000000d06c720c82cb6bc40d4f21e8_wrs9oo.png" />
                <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-6">
                    <h3 class="text-2xl font-bold text-white">Join Live Classes</h3>
                    <p class="text-sm text-gray-200 mt-2">Interactive learning experience</p>
                    <a href="{{ route('register') }}"
                       class="mt-4 btn-brand-gradient px-5 py-2 text-sm rounded-full">
                        Enroll Now
                    </a>
                </div>
            </div>

             <!-- SLIDE 4 -->
            <div class="swiper-slide relative">
                <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/q_auto/f_auto/v1776654435/file_000000000aec71f79b9579928adcecb3_e4cqxy.png"/>
                {{-- <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-6">
                    <h3 class="text-2xl font-bold text-white">Join Live Classes</h3>
                    <p class="text-sm text-gray-200 mt-2">Interactive learning experience</p>
                    <a href="{{ route('register') }}"
                       class="mt-4 btn-brand-gradient px-5 py-2 text-sm rounded-full">
                        Enroll Now
                    </a>
                </div> --}}
            </div>

              <div class="swiper-slide relative">
                <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/q_auto/f_auto/v1776654446/file_000000009780724393751a9ee6387b22_h2g1aa.png"/>
                {{-- <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-6">
                    <h3 class="text-2xl font-bold text-white">Join Live Classes</h3>
                    <p class="text-sm text-gray-200 mt-2">Interactive learning experience</p>
                    <a href="{{ route('register') }}"
                       class="mt-4 btn-brand-gradient px-5 py-2 text-sm rounded-full">
                        Enroll Now
                    </a>
                </div> --}}
            </div>

        </div>

        <!-- NAVIGATION -->
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>

        <!-- PAGINATION -->
        <div class="swiper-pagination"></div>

    </div>

</div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Our Courses</h2>
                    <p class="mt-2 text-sm text-gray-600">Choose a course and start building your future.</p>
                </div>

                <a
                    href="{{ route('courses.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    View All Courses
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach(\App\Models\Course::where('is_active', true)->inRandomOrder()->take(3)->get() as $course)
                    <div class="group overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                        <div class="flex h-48 items-center justify-center overflow-hidden bg-gradient-to-br from-purple-100 to-orange-50 text-sm font-medium text-gray-500">
                            @if ($course->image)
                                <img src="{{ $course->image }}" alt="{{ $course->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                            @else
                                No course image
                            @endif
                        </div>

                        <div class="p-6">
                            <div class="mb-3 flex items-center justify-between gap-3">
                                <h3 class="text-xl font-bold text-gray-900">{{ $course->title }}</h3>
                                <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-brand-primary">
                                    ₦{{ number_format($course->price, 0) }}
                                </span>
                            </div>

                            <p class="text-sm leading-6 text-gray-600">{{ $course->short_description }}</p>

                            <div class="mt-6">
                                <a
                                    href="{{ route('courses.show', $course->slug) }}"
                                    class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5"
                                >
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">How It Works</h2>
                <p class="mt-2 text-sm text-gray-600">A simple learning process designed for clarity and growth.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
                <div class="relative rounded-3xl bg-white p-6 shadow-md ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute -top-4 left-6 flex h-10 w-10 items-center justify-center rounded-full bg-brand-primary text-sm font-bold text-white shadow-lg">1</div>
                    <h3 class="mt-6 text-lg font-semibold text-gray-900">Choose a Course</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-600">Select the course package that matches your learning goals.</p>
                </div>

                <div class="relative rounded-3xl bg-white p-6 shadow-md ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute -top-4 left-6 flex h-10 w-10 items-center justify-center rounded-full bg-brand-primary text-sm font-bold text-white shadow-lg">2</div>
                    <h3 class="mt-6 text-lg font-semibold text-gray-900">Register</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-600">Create your student account and provide your details.</p>
                </div>

                <div class="relative rounded-3xl bg-white p-6 shadow-md ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute -top-4 left-6 flex h-10 w-10 items-center justify-center rounded-full bg-brand-primary text-sm font-bold text-white shadow-lg">3</div>
                    <h3 class="mt-6 text-lg font-semibold text-gray-900">Make Payment</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-600">Pay securely online and receive your receipt immediately.</p>
                </div>

                <div class="relative rounded-3xl bg-white p-6 shadow-md ring-1 ring-gray-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute -top-4 left-6 flex h-10 w-10 items-center justify-center rounded-full bg-brand-primary text-sm font-bold text-white shadow-lg">4</div>
                    <h3 class="mt-6 text-lg font-semibold text-gray-900">Start Learning</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-600">Get added to our community and join our online classes.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Student Testimonials</h2>
                    <p class="mt-2 text-sm text-gray-600">Hear from learners who trained with DreyCoding School.</p>
                </div>

                <a
                    href="{{ route('testimonials.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    View All Testimonials
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach(\App\Models\Testimonial::where('is_active', true)->orderBy('created_at','asc')->take(3)->get() as $testimonial)
                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex items-center gap-4">
                            @if ($testimonial->student_image)
                                <img
                                    src="{{ $testimonial->student_image }}"
                                    alt="{{ $testimonial->student_name }}"
                                    class="h-14 w-14 rounded-full object-cover ring-2 ring-purple-100"
                                >
                            @else
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-purple-100 text-sm font-bold text-brand-primary">
                                    {{ strtoupper(substr($testimonial->student_name, 0, 1)) }}
                                </div>
                            @endif

                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $testimonial->student_name }}</h3>
                                <p class="text-sm text-brand-primary">{{ $testimonial->course_taken }}</p>
                            </div>
                        </div>

                        <p class="mt-4 text-sm leading-7 text-gray-600">
                            “{{ $testimonial->comment }}”
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Frequently Asked Questions</h2>
                    <p class="mt-2 text-sm text-gray-600">Quick answers to help you understand the process.</p>
                </div>

                <a
                    href="{{ route('faq.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    View All FAQs
                </a>
            </div>

            <div class="space-y-5">
                @foreach(\App\Models\Faq::where('is_active', true)->latest()->take(4)->get() as $faq)
                    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition duration-300 hover:shadow-md">
                        <h3 class="text-lg font-bold text-gray-900">{{ $faq->question }}</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">{{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-brand-primary py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-white/10 bg-white/5 p-8 shadow-xl backdrop-blur sm:p-10">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center">
                    <div>
                        <h2 class="text-3xl font-bold sm:text-4xl">Need a Website or Mobile App for Your Project?</h2>
                        <p class="mt-4 text-sm leading-7 text-purple-100 sm:text-base">
                            We also work with clients who want custom websites, web apps, and mobile app solutions.
                            Tell us about your project and we’ll help you build it.
                        </p>
                    </div>

                    <div class="flex flex-col gap-4 sm:flex-row lg:justify-end">
                        <a
                            href="{{ route('project-requests.create') }}"
                            class="btn-brand-gradient inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-900/30 transition hover:-translate-y-0.5"
                        >
                            Submit Project Request
                        </a>

                        <a
                            href="{{ route('courses.index') }}"
                            class="inline-flex items-center justify-center rounded-full border border-white/25 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
                        >
                            Explore Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black py-8 text-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <p class="text-sm text-white/70">
                © {{ date('Y') }} DreyCoding School. All rights reserved.
            </p>

            <div class="flex flex-wrap gap-4 text-sm text-white/70">
    <a href="{{ route('courses.index') }}" class="transition hover:text-white">Courses</a>
    <a href="{{ route('project-requests.create') }}" class="transition hover:text-white">Hire Us</a>
    <a href="{{ route('faq.index') }}" class="transition hover:text-white">FAQ</a>
    <a href="{{ route('testimonials.index') }}" class="transition hover:text-white">Testimonials</a>

    {{-- New Links --}}
    <a href="{{ route('privacy.policy') }}" class="transition hover:text-white">Privacy Policy</a>
    <a href="{{ route('terms') }}" class="transition hover:text-white">Terms & Conditions</a>
</div>
        </div>

        <div class="flex justify-center gap-6 mt-6">
    <!-- Facebook -->
    <a href="https://facebook.com/yourpage" target="_blank" class="text-gray-500 hover:text-blue-600 transition">
        <i class="fab fa-facebook-f text-xl"></i>
    </a>

    <!-- X (Twitter) -->
    <a href="https://x.com/yourpage" target="_blank" class="text-gray-500 hover:text-black transition">
        <i class="fab fa-x-twitter text-xl"></i>
    </a>

    <!-- Instagram -->
    <a href="https://instagram.com/yourpage" target="_blank" class="text-gray-500 hover:text-pink-500 transition">
        <i class="fab fa-instagram text-xl"></i>
    </a>

    <!-- TikTok -->
    <a href="https://tiktok.com/@yourpage" target="_blank" class="text-gray-500 hover:text-black transition">
        <i class="fab fa-tiktok text-xl"></i>
    </a>

</div>
    </footer>

   <!-- Floating Chat Button -->
<a href="https://wa.me/2349024686942" target="_blank"
   class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 rounded-full bg-green-500 shadow-lg hover:scale-110 transition duration-300">

    <!-- WhatsApp SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
        <path d="M20.52 3.48A11.77 11.77 0 0 0 12.06 0C5.42 0 .02 5.4.02 12.05c0 2.13.56 4.22 1.63 6.06L0 24l6.08-1.6a11.97 11.97 0 0 0 5.98 1.52h.01c6.64 0 12.04-5.4 12.04-12.05 0-3.22-1.25-6.24-3.59-8.39zM12.06 21.9h-.01a9.85 9.85 0 0 1-5.02-1.38l-.36-.21-3.61.95.96-3.52-.23-.37a9.8 9.8 0 0 1-1.52-5.32c0-5.46 4.44-9.9 9.9-9.9 2.65 0 5.13 1.03 7.01 2.9a9.85 9.85 0 0 1 2.89 7.01c0 5.46-4.44 9.9-9.91 9.9zm5.47-7.39c-.3-.15-1.78-.88-2.05-.98-.27-.1-.47-.15-.67.15-.2.3-.77.98-.94 1.18-.17.2-.35.22-.65.07-.3-.15-1.26-.47-2.4-1.5-.89-.8-1.5-1.78-1.67-2.08-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.5-.17 0-.37-.02-.57-.02-.2 0-.52.07-.8.37-.27.3-1.05 1.02-1.05 2.48 0 1.46 1.07 2.88 1.22 3.08.15.2 2.1 3.2 5.08 4.48.71.31 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.78-.73 2.03-1.44.25-.7.25-1.3.17-1.44-.08-.13-.27-.2-.57-.35z"/>
    </svg>
</a>
</body>
</html>