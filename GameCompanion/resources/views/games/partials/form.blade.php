<form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
    @csrf
    @method($formMethod ?? 'POST')

    <div class="form-group row mb-3">
        <label for="game_name" class="col-md-3 col-form-label">Game Name</label>
        <div class="col-md-9">
            <input
                type="text"
                name="game_name"
                id="game_name"
                class="form-control"
                value="{{ old('game_name', optional($game ?? null)->game_name) }}"
            >
        </div>
    </div>

    <div class="form-group row mb-3">
        <label for="game_description" class="col-md-3 col-form-label">Description</label>
        <div class="col-md-9">
            <textarea name="game_description" id="game_description" rows="4" class="form-control">{{ old('game_description', optional($game ?? null)->game_description) }}</textarea>
        </div>
    </div>

    <div class="form-group row mb-3">
        <label for="cover_image_file" class="col-md-3 col-form-label">Cover Image File</label>
        <div class="col-md-9">
            <input type="file" name="cover_image_file" id="cover_image_file" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-9 offset-md-3">
            <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
            <a href="{{ $cancelUrl ?? route('games.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</form>
