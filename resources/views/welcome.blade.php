@extends('layouts.start')

@section('content')
    <div class="hero-area">
        <div class="hero-slideshow owl-carousel">

            <div class="single-slide bg-img">

                <div class="slide-bg-img bg-img bg-overlay" style="background-image: url(img/bg-img/01.jpg);"></div>

                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-9">
                            <div class="welcome-text text-center">
                                <h2 data-animation="fadeInUp" data-delay="300ms">secure your <span>online</span>
                                    transactions <span>now</span></h2>
                                <a href="{{route('letslogin')}}" class="btn credit-btn mt-50" data-animation="fadeInUp"
                                   data-delay="700ms">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-du-indicator"></div>
            </div>


        </div>
    </div>
    &nbsp;
    <div class="copywrite-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="copywrite-text" style="text-align: center;">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | CBZ Holdings. Developed and Hosted by <a href="" target="_blank">Diversion
                            Kudakwashe Machingura.
                    </p>

                </div>
            </div>
        </div>
    </div>

@endsection
