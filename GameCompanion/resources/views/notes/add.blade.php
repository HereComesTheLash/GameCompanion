@extends('layouts.main')

@section('content')
    <main class="container-fluid py-2">
        <h6>TODO: ADD NOTE TITLE INPUT HERE</h6>
        <div class="row g-3 align-items-start">
            <div class="col-12 col-lg-10 col-xl-11">
                <div class="d-flex flex-column gap-3">
                    <textarea class="form-control flex-grow-0 min-vh-50 shadow" id="input" onkeyup="handleInputChange()"></textarea>
                    <div id="display" class="border rounded p-3 bg-light overflow-auto"></div>
                </div>
            </div>
            <div class="col-12 col-lg-2 col-xl-1">
                <div class="d-flex flex-column gap-3">
                    <div class="p-2 border rounded bg-light">
                        Buttons: save, go back to game, TODO: UPLOAD IMAGE BUTTON
                    </div>
                    <div class="p-2 border rounded bg-light overflow-auto">
                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-sm btn-outline-secondary w-100 user-select-all">
                                TODO: IMAGE NAME GOES HERE
                                <button class="btn btn-sm btn-danger h-20px">Delete</button>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        var inputArea = document.getElementById('input');
        var displayArea = document.getElementById('display');

        var testing = `# HTML ALSO WORKS; CLEAN INPUT !
-> https://github.com/cure53/DOMPurify

<img title="a title" alt="Alt text" src="https://cataas.com/cat">


![Alt text](https://cataas.com/cat "a title")
meow
![Alt text](https://cataas.com/cat "a title")
`;

        inputArea.value = testing;

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
        }, 500);

        displayArea.innerHTML = marked.parse(inputArea.value);
    </script>
@endsection
