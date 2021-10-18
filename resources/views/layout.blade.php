<!DOCTYPE html>
<html>

<head>
    <title>Outlook agenda</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
        <div class="container">
            @if(Session::has('userName'))
            <a href="{{ Route('dashboard') }}" class="navbar-brand">OUTLOOK</a>
            @else
            <a href="/" class="navbar-brand">OUTLOOK</a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav justify-content-end ml-auto">
                    @if(Session::has('userName'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            {{ Session::get('userName') }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ Route('dashboard') }}" class="dropdown-item">Event</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ Route('logout') }}" class="dropdown-item">Sign Out</a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ Route('login') }}" class="nav-link">Sign In</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
