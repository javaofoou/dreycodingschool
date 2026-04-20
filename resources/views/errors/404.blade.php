<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
    <title>Page Not Found</title>
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-xl rounded-3xl bg-white p-8 text-center shadow-sm ring-1 ring-gray-200 sm:p-10">
            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-indigo-100 text-3xl font-bold text-indigo-700">
                404
            </div>

            <h1 class="text-3xl font-bold text-gray-900">Page Not Found</h1>
            <p class="mt-4 text-sm leading-7 text-gray-600 sm:text-base">
                Sorry, the page you are looking for does not exist or may have been moved.
            </p>

            <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                >
                    Go Home
                </a>

                <a
                    href="{{ route('courses.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    View Courses
                </a>
            </div>
        </div>
    </div>
</body>
</html>