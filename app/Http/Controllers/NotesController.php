<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index(Request $request, $gameId)
    {
        $search = $request->input('search');
        $game = Game::find($gameId);
        if ($search) {
            $notes = Note::where('game_id', $gameId)
                ->where('note_title', 'like', '%'.$search.'%')
                ->get();

            return view('notes.index', compact('game', 'notes', 'search'));
        }
        $sort = $request->input('sort');
        if ($sort === 'recent') {
            $notes = Note::where('game_id', $gameId)
                ->orderby('updated_at', 'desc')
                ->get();
        } elseif ($sort === 'oldest') {
            $notes = Note::where('game_id', $gameId)
                ->orderby('updated_at', 'asc')
                ->get();
        } else {
            $notes = Note::where('game_id', $gameId)->get();
        }

        return view('notes.index', compact('game', 'notes'));
    }

    public function create($gameId)
    {
        $game = Game::find($gameId);

        return view('notes.create', compact('game'));
    }

    public function store(Request $request, $gameId)
    {
        $game = Game::find($gameId);
        $validatedData = $request->validate([
            'note_title' => 'required|string|max:255',
        ]);

        $note = new Note;
        $note->game_id = $game->id;
        $note->note_title = $validatedData['note_title'];
        $note->note_content = '# New Note';
        $note->save();

        return redirect()->route('games.notes.index', $game->id);
    }

    public function edit($gameId, $noteId)
    {
        $game = Game::find($gameId);
        $note = Note::find($noteId);
        $images = $note->images;

        return view('notes.edit', compact('game', 'note', 'images'));
    }

    public function update(Request $request, $gameId, $noteId)
    {
        $note = Note::find($noteId);
        $validatedData = $request->validate([
            'note_title' => 'required|string|max:255',
            'note_content' => 'required|string',
        ]);
        $note->update($validatedData);

        return redirect()->route('games.notes.index', $gameId);
    }

    public function destroy($gameId, $noteId)
    {
        $note = Note::find($noteId);
        $note->delete();

        return redirect()->route('games.notes.index', $gameId);
    }
}
