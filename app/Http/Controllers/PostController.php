<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Post::class);

        $posts = $request->user()->posts()->latest()->paginate(12);

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        Gate::authorize('create', Post::class);

        $post = new Post;

        return view('posts.create', compact('post'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $videoPath = $request->file('video')?->store('videos', 'public');

        if (! is_string($videoPath)) {
            throw new RuntimeException('The video could not be stored.');
        }

        $post = $request->user()->posts()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'video_path' => $videoPath,
        ]);

        if (! $post->exists) {
            if (Storage::disk('public')->exists($videoPath) && ! Storage::disk('public')->delete($videoPath)) {
                throw new RuntimeException('The uploaded video could not be removed after the post failed to save.');
            }

            throw new RuntimeException('The video post could not be saved.');
        }

        return redirect()->route('posts.index')->with('status', 'Video post created.');
    }

    public function show(Post $post): View
    {
        $post->load('user');

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validated();
        $oldVideoPath = $post->video_path;
        $newVideoPath = null;
        $attributes = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ];

        if ($request->hasFile('video')) {
            $newVideoPath = $request->file('video')?->store('videos', 'public');

            if (! is_string($newVideoPath)) {
                throw new RuntimeException('The replacement video could not be stored.');
            }

            $attributes['video_path'] = $newVideoPath;
        }

        if (! $post->update($attributes)) {
            if ($newVideoPath !== null && Storage::disk('public')->exists($newVideoPath)) {
                if (! Storage::disk('public')->delete($newVideoPath)) {
                    throw new RuntimeException('The replacement video could not be removed after the post failed to update.');
                }
            }

            throw new RuntimeException('The video post could not be updated.');
        }

        if ($newVideoPath !== null && Storage::disk('public')->exists($oldVideoPath)) {
            if (! Storage::disk('public')->delete($oldVideoPath)) {
                throw new RuntimeException('The old video could not be removed from storage.');
            }
        }

        return redirect()->route('posts.index')->with('status', 'Video post updated.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('delete', $post);

        $videoPath = $post->video_path;

        if (! $post->delete()) {
            throw new RuntimeException('The video post could not be deleted.');
        }

        if (Storage::disk('public')->exists($videoPath) && ! Storage::disk('public')->delete($videoPath)) {
            throw new RuntimeException('The video could not be removed from storage.');
        }

        return redirect()->route('posts.index')->with('status', 'Video post deleted.');
    }
}
