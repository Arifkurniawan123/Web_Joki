<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Service;

class PublicGameController extends Controller
{
    public function index()
    {
        $games = Game::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $title = 'Semua Game';

        return view('public.games', compact('games', 'title'));
    }

    public function show($slug)
    {
        $game = Game::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $services = Service::where('game_id', $game->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('public.game', compact('game', 'services'));
    }
}