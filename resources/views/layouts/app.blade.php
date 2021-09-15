<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config("app.name", "Bool n Roll") }}</title> --}}
    {{-- <title>Bool 'n' Roll</title> --}}
    @yield('title')

    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.31.1/js/dropin.min.js"></script> --}}
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm bg-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="height: 50px;" src="{{ asset('images/logorock.png') }}" alt="">
                </a>
                <button class="navbar-toggler btn-orange" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item btn-orange btn login-link">
                                <a class="text-white" href="{{ route('login') }}"><i class="fas fa-user-alt"></i> {{ __('Login') }}</a>
                                
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item btn custom-margin register-link">
                                    <a class="title-orange" href="{{ route('register') }}"><i class="fas fa-guitar"></i> {{ __('Sei un musicista? Registrati!') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown --mod">
                                
                                    <a id="navbarDropdown" class="nav-link title-orange d-flex align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @if (Auth::user()->musician && Auth::user()->musician->cover)
                                            <img class="mini-img mr-2" src="{{ asset('storage/'.Auth::user()->musician->cover) }}" alt=""> {{ ucfirst(Auth::user()->name) }}
                                        @else
                                            <img class="mini-img mr-2" src="{{ asset('/images/avatar.png') }}" alt="Profile Image"> {{ ucfirst(Auth::user()->name) }}
                                        @endif
                                    </a>
                                

                                <div  class="dropdown-menu custom-border dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item custom-drop title-orange" href="/admin">
                                        <i class="fas fa-compact-disc"></i> Dashboard
                                    </a>
                                    @if (Auth::user()->musician && Auth::user()->musician->slug)
                                        <a class="dropdown-item custom-drop title-orange" href="/admin/musicians/{{Auth::user()->musician->slug}}">
                                            <i class="fas fa-user-alt"></i> Profilo
                                        </a>
                                    @endif
                                    <a class="dropdown-item custom-drop title-orange" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }} 
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
            
                <i onclick="topFunction()" id="myBtn" title="Torna su" class="fas fa-arrow-circle-up animate__animated animate__fadeInDownBig"></i>
            
        </main>

        <footer class="bg-dark text-white hide-footer" id="footer" style="padding: 70px 0;">
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
                <div class="row mt-5">
                    <div class="col-xs-12 col-md-6 col-lg-3 text-center animate__animated animate__zoomIn animate__delay-1s">
                        <i class="fab fa-youtube title-pink fa-2x social-footer"></i>
                        
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3 text-center animate__animated animate__zoomIn animate__delay-1s">
                        <i class="fab fa-twitter title-orange fa-2x social-footer"></i>
                        
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3 text-center animate__animated animate__zoomIn animate__delay-1s">
                        <i class="fab fa-facebook title-yellow fa-2x social-footer"></i>
                        
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3 text-center animate__animated animate__zoomIn animate__delay-1s">
                        <i class="fab fa-linkedin title-petrol fa-2x social-footer"></i>
                        
                    </div>

                </div>

            </div>
        </footer>
    </div>


    {{-- ho spostato app.js qui e messo questo @stack per contenere lo script di cahrt.js proveniente da stats.blade --}}
    <script src="{{ asset('js/app.js') }}"></script>
    

    
    @stack('script')

    {{-- script per bottone di risalita --}}
    <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");
        
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
          if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            mybutton.style.display = "block";

          } else {
            mybutton.style.display = "none";
          }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          window.scrollTo({top: 0, behavior: 'smooth'});
        }
    </script>

    <script>
        setTimeout(function(){
            document.getElementById('footer').classList.remove('hide-footer');
        }, 3000);
    </script>

    {{-- jQuery per smooth toggle sotto i 768px --}}
    <script>
         $(document).ready(function() {
            
            $(".nav-link").click(function() {

                $('.dropdown-menu-right').toggle("slow", function () {
                    $('.dropdown-item').show(400, "ease-in-out")
                });
                
                
            });
        });
    </script>
</body>
</html>
