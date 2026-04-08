@extends('layouts.app')

@section('title', 'Persyaratan Calon Rektor | Pilrek Unmul 2026-2030')

@section('content')
    <style>
        .pilrek-requirements-hero {
            padding-top: 170px;
            padding-bottom: 70px;
        }

        .pilrek-requirements-hero p {
            max-width: 720px;
            margin: 0 auto;
        }
    </style>

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
        @include('partials.navbar', ['activePage' => 'persyaratan'])

        <div id="smooth-content">
            <div class="pilrek-requirements-hero">
                <div class="container mil-text-center">
                    <div class="mil-text-m mil-text-gradient-2 mil-mb-15">Persyaratan</div>
                    <h1 class="mil-mb-20">Persyaratan Calon Rektor Unmul</h1>
                    <p class="mil-text-m mil-soft">
                        Ketentuan administrasi untuk tahapan Pilrek Universitas Mulawarman periode 2026-2030.
                        Klik setiap tab untuk melihat detail setiap poin persyaratan.
                    </p>
                </div>
            </div>

            <div class="mil-p-0-160">
                <div class="container">
                    <div class="mil-up">
                        @include('partials.requirement-card-stack', [
                            'items' => $requirementItems ?? [],
                            'showHeading' => false,
                            'stackId' => 'requirements-page-stack',
                        ])
                    </div>
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>
@endsection
