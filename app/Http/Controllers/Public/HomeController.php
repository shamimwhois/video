<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('user')->latest()->paginate(12);

        return view('home.index', compact('posts'));
    }
}
