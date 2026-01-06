@extends('layouts.main')

@section('content')
    {{ $game }}
    <main class="container-fluid py-2">
        <form method="post" action="{{ route('notes.store', ['id' => $game]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="game-id" value="{{ $game }}">
            <input type="text" name="note_title" id="note-title" class="form-control mb-3 text-center"
                placeholder="Note Title">
            <div class="row g-3 align-items-start">
                <div class="col-12 col-lg-10 col-xl-11">
                    <div class="d-flex flex-column gap-3">
                        <textarea class="form-control flex-grow-0 min-vh-50 shadow" name="note_content" id="note-content"></textarea>
                        <div id="display" class="border rounded p-3 bg-light overflow-auto"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-2 col-xl-1">
                    <div class="d-flex flex-column gap-3">
                        <div class="p-2 border rounded bg-light">
                            <div class="d-flex flex-column gap-2 mb-2">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ route('games.notes.index', ['id' => $game]) }}" class="btn btn-secondary">
                                    Go Back
                                </a>
                                <label for="image-upload" class="btn btn-sm btn-outline-secondary w-100">Upload
                                    Image</label>
                                <input type="file" id="image-upload" name="image_upload" class="form-control d-none">
                            </div>
                        </div>
                        {{-- <div class="p-2 border rounded bg-light overflow-auto">
                            <div class="d-flex flex-column gap-2">
                                <button class="btn btn-sm btn-outline-secondary w-100 user-select-all">
                                    TODO: IMAGE NAME GOES HERE
                                    <button class="btn btn-sm btn-danger h-20px">Delete</button>
                                </button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script type="module">
        import {
            marked
        } from "https://cdn.jsdelivr.net/npm/marked/lib/marked.esm.js";

        const IMAGE_BASE = '{{ asset('storage/cover_images/') }}/';

        const renderer = {
            image({
                href,
                text,
                title
            }) {
                if (!href.startsWith('http') && !href.startsWith('/')) {
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

        const debounce = (cb, wait) => {
            let t;
            return () => {
                clearTimeout(t);
                t = setTimeout(cb, wait);
            };
        };

        const handleInputChange = debounce(() => {
            displayArea.innerHTML = marked.parse(inputArea.value);
        }, 300);

        inputArea.addEventListener('keyup', handleInputChange);
        displayArea.innerHTML = marked.parse(inputArea.value);
    </script>
@endsection
