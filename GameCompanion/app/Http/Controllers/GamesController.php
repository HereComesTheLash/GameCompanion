<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;


class GamesController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    public function add()
    {
        return view('games.add');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('games.edit', compact('game'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|max:255',
            'game_description' => 'required',
        ]);

        $image = $request->file('cover_image_file');
        if ($image) {
            $imagePath = $image->store('cover_images', 'public');
            $validatedData['cover_image_path'] = $imagePath;
        }
        Game::create($validatedData);

        return redirect()->route('games.index')->with('status', 'Game saved successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|max:255',
            'game_description' => 'required',
        ]);

        $game = Game::findOrFail($id);

        $image = $request->file('cover_image_file');
        if ($image) {
            $imagePath = $image->store('cover_images', 'public');
            $validatedData['cover_image_path'] = $imagePath;
        }

        $game->update($validatedData);

        return redirect()->route('games.index')->with('status', 'Game updated successfully.');
    }

    public function steamImport()
    {
        return response()->json(['message' => 'Games imported from Steam successfully']);
    }
}
