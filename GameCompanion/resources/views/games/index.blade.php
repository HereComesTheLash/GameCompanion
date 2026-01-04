@extends('layouts.main')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h2 class="mb-0">Games Catalogue</h2>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('games.add') }}" class="btn btn-primary">
                                        <i class="fa fa-plus-circle me-2"></i>Add Game
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="GET" action="{{ url()->current() }}" class="row gy-3 gx-2">
                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="search" class="form-control" name="search"
                                            placeholder="Search games..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select id="sort" name="sort" class="form-select">
                                        <option value="" {{ !request()->filled('sort') ? 'selected' : '' }}>Default</option>
                                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name (A–Z)</option>
                                        <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name (Z–A)</option>
                                        <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Recently Added</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 text-md-end">
                                    <button class="btn btn-outline-secondary w-100 w-md-auto" type="submit">Apply</button>
                                </div>
                            </form>

                            @if (session('status'))
                                <div class="alert alert-success mt-4 mb-0">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>

                        <div class="card-body pt-0">
                            @if ($games->count())
                                <div class="catalogue-wrapper p-3 bg-light rounded">
                                    <div class="row g-4">
                                        @foreach ($games as $game)
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                                                <div class="card w-100 h-100 shadow-sm">
                                                    <img class="card-img-top rounded-top"
                                                        src="{{ str_starts_with($game->cover_image_path, 'http') ? $game->cover_image_path : asset('storage/' . $game->cover_image_path) }}"
                                                        alt="{{ $game->game_name }} cover"
                                                        style="width: 100%; aspect-ratio: 2 / 3; object-fit: cover;">
                                                    <div class="card-body d-flex flex-column">
                                                        <h5 class="mb-2">{{ $game->game_name }}</h5>
                                                        <p class="card-text text-muted mb-0">
                                                            {{ $game->game_description }}
                                                        </p>
                                                    </div>
                                                    <div class="card-footer d-flex gap-2 flex-wrap">
                                                        <a href="{{ route('games.notes.index', $game->id) }}" class="btn btn-outline-primary btn-sm">View Notes</a>
                                                        <a href="{{ route('games.edit', $game->id) }}" class="btn btn-primary btn-sm">Edit Details</a>
                                                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this game?');">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5 text-muted">
                                    <i class="fa fa-gamepad fa-2x mb-3 d-block"></i>
                                    No games yet. <a href="{{ route('games.add') }}">Add one.</a>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total games: {{ $games->count() }}</span>
                            <a href="{{ url()->previous() }}" class="btn btn-link text-decoration-none">
                                <i class="fa fa-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
