<?php

namespace App\Http\Controllers;


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

    public function store()
    {
        // Logic to store game data goes here
        return response()->json(['message' => 'Game stored successfully']);
    }
}
