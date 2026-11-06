<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create account - {{ config('app.name', 'Video Posts') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    <main class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="mx-auto w-full max-w-md">
            <a href="{{ route('home.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">← Home</a>
            <h1 class="mt-8 text-3xl font-bold tracking-tight text-zinc-900">Create your account</h1>
            <p class="mt-2 text-sm text-zinc-600">Already registered? <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Sign in</a></p>

            <form action="{{ route('register.store') }}" method="POST" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-700">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" maxlength="255" required class="mt-2 block w-full rounded-lg border border-zinc-300 px-3.5 py-2.5 text-zinc-900 shadow-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    @error('name')
                        <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required class="mt-2 block w-full rounded-lg border border-zinc-300 px-3.5 py-2.5 text-zinc-900 shadow-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    @error('email')
                        <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required class="mt-2 block w-full rounded-lg border border-zinc-300 px-3.5 py-2.5 text-zinc-900 shadow-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    @error('password')
                        <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" required class="mt-2 block w-full rounded-lg border border-zinc-300 px-3.5 py-2.5 text-zinc-900 shadow-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                </div>
                <button type="submit" class="flex w-full justify-center rounded-lg bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create account</button>
            </form>
        </div>
    </main>
</body>
</html>