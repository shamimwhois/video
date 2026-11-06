<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel App') }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Optional: Alpine.js for interactive dropdowns & mobile menu state -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-full bg-zinc-950 font-sans text-zinc-100 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar Layout Header -->
    <header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 w-full border-b border-white/10 bg-zinc-950/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-12">
            
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 font-bold text-white shadow-lg shadow-indigo-600/30">
                    A
                </div>
                <span class="text-lg font-bold tracking-tight text-white">Acme Corp</span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-300">
                <a href="#features" class="transition-colors hover:text-white">Features</a>
                <a href="#solutions" class="transition-colors hover:text-white">Solutions</a>
                <a href="#pricing" class="transition-colors hover:text-white">Pricing</a>
                <a href="#docs" class="transition-colors hover:text-white">Documentation</a>
            </nav>

            <!-- Actions -->
            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-zinc-300 transition-colors hover:text-white">
                    Sign in
                </a>
                <a href="{{ route('register') }}" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 transition-all">
                    Get Started
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden rounded-lg p-2 text-zinc-400 hover:bg-white/5 hover:text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden border-b border-white/10 bg-zinc-900 px-6 py-6">
            <div class="flex flex-col space-y-4 text-base font-medium">
                <a href="#features" class="text-zinc-300 hover:text-white">Features</a>
                <a href="#solutions" class="text-zinc-300 hover:text-white">Solutions</a>
                <a href="#pricing" class="text-zinc-300 hover:text-white">Pricing</a>
                <a href="#docs" class="text-zinc-300 hover:text-white">Documentation</a>
                <hr class="border-white/10 my-2">
                <a href="{{ route('login') }}" class="text-zinc-300 hover:text-white">Sign in</a>
                <a href="{{ route('register') }}" class="inline-flex justify-center rounded-xl bg-indigo-600 py-2.5 text-center text-sm font-semibold text-white shadow-md">
                    Get Started
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Yield Area -->
    <div class="flex-grow">
        @yield('content')
    </div>

    <!-- Global Footer Layout -->
    <footer class="border-t border-white/10 bg-zinc-950 py-12 text-sm text-zinc-400">
        <div class="mx-auto max-w-7xl px-6 lg:px-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-600 text-xs font-bold text-white">
                    A
                </div>
                <span class="text-base font-semibold text-white">Acme Corp</span>
            </div>
            
            <p class="text-xs text-zinc-500">&copy; {{ date('Y') }} Acme Inc. All rights reserved.</p>

            <div class="flex gap-6 text-xs text-zinc-400">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Security</a>
            </div>
        </div>
    </footer>

</body>
</html>