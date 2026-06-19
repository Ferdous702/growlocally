<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} — Agency Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen">

    {{-- ─── Sidebar ──────────────────────────────────────────────────── --}}
    <aside class="fixed inset-y-0 left-0 z-30 flex w-64 flex-col bg-slate-900">

        <div class="flex h-16 items-center border-b border-slate-800 px-6">
            <span class="text-lg font-bold tracking-tight text-white">Agency Admin</span>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
            @php
                $nav = [
                    ['route' => 'admin.dashboard',            'label' => 'Dashboard'],
                    ['route' => 'admin.services',             'label' => 'Services'],
                    ['route' => 'admin.portfolio-categories', 'label' => 'Portfolio Categories'],
                    ['route' => 'admin.portfolios',           'label' => 'Portfolios'],
                    ['route' => 'admin.testimonials',         'label' => 'Testimonials'],
                    ['route' => 'admin.contacts',             'label' => 'Contact Inquiries'],
                    ['route' => 'admin.bookings',             'label' => 'Bookings'],
                ];
            @endphp

            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex items-center rounded-lg px-4 py-2.5 text-sm transition-colors
                          {{ request()->routeIs($item['route'])
                              ? 'bg-slate-700 font-medium text-white'
                              : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="border-t border-slate-800 p-4">
            <div class="mb-3 flex items-center gap-3">
                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-slate-600">
                    <span class="text-xs font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                    <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                        class="w-full rounded-lg px-4 py-2 text-left text-sm text-slate-400 transition-colors hover:bg-slate-800 hover:text-white">
                    Sign out
                </button>
            </form>
        </div>
    </aside>

    {{-- ─── Main content ───────────────────────────────────────────────── --}}
    <div class="ml-64 flex flex-1 flex-col">

        <header class="sticky top-0 z-20 flex h-16 items-center border-b border-gray-200 bg-white px-8">
            <h1 class="text-lg font-semibold text-gray-900">{{ $title ?? 'Admin' }}</h1>
        </header>

        <main class="flex-1 p-8">

            @if (session('success'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 4000)"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="mb-6 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    <svg class="h-4 w-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{ $slot }}

        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
