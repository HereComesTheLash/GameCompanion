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
                                    @include('games.partials.form', [
                                        'formAction' => route('games.store'),
                                        'formMethod' => 'POST',
                                        'submitLabel' => 'Save',
                                        'game' => null,
                                    ])

                                    <hr>

                                    <form method="POST" action="{{ route('games.steam.import') }}">
                                        @csrf
                                        <div class="form-group row mt-3">
                                            <label for="steam_user_id" class="col-md-3 col-form-label">Steam User ID</label>
                                            <div class="col-md-6">
                                                <input type="text" name="steam_user_id" id="steam_user_id"
                                                    class="form-control" placeholder="Enter Steam User ID">
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