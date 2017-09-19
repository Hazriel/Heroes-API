<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    @yield('styles')
    @yield('scripts')
    @if (isset($pageTitle))
        <title>{{ $pageTitle }} - NeverBackDown</title>
    @else
        <title>NeverBackDown</title>
    @endif
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="nav-logo" href="#">NeverBackDown</a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-list-item @if (isset($pageTitle) && $pageTitle === "Home") active @endif">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-list-item @if (isset($pageTitle) && $pageTitle === "Heroes") active @endif">
                <a class="nav-link" href="{{ route('heroes.view') }}">Heroes</a>
                </li>
                @if (Auth::check())
                    <li class="nav-list-item">
                        <a class="nav-link" href="#">{{ Auth::user()->username }}</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @else
                    <li class="nav-list-item @if (isset($pageTitle) && $pageTitle === "Login") active @endif">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-list-item @if (isset($pageTitle) && $pageTitle === "Register") active @endif">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container body-content">
    @yield('content')
</div>

<footer>
</footer>
</body>
</html>
