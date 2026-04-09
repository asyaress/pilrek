@extends('layouts.app')

@section('title', $pageMeta['title'])

@section('content')
<style>
    .pilrek-candidate-grid {
        max-width: 1180px;
        margin: 0 auto;
    }

    .pilrek-candidate-card {
        height: 100%;
        padding: 22px 22px 28px;
        border: none;
        border-radius: 30px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbf8 100%);
        box-shadow: 0 18px 50px rgba(23, 67, 46, 0.08);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pilrek-candidate-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 24px 55px rgba(23, 67, 46, 0.12);
    }

    .pilrek-candidate-portrait {
        overflow: hidden;
        border-radius: 22px;
        margin-bottom: 24px;
        background: #edf5ee;
        aspect-ratio: 4 / 5;
    }

    .pilrek-candidate-portrait img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pilrek-candidate-unit {
        color: #5f7a68;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 8px;
    }

    .pilrek-candidate-role {
        color: #547361;
        font-size: 15px;
        line-height: 1.6;
        min-height: 48px;
        margin-bottom: 24px;
    }

    .pilrek-candidate-card h5 {
        color: #1f4b35;
    }

    .pilrek-candidate-card .mil-btn {
        min-width: 180px;
    }

    .pilrek-candidate-row-centered {
        justify-content: center;
    }

    @media (max-width: 991px) {
        .pilrek-candidate-card {
            padding: 20px 20px 24px;
        }

        .pilrek-candidate-role {
            min-height: 0;
        }
    }
</style>

<div id="smooth-wrapper" class="mil-wrapper">

    <div class="mil-preloader">
        <div class="mil-load"></div>
        <p class="h2 mil-mb-30"><span class="mil-light mil-counter" data-number="100">100</span><span class="mil-light">%</span></p>
    </div>

    <div class="mil-progress-track">
        <div class="mil-progress"></div>
    </div>

    <div class="progress-wrap active-progress"></div>
    @include('partials.navbar', ['activePage' => $pageMeta['activePage']])



    <div id="smooth-content">

        <div class="mil-banner mil-banner-inner mil-dissolve">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8">
                        <div class="mil-banner-text mil-text-center">
                            <div class="mil-text-m mil-mb-20">{{ $pageMeta['kicker'] }}</div>
                            <h1 class="mil-mb-40">{{ $pageMeta['title'] }}</h1>
                            <p class="mil-text-m mil-soft mil-mb-40">{{ $pageMeta['description'] }}</p>
                            <ul class="mil-breadcrumbs mil-center">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route($pageMeta['indexRoute']) }}">{{ $pageMeta['title'] }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mil-p-0-160">
            <div class="container pilrek-candidate-grid">
                <div class="row pilrek-candidate-row-centered">
                    @forelse ($candidates as $candidate)
                        <div class="col-xl-4 col-md-6 mil-mb-30">
                            <div class="pilrek-candidate-card mil-up">
                                <div class="pilrek-candidate-portrait">
                                    <img src="{{ $candidate['photo_url'] }}" alt="{{ $candidate['name'] }}">
                                </div>
                                <h5 class="mil-mb-15">{{ $candidate['name'] }}</h5>
                                <div class="pilrek-candidate-unit">{{ $candidate['faculty_unit'] ?: '-' }}</div>
                                <div class="pilrek-candidate-role">{{ $candidate['role_summary'] ?: '-' }}</div>
                                <a href="{{ route($pageMeta['detailRoute'], $candidate['slug']) }}" class="mil-btn mil-m">Lihat Detail</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-light text-center">{{ $pageMeta['empty'] }}</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @include('partials.footer')

    </div>
</div>
@endsection
