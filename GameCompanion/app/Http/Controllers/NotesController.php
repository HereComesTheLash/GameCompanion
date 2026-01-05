<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Note;

class NotesController extends Controller
{
    public function index($gameId)
    {
        $game = Game::findOrFail($gameId);
        $notes = Note::where('game_id', $gameId)->get();
        return view('notes.index', compact('game', 'notes'));
    }

    public function add($gameId)
    {
        $game = Game::findOrFail($gameId);

        return view('notes.add', compact('game'));
    }
}
