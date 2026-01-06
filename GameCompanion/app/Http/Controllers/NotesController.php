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

    public function store(Request $request, $gameId)
    {
        $game = Game::findOrFail($gameId);
        $validatedData = $request->validate([
            'note_title' => 'required|string|max:255',
        ]);

        $note = new Note();
        $note->game_id = $game->id;
        $note->note_title = $validatedData['note_title'];
        $note->note_content = '# I <3 cats';
        $note->save();  
        return redirect()->route('games.notes.index', $game->id);      
    }

    public function destroy($noteId)
    {
        $note = Note::findOrFail($noteId);
        
    }
}
