<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $games = Game::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $posts = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('public.home', compact('games', 'posts'));
    }
}