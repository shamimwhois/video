@extends('layouts.app')

@section('content')
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <section class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Video community</p>
                <h1 class="mt-2 text-4xl font-bold tracking-tight text-zinc-900 sm:text-5xl">Watch and share videos</h1>
                <p class="mt-3 max-w-2xl text-lg text-zinc-600">Discover the latest videos from the community.</p>
            </div>
            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-500">Share a video</a>
            @else
                <a href="{{ route('posts.create') }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-500">Upload a video</a>
            @endguest
        </section>

        @if ($posts->isEmpty())
            <section class="rounded-2xl border border-dashed border-zinc-300 bg-white px-6 py-16 text-center">
                <h2 class="text-xl font-semibold text-zinc-900">No videos yet</h2>
                <p class="mt-2 text-zinc-600">Be the first to share a video with the community.</p>
            </section>
        @else
            <section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <article class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                        <video src="{{ Storage::disk('public')->url($post->video_path) }}" class="aspect-video w-full bg-black object-contain" controls preload="metadata"></video>
                        <div class="space-y-3 p-5">
                            <h2 class="text-lg font-semibold text-zinc-900">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600">{{ $post->title }}</a>
                            </h2>
                            @if ($post->description)
                                <p class="line-clamp-3 text-sm leading-6 text-zinc-600">{{ $post->description }}</p>
                            @endif
                            <p class="text-xs text-zinc-500">By {{ $post->user->name }} · {{ $post->created_at->format('M j, Y') }}</p>
                        </div>
                    </article>
                @endforeach
            </section>

            <div class="mt-8">{{ $posts->links() }}</div>
        @endif
    </main>
@endsection