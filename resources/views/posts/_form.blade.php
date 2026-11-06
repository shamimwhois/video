<form action="{{ $post->exists ? route('posts.update', $post) : route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if ($post->exists)
        @method('PUT')
    @endif

    <div>
        <label for="title" class="block text-sm font-medium text-zinc-700">Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $post->title) }}" maxlength="255" required class="mt-2 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
        @error('title')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-zinc-700">Description <span class="font-normal text-zinc-500">(optional)</span></label>
        <textarea id="description" name="description" rows="5" maxlength="5000" class="mt-2 block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">{{ old('description', $post->description) }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="video" class="block text-sm font-medium text-zinc-700">{{ $post->exists ? 'Replace video (optional)' : 'Video file' }}</label>
        <input id="video" name="video" type="file" accept="video/mp4,video/webm,.mp4,.webm" @required(! $post->exists) class="mt-2 block w-full rounded-lg border border-zinc-300 bg-white text-sm text-zinc-700 file:mr-4 file:border-0 file:bg-zinc-100 file:px-4 file:py-2.5 file:font-medium file:text-zinc-700 hover:file:bg-zinc-200">
        <p class="mt-2 text-sm text-zinc-500">MP4 or WebM, up to 100 MB.</p>
        @error('video')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap gap-3">
        <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-500">{{ $post->exists ? 'Save changes' : 'Publish video' }}</button>
        <a href="{{ route('posts.index') }}" class="rounded-lg border border-zinc-300 px-5 py-3 font-semibold text-zinc-700 hover:bg-zinc-100">Cancel</a>
    </div>
</form>
