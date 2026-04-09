@extends('layouts.app')

@section('title', 'Pendaftaran | Pilrek Unmul 2026-2030')

@section('content')
    <div id="smooth-wrapper" class="mil-wrapper">
        <div class="mil-preloader">
            <div class="mil-load"></div>
            <p class="h2 mil-mb-30"><span class="mil-light mil-counter" data-number="100">100</span><span
                    class="mil-light">%</span></p>
        </div>

        <div class="mil-progress-track">
            <div class="mil-progress"></div>
        </div>

        <div class="progress-wrap active-progress"></div>
        @include('partials.navbar', ['activePage' => 'pendaftaran'])

        <div id="smooth-content">
            <div class="mil-banner mil-banner-inner mil-dissolve">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8">
                            <div class="mil-banner-text mil-text-center">
                                <div class="mil-text-m mil-mb-20">Pendaftaran</div>
                                <h1 class="mil-mb-30">Informasi Pendaftaran Pilrek Unmul</h1>
                                <p class="mil-text-m mil-soft mil-mb-40">Pendaftaran saat ini masih dilakukan secara
                                    offline.</p>
                                <ul class="mil-breadcrumbs mil-center">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>
@endsection
