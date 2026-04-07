@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div id="smooth-wrapper" class="mil-wrapper">

    <div class="mil-preloader">
        <div class="mil-load"></div>
        <p class="h2 mil-mb-30">
            <span class="mil-light mil-counter" data-number="100">100</span>
            <span class="mil-light">%</span>
        </p>
    </div>

    <div class="mil-progress-track">
        <div class="mil-progress"></div>
    </div>

    <div class="progress-wrap active-progress"></div>

    <div class="mil-top-panel">
        <div class="container">
            <a href="{{ route('home') }}" class="mil-logo">
                <img src="{{ asset('template/img/logo.png') }}" alt="Plax" width="83" height="32">
            </a>
            <nav class="mil-top-menu">
                <ul>
                    <li class="mil-has-children">
                        <a href="javascript:void(0)">Home</a>
                        <ul>
                            <li><a href="{{ route('home') }}">Type 1</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('about') }}">About</a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="mil-has-children mil-active">
                        <a href="javascript:void(0)">Blog</a>
                        <ul>
                            <li><a href="{{ route('blog') }}">Blog list</a></li>
                            <li><a href="{{ route('publication') }}">Blog details</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">Contact</a>
                    </li>
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
                <div class="mil-menu-btn">
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div id="smooth-content">

        <div class="mil-banner mil-banner-inner mil-dissolve">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8">
                        <div class="mil-banner-text mil-text-center">
                            <div class="mil-text-m mil-mb-20">Blog</div>
                            <h1 class="mil-mb-60">Your Source of Financial Information</h1>
                            <ul class="mil-breadcrumbs mil-center">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $posts = [
                ['image' => '1.png', 'category' => 'Financial Advice', 'title' => 'How to Send Money Safely'],
                ['image' => '2.png', 'category' => 'Personal Finance', 'title' => 'The Benefits of Using Virtual Cards'],
                ['image' => '3.png', 'category' => 'Business Payments', 'title' => 'How to Optimize Business Payments'],
                ['image' => '4.png', 'category' => 'Financial Inclusion', 'title' => 'The Importance of Financial Inclusion in the world'],
                ['image' => '5.png', 'category' => 'Product Updates', 'title' => 'New Features in Plax Enterprise: What Can You Expect?'],
                ['image' => '6.png', 'category' => 'Savings Tips', 'title' => 'Tips to Save on International Transactions'],
                ['image' => '7.png', 'category' => 'Financial Advice', 'title' => 'How to Send Money Safely'],
                ['image' => '8.png', 'category' => 'Personal Finance', 'title' => 'The Benefits of Using Virtual Cards'],
                ['image' => '9.png', 'category' => 'Business Payments', 'title' => 'How to Optimize Business Payments'],
                ['image' => '10.png', 'category' => 'Financial Inclusion', 'title' => 'The Importance of Financial Inclusion in the world'],
                ['image' => '11.png', 'category' => 'Product Updates', 'title' => 'New Features in Plax Enterprise: What Can You Expect?'],
                ['image' => '12.png', 'category' => 'Savings Tips', 'title' => 'Tips to Save on International Transactions'],
            ];
        @endphp

        <div class="mil-blog-list mil-p-0-160">
            <div class="container">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-xl-4 col-md-6">
                            <a href="{{ route('publication') }}" class="mil-blog-card mil-mb-30 mil-up">
                                <div class="mil-card-cover">
                                    <img
                                        src="{{ asset('template/img/inner-pages/blog/' . $post['image']) }}"
                                        alt="{{ $post['title'] }}"
                                        class="mil-scale-img"
                                        data-value-1="1"
                                        data-value-2="1.2"
                                    >
                                </div>
                                <div class="mil-descr">
                                    <p class="mil-text-xs mil-accent mil-mb-15">{{ $post['category'] }}</p>
                                    <h4>{{ $post['title'] }}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mil-text-center mil-mt-30 mil-up">
                    <a href="#" class="mil-btn mil-m mil-add-arrow">Loads more publications</a>
                </div>
            </div>
        </div>

        <footer class="mil-footer-with-bg mil-p-160-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <a href="{{ route('home') }}" class="mil-footer-logo mil-mb-60">
                            <img src="{{ asset('template/img/logo-2.png') }}" alt="Plax" width="28" height="32">
                        </a>
                    </div>
                    <div class="col-xl-3 mil-mb-60">
                        <h6 class="mil-mb-60">Usefull Links</h6>
                        <ul class="mil-footer-list">
                            <li class="mil-text-m mil-soft mil-mb-15">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="mil-text-m mil-soft mil-mb-15">
                                <a href="{{ route('about') }}">About Us</a>
                            </li>
                            <li class="mil-text-m mil-soft mil-mb-15">
                                <a href="{{ route('contact') }}">Contact Us</a>
                            </li>
                            <li class="mil-text-m mil-soft mil-mb-15">
                                <a href="{{ route('services') }}">Services</a>
                            </li>
                            <li class="mil-text-m mil-soft mil-mb-15">
                                <a href="{{ route('price') }}">Pricing</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 mil-mb-60">
                        <h6 class="mil-mb-60">Help</h6>
                        <ul class="mil-footer-list">
                            <li class="mil-text-m mil-soft mil-mb-15">
                                999 Rue du Cherche-Midi, 7755500666 Paris, <br>France
                            </li>
                            <li class="mil-text-m mil-soft mil-mb-15">
                                +001 (808) 555-0111
                            </li>
                            <li class="mil-text-m mil-soft mil-mb-15">
                                support@plax.network
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 mil-mb-80">
                        <h6 class="mil-mb-60">Newsletter</h6>
                        <p class="mil-text-xs mil-soft mil-mb-15">Subscribe to get the latest news form us</p>
                        <form class="mil-subscripe-form-footer">
                            <input class="mil-input" type="email" placeholder="Email">
                            <button type="submit"><i class="far fa-envelope-open mil-dark"></i></button>
                            <div class="mil-checkbox-frame mil-mt-15">
                                <div class="mil-checkbox">
                                    <input type="checkbox" id="checkbox" checked>
                                    <label for="checkbox"></label>
                                </div>
                                <p class="mil-text-xs mil-soft">Subscribe to get the latest news</p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mil-footer-bottom">
                    <div class="row">
                        <div class="col-xl-6">
                            <p class="mil-text-s mil-soft">© 2024 Plax Finance & Fintech Design</p>
                        </div>
                        <div class="col-xl-6">
                            <p class="mil-text-s mil-text-right mil-sm-text-left mil-soft">
                                Developed by <a href="https://bslthemes.com" target="_blank">bslthemes</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</div>
@endsection
