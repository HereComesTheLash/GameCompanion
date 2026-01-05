<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

use App\Services\SteamLibraryService;


class GamesController extends Controller
{
    protected $steamService;

    public function __construct(SteamLibraryService $steamService)
    {
        $this->steamService = $steamService;
    }

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

        $game = Game::findOrFail($id);

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
        $game = Game::findOrFail($id);
        $game->delete();

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
            $game_logo_url = $this->steamService->getGameLogoUrl($steamGame['appid'], $steamGame['img_icon_url']);

            Game::updateOrCreate(
                ['steam_appid' => $steamGame['appid']],
                [
                    'game_name' => $steamGame['name'],
                    'game_description' => 'Imported from Steam',
                    'cover_image_path' => $game_logo_url,
                ]
            );
        }
        
        error_log('Imported ' . count($ownedGames) . ' games from Steam for user ' . $steamId);

        return redirect()->route('games.index')->with('status', 'Games imported from Steam successfully.');
    }
}
