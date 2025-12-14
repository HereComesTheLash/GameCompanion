@extends('layouts.main')

@section('content')
    @php
        $key = $_ENV['STEAM_API_KEY'];

        $api = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key={$key}&steamid=76561198864447681&format=json&include_appinfo=true&include_played_free_games=true";
        $json = file_get_contents($api);
        $data = json_decode($json, true);
        $games = $data['response']['games'];
        // Loop over eac game array
        foreach ($games as $game) {
            echo 'Game Name: ' . $game['name'] . '<br>';
            echo 'App ID: ' . $game['appid'] . '<br>';
            echo 'Playtime (minutes): ' . $game['playtime_forever'] . '<br>';
            echo '<hr>';
        }
    @endphp
@endsection
