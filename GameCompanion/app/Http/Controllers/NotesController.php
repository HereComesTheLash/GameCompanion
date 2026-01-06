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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_id' => 'required|exists:games,id',
            'note_title' => 'required|string|max:255',
        ]);

        $note = new Note();
        $note->game_id = $validatedData['game_id'];
        $note->note_title = $validatedData['note_title'];
        $note->note_content = '# I <3 cats';
        $note->save();  
        return redirect()->route('notes.index', ['gameId' => $validatedData['game_id']]);      
    }
}
