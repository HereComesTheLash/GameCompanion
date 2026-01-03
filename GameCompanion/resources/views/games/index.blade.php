@extends('layouts.main')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h1 class="mb-1">Steam Games Catalogue</h1>
            <p class="text-muted mb-0">Browse and manage your library at a glance.</p>
        </div>
        @if ($games->count())
            <form method="GET" action="{{ url()->current() }}" class="form-inline">
                <label for="sort" class="mr-2 text-muted">Sort by</label>
                <select id="sort" name="sort" class="form-control" onchange="this.form.submit()">
                    <option value="" {{ !request()->filled('sort') ? 'selected' : '' }}>Default</option>
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name (A–Z)</option>
                    <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name (Z–A)</option>
                    <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Recently Added</option>
                </select>
            </form>
        @endif
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

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
                                <a href="" class="btn btn-outline-primary btn-sm">View Note</a>
                                <a href="{{ route('games.edit', $game->id) }}" class="btn btn-primary btn-sm">Edit
                                    Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h1 class="text-muted ml-3">No games yet. <a href="{{ route('games.add') }}">Add one.</a></h1>
    @endif
@endsection
