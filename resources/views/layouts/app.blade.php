<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fraud Detection System') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

      
<link rel="stylesheet" href="{{URL::to('temp/style.css')}}">

</head>
<body>







    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <header class="header-area">

        <div class="bg-danger">
            &nbsp;
        </div>

        <div class="credit-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container-fluid">
                    <nav class="classy-navbar justify-content-between" id="creditNav">
                        <img src="{{URL::to('img/core-img/logo.jpg')}}" alt="" height="1px" style="padding-left: 40px;">
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>
                        <div class="classy-menu">
                            <div class="classynav" style="font-size: 29px; font-weight: bold;color: white;">
                                Transaction Fraud Detection System 
                            </div>
                        </div>
                        <div class="contact">
                            <a href="#"><img src="{{URL::to('img/core-img/call2.png')}}" alt=""> +263 8677004050</a>
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>










    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" style="background: crimson" href="{{ url('/') }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Main Page &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <a class="nav-link" href="{{route('transact_online')}}" style="background: crimson">{{ __('Transaction Simulation') }}</a>

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
                                    <!--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>-->
                                    <a class="nav-link" href="{{ route('account_register') }}">{{ __('Update Security') }}</a>

                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}">Manage Clients</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Change Password</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <SCRIPT language=Javascript>
        <!--
        function isNumberKey(evt)
        {
           var charCode = (evt.which) ? evt.which : evt.keyCode;
           if (charCode != 46 && charCode > 31 
             && (charCode < 48 || charCode > 57))
              return false;
 
           return true;
        }
        //-->
     </SCRIPT>
</body>


<script src="{{URL::to('temp/js/jquery/jquery-2.2.4.min.js')}}"></script>
 
<script src="{{URL::to('temp/js/bootstrap/popper.min.js')}}"></script>

<script src="{{URL::to('temp/js/bootstrap/bootstrap.min.js')}}"></script>

<script src="{{URL::to('temp/js/plugins/plugins.js')}}"></script>

<script src="{{URL::to('temp/js/active.js')}}"></script>
</html>
