<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Video Posts'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased">
    <header class="border-b border-zinc-200 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home.index') }}" class="text-xl font-bold tracking-tight text-zinc-900">Video Posts</a>
            <div class="flex items-center gap-3 text-sm font-medium">
                <a href="{{ route('home.index') }}" class="text-zinc-600 hover:text-zinc-900">Home</a>
                @auth
                    <a href="{{ route('posts.index') }}" class="text-zinc-600 hover:text-zinc-900">My videos</a>
                    <a href="{{ route('posts.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">Upload</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-zinc-600 hover:text-zinc-900">Sign out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-zinc-600 hover:text-zinc-900">Sign in</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">Create account</a>
                @endauth
            </div>
        </nav>
    </header>

    @if (session('status'))
        <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
            <p role="status" class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</p>
        </div>
    @endif

    @yield('content')
</body>
</html>
