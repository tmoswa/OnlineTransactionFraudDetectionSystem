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
        <main class="py-4">
            @yield('content')
        </main>
    </div>


</body>

<script src="{{URL::to('temp/js/jquery/jquery-2.2.4.min.js')}}"></script>
 
<script src="{{URL::to('temp/js/bootstrap/popper.min.js')}}"></script>

<script src="{{URL::to('temp/js/bootstrap/bootstrap.min.js')}}"></script>

<script src="{{URL::to('temp/js/plugins/plugins.js')}}"></script>

<script src="{{URL::to('temp/js/active.js')}}"></script>
</html>
