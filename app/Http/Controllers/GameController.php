<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Validation\GameValidation;
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
    $validated = $request->validate(
        GameValidation::rules(),
        GameValidation::messages()
    );

    $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
    $validated['is_active'] = $request->has('is_active');
    $validated['sort_order'] = $validated['sort_order'] ?? 0;

    Game::create($validated);

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

    $validated = $request->validate(
        GameValidation::rules($game->id),
        GameValidation::messages()
    );

    $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
    $validated['is_active'] = $request->has('is_active');
    $validated['sort_order'] = $validated['sort_order'] ?? 0;

    $game->update($validated);

    return redirect()->route('admin.game.index')->with('success', 'Game berhasil diupdate.');
}
    public function destroy($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game->delete();

        return redirect()->route('admin.game.index')->with('success', 'Game berhasil dihapus.');
    }
}