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
}
