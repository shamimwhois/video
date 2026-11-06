@extends('layouts.app')

@section('title', 'Edit video')

@section('content')
    <main class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('posts.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">← My videos</a>
            <h1 class="mt-4 text-3xl font-bold tracking-tight">Edit video</h1>
        </div>
        <section class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
            <video src="{{ Storage::disk('public')->url($post->video_path) }}" class="mb-6 aspect-video w-full rounded-xl bg-black" controls preload="metadata"></video>
            @include('posts._form')
        </section>
    </main>
@endsection
