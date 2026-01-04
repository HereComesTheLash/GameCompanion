@extends('layouts.main')

@section('content')
    <div id="display"></div>
    <textarea class="form-control" id="input" onkeyup="handleInputChange()"></textarea>
    <script>
        var inputArea = document.getElementById('input');
        var displayArea = document.getElementById('display');

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
    </script>
@endsection
