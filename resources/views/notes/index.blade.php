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
                                    <h2 class="mb-0">{{ $game->game_name }}</h2>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('games.notes.create', $game->id) }}" class="btn btn-primary">
                                        <i class="fa fa-plus-circle me-2"></i>New Note
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="row gy-3 gx-2">
                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="search" class="form-control" name="search"
                                            placeholder="Search notes..." value="{{ request('search') }}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <select class="form-select" name="sort">
                                        <option value="recent"
                                            {{ request('sort', 'recent') === 'recent' ? 'selected' : '' }}>
                                            Recent first
                                        </option>
                                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                                            Oldest first
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 text-md-end">
                                    <button class="btn btn-outline-secondary w-100 w-md-auto" type="submit">Apply</button>
                                </div>
                            </form>
                        </div>

                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 60px;">#</th>
                                    <th scope="col">Note Title</th>
                                    <th scope="col" style="width: 220px;">Last Updated</th>
                                    <th scope="col" class="text-end" style="width: 200px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notes as $index => $note)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                            {{ $note->note_title }}
                                        </td>
                                        <td>{{ $note->updated_at?->format('M d, Y • H:i') ?? '—' }}</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('games.notes.edit', ['gameId' => $game->id, 'noteId' => $note->id]) }}"
                                                class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('games.notes.destroy', ['gameId' => $game->id, 'noteId' => $note->id]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete this note?');" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fa fa-sticky-note fa-2x mb-3 d-block"></i>
                                            No notes yet. <a href="{{ route('games.notes.create', $game->id) }}">Add one.</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total notes: {{ $notes->count() }}</span>
                            <a href="{{ route('games.index') }}" class="btn btn-link text-decoration-none">
                                <i class="fa fa-arrow-left me-1"></i>Back to games
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
