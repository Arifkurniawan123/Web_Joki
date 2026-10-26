<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->paginate(9);

        $title = 'Artikel & Promo';

        return view('public.artikel.index', compact('posts', 'title'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        // Artikel terkait (kategori sama, exclude diri sendiri)
        $related = Post::where('status', 'published')
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $title = $post->title;

        return view('public.artikel.show', compact('post', 'related', 'title'));
    }
}