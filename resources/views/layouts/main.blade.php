<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Game Companion</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark gc-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand text-uppercase d-flex flex-column lh-1" href="{{ url('/') }}">
                <span class="gc-brand">
                    <span class="font-weight-bold">GAME</span>
                    <span class="gc-brand-accent">COMPANION</span>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler"
                aria-controls="navbar-toggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-toggler">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('games.index') }}"
                            class="nav-link {{ request()->routeIs('games.*') ? 'active' : '' }}"
                            aria-current="{{ request()->routeIs('games.*') ? 'page' : 'false' }}">
                            <i class="fa fa-gamepad mr-1" aria-hidden="true"></i>
                            Games
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
