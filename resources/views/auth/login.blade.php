<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - {{ config('app.name', 'Video Posts') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col lg:flex-row">
        
        <!-- Left Column: Branding / Visual Panel -->
        <div class="relative hidden lg:flex lg:w-1/2 flex-col justify-between bg-zinc-900 px-10 py-12 text-white">
            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-900 via-zinc-900 to-zinc-900 opacity-90"></div>
            
            <!-- Logo / Brand Header -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 font-bold text-lg">
                    A
                </div>
                <span class="text-xl font-semibold tracking-wide">Acme Corp</span>
            </div>

            <!-- Center Quote / Hero text -->
            <div class="relative z-10 my-auto max-w-md">
                <blockquote class="space-y-2">
                    <p class="text-2xl font-medium leading-snug">
                        &ldquo;This platform has completely transformed how our team manages projects and ships products faster.&rdquo;
                    </p>
                    <footer class="text-sm text-zinc-400">Sofia Davis, VP of Engineering</footer>
                </blockquote>
            </div>

            <!-- Footer Meta -->
            <div class="relative z-10 text-xs text-zinc-500">
                &copy; {{ date('Y') }} Acme Inc. All rights reserved.
            </div>
        </div>

        <!-- Right Column: Login Form -->
        <div class="flex flex-1 flex-col justify-center px-6 py-12 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                
                <!-- Heading -->
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Welcome back</h2>
                    <p class="mt-2 text-sm text-zinc-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Create an account</a>
                    </p>
                </div>

                <!-- Session Status / General Notifications -->
                @if (session('status'))
                    <div class="mt-4 rounded-lg bg-emerald-50 p-4 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form -->
                <div class="mt-8">
                    <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700">Email address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    value="{{ old('email') }}"
                                    class="block w-full rounded-lg border border-zinc-300 px-3.5 py-2.5 text-zinc-900 shadow-sm placeholder:text-zinc-400 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20 sm:text-sm">
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium text-zinc-700">Password</label>
                                @if (Route::has('password.request'))
                                    <div class="text-sm">
                                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="block w-full rounded-lg border border-zinc-300 px-3.5 py-2.5 text-zinc-900 shadow-sm placeholder:text-zinc-400 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20 sm:text-sm">
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox" @checked(old('remember'))
                                    class="h-4 w-4 rounded border-zinc-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="remember" class="ml-2 block text-sm text-zinc-700">Remember me</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="flex w-full justify-center rounded-lg bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</body>
</html>