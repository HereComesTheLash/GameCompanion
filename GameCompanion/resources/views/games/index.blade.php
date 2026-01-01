@extends('layouts.main')

@section('content')
    <h1>Steam Games</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        @if ($games->count())
            @foreach ($games as $game)
                <div class="col-md-4 mb-4">
                    <div class="card w-50">
                        <img class="card-img-top" src="{{ asset('storage/' . $game->cover_image_path) }}"
                            alt="{{ $game->game_name }}">
                        <div class="card-body">
                            <h5>{{ $game->game_name }}</h5>
                            <p class="card-text text-muted">
                                {{ $game->game_description, 140 }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="text-muted ml-3">No games yet. <a href="{{ route('games.add') }}">Add one.</a></h1>
        @endif
    </div>

    @php
        $key = $_ENV['STEAM_API_KEY'];

        $api = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key={$key}&steamid=76561198864447681&format=json&include_appinfo=true&include_played_free_games=true";
        $json = file_get_contents($api);
        $data = json_decode($json, true);
        $games = $data['response']['games'];
        foreach ($games as $game) {
            echo 'Game Name: ' . $game['name'] . ', ';
            echo 'App ID: ' . $game['appid'] . ', ';
            echo 'Playtime (hours): ' . round($game['playtime_forever'] / 60, 2) . '<br>';
        }
    @endphp
@endsection
