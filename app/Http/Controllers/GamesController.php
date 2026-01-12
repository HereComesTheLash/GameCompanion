<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\SteamLibraryService;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    protected $steamService;

    public function __construct(SteamLibraryService $steamService)
    {
        $this->steamService = $steamService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $games = Game::where('game_name', 'like', '%'.$search.'%')->get();

            return view('games.index', compact('games', 'search'));
        }
        $sort = $request->input('sort');
        if ($sort === 'name_asc') {
            $games = Game::orderBy('game_name', 'asc')->get();
        } elseif ($sort === 'name_desc') {
            $games = Game::orderBy('game_name', 'desc')->get();
        } elseif ($sort === 'recent') {
            $games = Game::orderby('updated_at', 'desc')->get();
        } else {
            $games = Game::all();
        }

        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function edit($id)
    {
        $game = Game::find($id);

        return view('games.edit', compact('game'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|max:20',
            'game_description' => 'required|max:255',
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
            'game_name' => 'required|max:20',
            'game_description' => 'required|max:255',
        ]);

        $game = Game::find($id);

        $image = $request->file('cover_image_file');
        if ($image) {
            $imagePath = $image->store('cover_images', 'public');
            $validatedData['cover_image_path'] = $imagePath;
        }

        $game->update($validatedData);

        return redirect()->route('games.index')->with('status', 'Game updated successfully.');
    }

    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();
        Storage::disk('public')->delete($game->cover_image_path);
        return redirect()->route('games.index')->with('status', 'Game deleted successfully.');
    }

    public function steamImport(Request $request)
    {
        $request->validate([
            'steam_user_id' => 'required',
        ]);
        $steamId = $request->input('steam_user_id');
        $ownedGames = $this->steamService->fetchOwnedGames($steamId);

        foreach ($ownedGames as $steamGame) {
            $game_logo_url = $this->steamService->getGameLogoUrl($steamGame['appid']);

            Game::updateOrCreate(
                ['steam_appid' => $steamGame['appid']],
                [
                    'game_name' => $steamGame['name'],
                    'game_description' => 'Imported from Steam',
                    'cover_image_path' => $game_logo_url,
                ]
            );
        }

        return redirect()->route('games.index')->with('status', 'Games imported from Steam successfully.');
    }
}
