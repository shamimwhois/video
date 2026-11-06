@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <main class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        <a href="{{ route('home.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">← All videos</a>
        <article class="mt-6 overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
            <video src="{{ Storage::disk('public')->url($post->video_path) }}" class="aspect-video w-full bg-black" controls preload="metadata"></video>
            <div class="space-y-4 p-6 sm:p-8">
                <h1 class="text-3xl font-bold tracking-tight">{{ $post->title }}</h1>
                @if ($post->description)
                    <p class="whitespace-pre-line leading-7 text-zinc-700">{{ $post->description }}</p>
                @endif
                <p class="text-sm text-zinc-500">Shared by {{ $post->user->name }} · {{ $post->created_at->format('M j, Y') }}</p>
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="inline-flex rounded-lg border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100">Edit your video</a>
                @endcan
            </div>
        </article>
    </main>
@endsection
