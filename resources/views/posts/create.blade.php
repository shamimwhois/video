@extends('layouts.app')

@section('title', 'Upload a video')

@section('content')
    <main class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('posts.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">← My videos</a>
            <h1 class="mt-4 text-3xl font-bold tracking-tight">Upload a video</h1>
            <p class="mt-2 text-zinc-600">Add a title, an optional description, and an MP4 or WebM video.</p>
        </div>
        <section class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
            @include('posts._form')
        </section>
    </main>
@endsection
