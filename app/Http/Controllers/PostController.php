<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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
        Post::create([
            'user_id'      => 1,
            'title'        => $request->title,
            'slug'         => $request->slug ?: Str::slug($request->title),
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'thumbnail'    => $request->thumbnail,
            'category'     => $request->category,
            'status'       => $request->status ?? 'draft',
            'published_at' => $request->status === 'published' ? now() : null,

        ]);
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

        $post->update([
            'user_id'      => 1,
            'title'        => $request->title,
            'slug'         => $request->slug ?: Str::slug($request->title),
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'thumbnail'    => $request->thumbnail,
            'category'     => $request->category,
            'status'       => $request->status ?? 'draft',
            'published_at' => $request->status === 'published'
                ? ($post->published_at ?? now())   // ← pakai yang lama kalau udah ada
                : null,

        ]);

        return redirect()->route('admin.post.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();

        return redirect()->route('admin.post.index')->with('success', 'Post berhasil dihapus.');
    }
}
