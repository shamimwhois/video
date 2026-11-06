<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('homepage displays public video posts', function () {
    $post = Post::factory()->create([
        'title' => 'A community video',
    ]);

    $this->get(route('home.index'))
        ->assertOk()
        ->assertSee('A community video')
        ->assertSee(route('posts.show', $post), false);
});

test('a video detail page is public', function () {
    $post = Post::factory()->create([
        'title' => 'A public video',
    ]);

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee('A public video');
});

test('guests are redirected to sign in before managing videos', function () {
    $this->get(route('posts.create'))
        ->assertRedirect(route('login'));
});

test('an authenticated user can view the upload form', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('posts.create'))
        ->assertOk()
        ->assertSee('multipart/form-data');
});

test('a visitor can create an account and is signed in', function () {
    $this->post(route('register.store'), [
        'name' => 'Video Creator',
        'email' => 'creator@example.com',
        'password' => 'secure-password',
        'password_confirmation' => 'secure-password',
    ])->assertRedirect(route('posts.index'));

    $user = User::query()->where('email', 'creator@example.com')->firstOrFail();

    $this->assertAuthenticatedAs($user);
});

test('a registered user can sign in', function () {
    $user = User::factory()->create();

    $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('posts.index'));

    $this->assertAuthenticatedAs($user);
});

test('an owner can upload a video post', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $video = UploadedFile::fake()->create('community-video.mp4', 10, 'video/mp4');

    $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'My first video',
        'description' => 'A short description.',
        'video' => $video,
    ])->assertRedirect(route('posts.index'));

    $post = Post::query()->where('title', 'My first video')->firstOrFail();

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'user_id' => $user->id,
        'title' => 'My first video',
    ]);
    Storage::disk('public')->assertExists($post->video_path);
});

test('an invalid upload is rejected without creating a post', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $image = UploadedFile::fake()->create('not-a-video.txt', 1, 'text/plain');

    $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'Invalid video',
        'video' => $image,
    ])->assertSessionHasErrors('video');

    $this->assertDatabaseCount('posts', 0);
    $this->assertSame([], Storage::disk('public')->allFiles());
});

test('a user cannot update another users video post', function () {
    $owner = User::factory()->create();
    $anotherUser = User::factory()->create();
    $post = Post::factory()->for($owner)->create();

    $this->actingAs($anotherUser)->put(route('posts.update', $post), [
        'title' => 'Changed by another user',
    ])->assertForbidden();

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => $post->title,
    ]);
});

test('an owner can view the edit form for their video', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create();

    $this->actingAs($user)
        ->get(route('posts.edit', $post))
        ->assertOk()
        ->assertSee('Replace video');
});

test('an owner can replace their video and the old file is removed', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $oldVideoPath = UploadedFile::fake()->create('old-video.mp4', 10, 'video/mp4')
        ->store('videos', 'public');
    $post = Post::factory()->for($user)->create([
        'video_path' => $oldVideoPath,
    ]);
    $newVideo = UploadedFile::fake()->create('new-video.webm', 10, 'video/webm');

    $this->actingAs($user)->put(route('posts.update', $post), [
        'title' => 'Updated video',
        'video' => $newVideo,
    ])->assertRedirect(route('posts.index'));

    $post->refresh();

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated video',
    ]);
    Storage::disk('public')->assertMissing($oldVideoPath);
    Storage::disk('public')->assertExists($post->video_path);
});

test('an owner can delete their video and its stored file', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    Storage::disk('public')->put('videos/owned-video.mp4', 'fake video');
    $post = Post::factory()->for($user)->create([
        'video_path' => 'videos/owned-video.mp4',
    ]);

    $this->actingAs($user)->delete(route('posts.destroy', $post))
        ->assertRedirect(route('posts.index'));

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
    Storage::disk('public')->assertMissing('videos/owned-video.mp4');
});
