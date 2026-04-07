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
    @include('partials.navbar', ['activePage' => 'informasi'])



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
        @include('partials.footer')

    </div>
</div>
@endsection

