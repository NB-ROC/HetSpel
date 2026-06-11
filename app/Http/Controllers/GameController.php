<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
        public function index()
    {
        $games = Game::query()
            ->where('player_x_id', Auth::id())
            ->orWhere('player_o_id', Auth::id())
            ->latest()
            ->get();

        return view('games.index', compact('games'));
    }

    public function create()
    {
        $players = User::query()
            ->where('id', '!=', Auth::id())
            ->orderBy('name')
            ->get();

        return view('games.create', compact('players'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'opponent_id' => ['required', 'exists:users,id'],
        ]);

        $game = Game::create([
            'player_x_id' => Auth::id(),
            'player_o_id' => $validated['opponent_id'],
            'status' => Game::STATUS_ACTIVE,
            'current_turn' => 'X',
            'started_at' => now(),
        ]);

        return redirect()->route('games.show', $game);
    }

    public function show(Game $game)
    {
        $game->load([
            'playerX',
            'playerO',
            'winner',
            'rounds.player',
        ]);

        return view('games.show', compact('game'));
    }
}
