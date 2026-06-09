<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 antialiased">

    {{-- Nav --}}
    <nav class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex h-16 max-w-5xl items-center justify-between px-6">
            <span class="text-lg font-bold text-gray-900">{{ config('app.name') }}</span>
            <a href="{{ route('admin.dashboard') }}"
               class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-gray-700">
                Admin
            </a>
        </div>
    </nav>

    {{-- Hero --}}
    <main class="flex min-h-[calc(100vh-4rem)] flex-col items-center justify-center px-6 text-center">

        <div class="max-w-2xl">

            <span class="mb-5 inline-block rounded-full bg-green-100 px-4 py-1.5 text-sm font-medium text-green-700">
                Welcome
            </span>

            <h1 class="mb-5 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                Hello, Welcome to <br>
                <span class="text-green-600">Grow Locally</span>
            </h1>

            <p class="mb-8 text-lg leading-relaxed text-gray-500">
                We help local businesses grow with modern digital solutions —
                from brand identity and web design to content and marketing.
            </p>

            <div class="flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="#"
                   class="rounded-xl bg-gray-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-gray-700">
                    Get Started
                </a>
                <a href="#"
                   class="rounded-xl border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-100">
                    Learn More
                </a>
            </div>

        </div>

    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-200 bg-white py-6 text-center text-sm text-gray-400">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>

</body>
</html>
