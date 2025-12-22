<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;


class GamesController extends Controller
{
    public function index()
    {
        return view('games.index');
    }

    public function add()
    {
        return view('games.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|max:255',
            'game_description' => 'required',
            'cover_image_path' => 'nullable|image|max:2048',
        ]);

        Game::create($validatedData);
    }
}
