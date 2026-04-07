@extends('layouts.app')

@section('title', 'Calon Rektor')

@section('content')
<style>
    .pilrek-candidate-grid {
        max-width: 1180px;
        margin: 0 auto;
    }

    .pilrek-candidate-card {
        height: 100%;
        padding: 22px 22px 28px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 30px;
        background: linear-gradient(180deg, rgba(19, 26, 39, 0.96) 0%, rgba(14, 19, 31, 0.96) 100%);
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.14);
        text-align: center;
    }

    .pilrek-candidate-portrait {
        overflow: hidden;
        border-radius: 22px;
        margin-bottom: 24px;
        background: rgba(255, 255, 255, 0.04);
        aspect-ratio: 4 / 5;
    }

    .pilrek-candidate-portrait img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pilrek-candidate-unit {
        color: rgba(255, 255, 255, 0.62);
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 8px;
    }

    .pilrek-candidate-role {
        color: rgba(255, 255, 255, 0.72);
        font-size: 15px;
        line-height: 1.6;
        min-height: 48px;
        margin-bottom: 24px;
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

@php
    $candidates = [
        [
            'name' => 'Prof. Dr. Ir. Ahmad Prasetyo, M.Sc.',
            'unit' => 'Fakultas Teknik',
            'role' => 'Guru Besar Teknik Industri / Dekan Fakultas Teknik',
            'image' => '1.png',
        ],
        [
            'name' => 'Prof. Dr. Rina Kartikasari, M.Hum.',
            'unit' => 'Fakultas Ilmu Budaya',
            'role' => 'Guru Besar Linguistik / Wakil Rektor Bidang Akademik',
            'image' => '2.png',
        ],
        [
            'name' => 'Prof. Dr. H. Budi Santoso, M.Si.',
            'unit' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
            'role' => 'Guru Besar Biologi / Ketua Senat Fakultas',
            'image' => '3.png',
        ],
        [
            'name' => 'Prof. Dr. Dewi Lestari, S.E., M.M.',
            'unit' => 'Fakultas Ekonomi dan Bisnis',
            'role' => 'Guru Besar Manajemen / Dekan Fakultas Ekonomi dan Bisnis',
            'image' => '4.png',
        ],
        [
            'name' => 'Prof. Dr. Ir. Muhammad Arifin, M.T.',
            'unit' => 'Sekolah Pascasarjana',
            'role' => 'Direktur Sekolah Pascasarjana / Guru Besar Teknik Sipil',
            'image' => '1.png',
        ],
    ];
@endphp

<div id="smooth-wrapper" class="mil-wrapper">

    <div class="mil-preloader">
        <div class="mil-load"></div>
        <p class="h2 mil-mb-30"><span class="mil-light mil-counter" data-number="100">100</span><span class="mil-light">%</span></p>
    </div>

    <div class="mil-progress-track">
        <div class="mil-progress"></div>
    </div>

    <div class="progress-wrap active-progress"></div>
    @include('partials.navbar', ['activePage' => 'calon-rektor'])



    <div id="smooth-content">

        <div class="mil-banner mil-banner-inner mil-dissolve">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8">
                        <div class="mil-banner-text mil-text-center">
                            <div class="mil-text-m mil-mb-20">Pemilihan Rektor 2026</div>
                            <h1 class="mil-mb-40">Calon Rektor</h1>
                            <p class="mil-text-m mil-soft mil-mb-40">Daftar kandidat Pemilihan Rektor Universitas Periode 2026-2030</p>
                            <ul class="mil-breadcrumbs mil-center">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('calon-rektor') }}">Calon Rektor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mil-p-0-160">
            <div class="container pilrek-candidate-grid">
                <div class="row">
                    @foreach (array_slice($candidates, 0, 3) as $candidate)
                        <div class="col-xl-4 col-md-6 mil-mb-30">
                            <div class="pilrek-candidate-card mil-up">
                                <div class="pilrek-candidate-portrait">
                                    <img src="{{ asset('template/img/inner-pages/team/' . $candidate['image']) }}" alt="{{ $candidate['name'] }}">
                                </div>
                                <h5 class="mil-mb-15">{{ $candidate['name'] }}</h5>
                                <div class="pilrek-candidate-unit">{{ $candidate['unit'] }}</div>
                                <div class="pilrek-candidate-role">{{ $candidate['role'] }}</div>
                                <a href="{{ route('career.details') }}" class="mil-btn mil-m">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row pilrek-candidate-row-centered">
                    @foreach (array_slice($candidates, 3, 2) as $candidate)
                        <div class="col-xl-4 col-md-6 mil-mb-30">
                            <div class="pilrek-candidate-card mil-up">
                                <div class="pilrek-candidate-portrait">
                                    <img src="{{ asset('template/img/inner-pages/team/' . $candidate['image']) }}" alt="{{ $candidate['name'] }}">
                                </div>
                                <h5 class="mil-mb-15">{{ $candidate['name'] }}</h5>
                                <div class="pilrek-candidate-unit">{{ $candidate['unit'] }}</div>
                                <div class="pilrek-candidate-role">{{ $candidate['role'] }}</div>
                                <a href="{{ route('career.details') }}" class="mil-btn mil-m">Informasi Lengkap</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('partials.footer')

    </div>
</div>
@endsection

