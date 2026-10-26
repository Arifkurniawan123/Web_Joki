<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Validation\PostValidation; // ← IMPORT VALIDASI
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
        $title = 'Data Post';

        return view('admin.post.index', compact('posts', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Post';

        return view('admin.post.create', compact('title'));
    }

    public function store(Request $request)
    {
        // PAKAI VALIDASI BARU
        $validated = $request->validate(
            PostValidation::rules(),
            PostValidation::messages()
        );

        $validated['user_id'] = Auth::id() ?? 1;
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;

        Post::create($validated);

        return redirect()->route('admin.post.index')->with('success', 'Post berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $title = 'Detail Post';

        return view('admin.post.show', compact('title', 'post'));
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $title = 'Edit Post';

        return view('admin.post.edit', compact('title', 'post'));
    }

    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // PAKAI VALIDASI BARU
        $validated = $request->validate(
            PostValidation::rules($post->id),
            PostValidation::messages()
        );

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['published_at'] = $validated['status'] === 'published' 
                                        ? ($post->published_at ?? now())
                                        : null;

        $post->update($validated);

        return redirect()->route('admin.post.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();

        return redirect()->route('admin.post.index')->with('success', 'Post berhasil dihapus.');
    }
}