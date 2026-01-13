<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SteamLibraryService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = $_ENV['STEAM_API_KEY'];
    }

    public function fetchOwnedGames($steamId)
    {
        // http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=XXXXXX&steamid=76561198864447681&include_appinfo=1&include_played_free_games=1&format=json
        $response = Http::get('http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/', [
            'key' => $this->apiKey,
            'steamid' => $steamId,
            'include_appinfo' => true,
            'include_played_free_games' => true,
            'format' => 'json',
        ]);
        
        if ($response->successful()) {
            return $response->json()['response']['games'] ?? [];
        }

        return [];
    }

    // http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=8E15CF96F188A2BACFDA8FEC2BAD9BCA&steamids=76561198864447681
    public function isUserIdValid($steamId) {

    }
    public function getGameLogoUrl($steamAppId)
    {
        // https://steamcdn-a.akamaihd.net/steam/apps/2357570/library_600x900_2x.jpg
        $url = "https://steamcdn-a.akamaihd.net/steam/apps/{$steamAppId}/library_600x900_2x.jpg";
        return $url;
    }
}