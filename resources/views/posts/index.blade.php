@extends('layouts.app')

@section('title', 'My videos')

@section('content')
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">My videos</h1>
                <p class="mt-2 text-zinc-600">Manage the videos you have shared.</p>
            </div>
            <a href="{{ route('posts.create') }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-500">Upload a video</a>
        </div>

        @if ($posts->isEmpty())
            <section class="rounded-2xl border border-dashed border-zinc-300 bg-white px-6 py-16 text-center">
                <h2 class="text-xl font-semibold">You have not shared a video yet.</h2>
                <p class="mt-2 text-zinc-600">Upload your first video to get started.</p>
                <a href="{{ route('posts.create') }}" class="mt-5 inline-flex rounded-lg bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-500">Upload a video</a>
            </section>
        @else
            <section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <article class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm">
                        <video src="{{ Storage::disk('public')->url($post->video_path) }}" class="aspect-video w-full bg-black object-contain" controls preload="metadata"></video>
                        <div class="space-y-4 p-5">
                            <div>
                                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                                @if ($post->description)
                                    <p class="mt-2 line-clamp-3 text-sm leading-6 text-zinc-600">{{ $post->description }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('posts.edit', $post) }}" class="rounded-lg border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this video post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg border border-rose-200 px-4 py-2 text-sm font-medium text-rose-700 hover:bg-rose-50">Delete</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
            <div class="mt-8">{{ $posts->links() }}</div>
        @endif
    </main>
@endsection
