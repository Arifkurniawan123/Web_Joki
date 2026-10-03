<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('sort_order')->orderBy('name')->get();
        $title = 'Data Game';

        return view('admin.game.index', compact('games', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Game';

        return view('admin.game.create', compact('title'));
    }

    public function store(Request $request)
    {
        Game::create([
            'name'        => $request->name,
            'slug'        => $request->slug ?: Str::slug($request->name),
            'description' => $request->description,
            'image'       => $request->image,
            'is_active'   => $request->has('is_active'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.game.index')->with('success', 'Game berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $game  = Game::where('slug', $slug)->firstOrFail();
        $title = 'Detail Game';

        return view('admin.game.show', compact('title', 'game'));
    }

    public function edit($slug)
    {
        $game  = Game::where('slug', $slug)->firstOrFail();
        $title = 'Edit Game';

        return view('admin.game.edit', compact('title', 'game'));
    }

    public function update(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();

        $game->update([
            'name'        => $request->name,
            'slug'        => $request->slug ?: Str::slug($request->name),
            'description' => $request->description,
            'image'       => $request->image,
            'is_active'   => $request->has('is_active'),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.game.index')->with('success', 'Game berhasil diupdate.');
    }

    public function destroy($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game->delete();

        return redirect()->route('admin.game.index')->with('success', 'Game berhasil dihapus.');
    }
}