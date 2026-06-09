<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-900">

<div class="w-full max-w-sm">

    <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold text-white">Agency Admin</h1>
        <p class="mt-1 text-sm text-slate-400">Sign in to your account</p>
    </div>

    <div class="rounded-xl bg-white p-8 shadow-2xl">

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                       value="{{ old('email') }}"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none transition
                              focus:border-slate-600 focus:ring-2 focus:ring-slate-600/20
                              @error('email') border-red-400 @enderror">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none transition
                              focus:border-slate-600 focus:ring-2 focus:ring-slate-600/20">
            </div>

            <div class="flex items-center gap-2">
                <input id="remember" name="remember" type="checkbox"
                       class="h-4 w-4 rounded border-gray-300 text-slate-700">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700 active:bg-slate-800">
                Sign in
            </button>
        </form>
    </div>
</div>

</body>
</html>
