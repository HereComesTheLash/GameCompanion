@extends('layouts.main')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title">
                            <strong>Add New Game</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('games.store') }}" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="game_name" class="col-md-3 col-form-label">Game Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="game_name" id="game_name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="game_description"
                                                class="col-md-3 col-form-label">Description</label>
                                            <div class="col-md-9">
                                                <textarea name="game_description" id="game_description" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="cover_image_file" class="col-md-3 col-form-label">Cover Image
                                                File</label>
                                            <div class="col-md-9">
                                                <input type="file" name="cover_image_file" id="cover_image_file"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-9 offset-md-3">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="{{ route('games.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </form>

                                    <hr>

                                    <form method="POST" action="{{ route('games.steam.import') }}">
                                        @csrf
                                        <div class="form-group row mt-3">
                                            <label for="steam_user_id" class="col-md-3 col-form-label">Steam User ID</label>
                                            <div class="col-md-6">
                                                <input type="text" name="steam_user_id" id="steam_user_id" class="form-control" placeholder="Enter Steam User ID">
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-secondary w-100">Load Games</button>
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
