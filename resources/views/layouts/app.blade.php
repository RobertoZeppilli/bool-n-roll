<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config("app.name", "Bool n Roll") }}</title> --}}
    <title>Bool 'n' Roll</title>

   
    
    
    {{-- <script type="aplication/javascript" src="demo_defer.js" defer></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> --}}

    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md  shadow-sm bg-nav fixed-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="height: 50px;" src="{{ asset('images/logorock.png') }}" alt="">
                </a>
                <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item login-link rounded ml-2">
                                <a class="nav-link text-white px-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item register-link rounded ml-2">
                                    <a class="nav-link title-orange px-2" href="{{ route('register') }}">{{ __('Sei un musicista? Registrati!') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle title-orange" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ ucfirst(Auth::user()->name) }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/admin">
                                        Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row text-center">
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <img style="height: 50px;" src="{{ asset('/images/footer-logo.png') }}" alt="">
                        <h5 class="my-3">Made with <span class="title-pink">&hearts;</span> from Team 4</h5>
                    </div>

                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <h5>Dev Team</h5>
                        <ul class="list-unstyled">
                            <li><a class="footer-list title-yellow" href="https://github.com/RobertoZeppilli">Roberto Zeppilli</a></li>
                            <li><a class="footer-list title-petrol" href="https://github.com/Edomak">Edoardo Maccherini</a></li>
                            <li><a class="footer-list title-orange" href="https://github.com/fabiopiro">Fabio Piroddi</a></li>
                            <li><a class="footer-list title-pink" href="https://github.com/michelafranchini">Michela Franchini</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <h5 class="my-3">Sei un musicista?</h5>
                        <ul class="list-unstyled">
                            <li class="nav-item register-link rounded">
                                <a class="nav-link title-orange" href="{{ route('register') }}">{{ __('Registrati subito!') }}</a>
                            </li>
                        </ul>
                    </div>
                    
                    
                </div>

            </div>
        </footer>
    </div>


    {{-- ho spostato app.js qui e messo questo @stack per contenere lo script di cahrt.js proveniente da stats.blade --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('script')
    

    
</body>
</html>
