@extends('layouts.main')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <main class="container-fluid py-2">
        <div class="mb-3 p-3 border rounded bg-light">
            <form method="POST" action="{{ route('games.notes.images.store', [$game->id, $note->id]) }}"
                enctype="multipart/form-data" class="d-flex gap-2 mb-2">
                @csrf
                <input type="file" name="image" class="form-control form-control-sm w-auto">
                <button class="btn btn-sm btn-outline-secondary">Upload</button>
            </form>

            <div class="d-flex flex-row flex-wrap gap-2 align-items-center">
                @forelse ($images as $image)
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary user-select-all">
                            {{ $image->image_name }}
                        </button>

                        <form method="POST"
                            action="{{ route('games.notes.images.destroy', [$game->id, $note->id, $image->id]) }}" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="text-muted small">No images uploaded yet.</div>
                @endforelse
            </div>

            <form method="POST" action="{{ route('games.notes.update', [$game->id, $note->id]) }}">
                @csrf
                @method('PUT')

                <input type="text" name="note_title" class="form-control mb-3 text-center fs-4"
                    value="{{ $note->note_title }}">

                <div class="row g-3">
                    <div class="col-lg-10">
                        <textarea class="form-control min-vh-50 shadow" name="note_content" id="note-content">{{ $note->note_content }}</textarea>

                        <div id="display" class="border rounded p-3 bg-light mt-3 overflow-auto"></div>
                    </div>

                    <div class="col-lg-2">
                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-success">Save</button>
                            <a href="{{ route('games.notes.index', $game->id) }}" class="btn btn-secondary">Go Back</a>
                        </div>
                    </div>
                </div>
            </form>
    </main>

    <script type="module">
        import {
            marked
        } from "https://cdn.jsdelivr.net/npm/marked/lib/marked.esm.js";

        const IMAGE_BASE = '{{ asset('storage/note_images/') }}/';

        const renderer = {
            image({
                href,
                text,
                title
            }) {
                if (!href.startsWith('http')) {
                    href = IMAGE_BASE + href;
                }

                return `<img src="${href}" alt="${text}" title="${title ?? ''}">`;
            }
        };

        marked.use({
            renderer
        });

        const inputArea = document.getElementById('note-content');
        const displayArea = document.getElementById('display');

        const debounce = (callback, wait) => {
            let timeoutId = null;
            return (...args) => {
                window.clearTimeout(timeoutId);
                timeoutId = window.setTimeout(() => {
                    callback(...args);
                }, wait);
            };
        }

        const handleInputChange = debounce(() => {
            displayArea.innerHTML = marked.parse(inputArea.value);
        }, 300);

        inputArea.addEventListener('keyup', handleInputChange);
        displayArea.innerHTML = marked.parse(inputArea.value);
    </script>
@endsection
