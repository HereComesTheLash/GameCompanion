@extends('layouts.main')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title">
                            <strong>Add New Note</strong>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('games.notes.store', $game->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method($formMethod ?? 'POST')
                                        <input type="hidden" name="game_id" value="{{ $game->id }}">

                                        <!-- Note Title -->
                                        <div class="form-group row mb-3">
                                            <label for="note_title" class="col-md-3 col-form-label">Note Title</label>
                                            <div class="col-md-9">
                                                <input type="text" name="note_title" id="note_title" class="form-control"
                                                    value="{{ old('note_title') }}" placeholder="Enter note title">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-9 offset-md-3">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
                                                <a href="{{ route('games.notes.index', $game->id) }}"
                                                    class="btn btn-outline-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
