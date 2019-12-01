<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Food@Fit') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon"> --}}
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />

    <style>
        #app{
            position: relative;
            min-height: 100vh;
        }

        #obrazok{
            position: relative;
            top: 100px;
            left: 100px;
            border-radius: 8px;
            /* width: 350px; */
        }

        #popis{
            position: relative;
            top: 140px;
            left: 150px;
        }

        #footer{
            position: absolute;
            bottom: 0;
            left:0;
            width: 100%;
            height: 50px;
            background-color: #d9d9d9;
            margin-top: -50px;
            clear: both;
        }


        .tooltip-wrap {
            position: relative;
            border-bottom: 1px  black;
        }
        .tooltip-wrap .tooltip-content {
            visibility: hidden;
            width: 180px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            top: 150%;
            left: 5%;
            margin-left: -60px;
        }
        .tooltip-wrap .tooltip-content::after {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent black transparent;
        }


        .tooltip-wrap:hover .tooltip-content {
            visibility: visible;
        }
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-backdrop {
            /* bug fix - no overlay */
            display: none;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="height:44px">
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
                            <li class="nav-item" >
                                <a style="margin-top:0px; height:14.4px; padding-top:0;" class="nav-link" href="/provozna"><i class="fas fa-cart-plus">{{ __(' OBJEDNAT') }}</i></a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a style="margin-top:0px; height:14.4px; padding-top:0;" class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus">{{ __(' REGISTROVAT') }}</i></a>
                                </li>
                            @endif
                            <li class="nav-item">
                                    <a style="margin-top:0px; height:14.4px; padding-top:0;" class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt">{{ __(' PŘIHLÁSIT SE') }}</i></a>
                            </li>
                        @else
                            @if ((auth()->user()->role == 'admin') || (auth()->user()->role == 'vodič') || (auth()->user()->role == 'operátor'))
                            <li class="nav-item">
                                <a class="nav-link" href="/plan"><i style="margin-top:3px; height:14.4px" class="fas fa-dolly">{{ __(' PLÁN') }}</i></a>
                            </li>
                            @endif

                            @if ((auth()->user()->role == 'admin') || (auth()->user()->role == 'operátor'))

                            <li class="nav-item">
                                <a  class="nav-link" href="/polozka"><i style="margin-top:3px; height:14.4px" class="fas fa-plus-square">{{ __(' POLOŽKY') }}</i></a>
                            </li>

                            <li class="nav-item">
                                <a  class="nav-link" href="/provozna"><i style="margin-top:3px; height:14.4px" class="fas fa-store-alt">{{ __(' PROVOZOVNY') }}</i></a>
                            </li>
                            @endif

                            @if (auth()->user()->role == 'admin')
                            <li class="nav-item">
                                <a  class="nav-link" href="/users"><i style="margin-top:3px; height:14.4px" class="fas fa-users-cog">{{ __(' UŽÍVATELÉ') }}</i></a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a  class="nav-link" href="/provozna"><i style="margin-top:3px; height:14.4px" class="fas fa-cart-plus">{{ __(' OBJEDNAT') }}</i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="margin-left:20px">
                                    <i class="fas fa-user">{{ " ".Auth::user()->name }}</i> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="/objednavka"
                                    onclick="event.preventDefault();
                                                     document.getElementById('objednavka-form').submit();">
                                        {{ __('Objednávky') }}<i class="float-right fas fa-shopping-cart"></i>
                                    </a>

                                    <form id="objednavka-form" action="/objednavka" method="GET" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="/users/{user}/edit"
                                    onclick="event.preventDefault();
                                                     document.getElementById('edit-form').submit();">
                                        {{ __('Profil') }}<i class="float-right fas fa-user-edit"></i>
                                    </a>

                                    <form id="edit-form" action="/users/{{ auth()->user()->id }}/edit" method="GET" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Odhlásit') }}
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
        {{-- overflow:auto; --}}
        <main class="py-4" style="min-height:100%; padding-bottom:50px;">
                @yield('content')
        </main>
        <footer class="card-footer" id="footer">
            <div class="row">
                <div class="col-12">
                    <div class="footer-copyright text-center ">© 2019 Copyright:
                        <a href="#"> IIS team</a>
                    </div>
                </div>
            </div>
        </footer>
        </div>
    </body>
    </html>
