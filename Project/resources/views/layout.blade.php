<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','IIS')</title>
    {{-- <link rel="stylesheet" type="text/css" href="/css"> --}}

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    {{ config('app.name', 'Food@Fit') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- Objednavky --}}
                                    <a class="dropdown-item" href="/users/{user}/edit"
                                    onclick="event.preventDefault();
                                                     document.getElementById('edit-form').submit();">
                                        {{ __('Objednávky') }}
                                    </a>

                                    <form id="edit-form" action="/objednavka" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                    {{-- Editovanie profilu    --}}
                                    <a class="dropdown-item" href="/users/{user}/edit"
                                    onclick="event.preventDefault();
                                                     document.getElementById('edit-form').submit();">
                                        {{ __('Editovat profil') }}
                                    </a>

                                    <form id="edit-form" action="/users/{{ auth()->user()->id }}/edit" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                    {{-- Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Odhlásit se') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <!-- writing out the contetn of welcome.blade.php -->
    @yield('content')
        {{-- <h1>Welcome!</h1> --}}

   {{-- <script src="/js/app.js"></script>      --}}
</body>
</html>
