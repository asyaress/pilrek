@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div id="smooth-wrapper" class="mil-wrapper">

    <!-- preloader -->
    <div class="mil-preloader">
        <div class="mil-load"></div>
        <p class="h2 mil-mb-30">
            <span class="mil-light mil-counter" data-number="100">100</span>
            <span class="mil-light">%</span>
        </p>
    </div>

    <!-- scroll progress -->
    <div class="mil-progress-track">
        <div class="mil-progress"></div>
    </div>

    <!-- back to top -->
    <div class="progress-wrap active-progress"></div>

    <!-- top panel -->
    <div class="mil-top-panel">
        <div class="container">
            <a href="{{ route('home') }}" class="mil-logo">
                <img src="{{ asset('template/img/logo.png') }}" alt="Plax" width="83" height="32">
            </a>

            <nav class="mil-top-menu">
                <ul>
                    <li class="mil-active">
                        <a href="{{ route('home') }}">Home</a>
                    </li>

                    <li><a href="{{ route('about') }}">Timeline</a></li>
                    <li><a href="{{ route('services') }}">Calon Rektor</a></li>

                    <li class="mil-has-children">
                        <a href="javascript:void(0)">Blog</a>
                        <ul>
                            <li><a href="{{ route('blog') }}">Blog list</a></li>
                            <li><a href="{{ route('publication') }}">Blog details</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('contact') }}">Contact</a></li>

                    <li class="mil-has-children">
                        <a href="javascript:void(0)">Pages</a>
                        <ul>
                            <li><a href="{{ route('career') }}">Career</a></li>
                            <li><a href="{{ route('career.details') }}">Career details</a></li>
                            <li><a href="{{ route('price') }}">Pricing</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="mil-menu-buttons">
                <a href="{{ route('register') }}" class="mil-btn mil-sm">Log in</a>
                <div class="mil-menu-btn"><span></span></div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div id="smooth-content">

        <!-- banner -->
        <div class="mil-banner mil-dissolve">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6">
                        <div class="mil-banner-text">
                            <h6 class="mil-text-gradient-2 mil-mb-20">Send money globally with Plax</h6>
                            <h1 class="mil-display mil-text-gradient-3 mil-mb-60">Your Ally for Financial Control</h1>
                            <div class="mil-buttons-frame">
                                <a href="{{ route('register') }}" class="mil-btn mil-md mil-add-arrow">Try demo</a>
                                <a href="https://www.youtube.com/watch?v=gRhoYxy9Oss" class="mil-btn mil-md mil-light mil-add-play has-popup-video">Watch tutorial</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mil-banner-img">
                            <img src="{{ asset('template/img/home-2/1.png') }}" alt="banner" style="max-width: 135%; transform: translateX(5%)">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- brands -->
        <div class="mil-brands mil-p-160-160">
            <div class="container">
                <h5 class="mil-text-center mil-soft mil-mb-60 mil-up">Join over 7,000 satisfied customers who enjoy our service!</h5>
                <div class="row justify-content-center">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-3 col-md-2 mil-text-center">
                            <div class="mil-brand">
                                <img src="{{ asset('template/img/brands/' . $i . '.svg') }}" alt="brand">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- features -->
        <div class="mil-features mil-p-0-80">
            <div class="container">
                <div class="row flex-sm-row-reverse align-items-center">
                    <div class="col-xl-6">
                        <h2>Our essence, your experience</h2>
                        <p class="mil-text-m mil-soft">Visualize your financial progress with detailed reports and graphs.</p>
                    </div>
                    <div class="col-xl-6">
                        <img src="{{ asset('template/img/home-2/2.png') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mil-cta">
            <div class="container text-center">
                <h2>Protected coverage on your purchases</h2>
                <p>Enjoy instant protection for 45 days.</p>
                <img src="{{ asset('template/img/home-2/3.png') }}" alt="illustration">
            </div>
        </div>

        <!-- icons -->
        <div class="icon-boxes">
            <div class="container">
                <div class="row">
                    @foreach ([1,2,3] as $i)
                        <div class="col-xl-4">
                            <div class="mil-icon-box">
                                <img src="{{ asset('template/img/home-2/icons/'.$i.'.svg') }}" alt="icon">
                                <h5>Feature {{ $i }}</h5>
                                <p>Short description here.</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- testimonials -->
        <div class="mil-testimonials">
            <div class="container">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ([1,2,3] as $i)
                        <div class="swiper-slide">
                            <blockquote>
                                <p>Sample testimonial text.</p>
                                <div class="mil-customer">
                                    <img src="{{ asset('template/img/faces/'.$i.'.jpg') }}">
                                    <h6>User {{ $i }}</h6>
                                </div>
                            </blockquote>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer class="mil-footer-with-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <img src="{{ asset('template/img/logo-2.png') }}" width="28">
                    </div>
                    <div class="col-xl-3">
                        <h6>Links</h6>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                        </ul>
                    </div>
                </div>
                <div class="text-center">
                    <p>© 2024 Plax</p>
                </div>
            </div>
        </footer>

    </div>
</div>

@endsection