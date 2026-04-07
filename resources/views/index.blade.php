@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .pilrek-home-shell {
        background: #ffffff;
    }

    .pilrek-home-shell #smooth-content {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .pilrek-home-shell .mil-top-panel:not(.mil-active) {
        height: 100px;
        background-color: transparent;
        box-shadow: none;
    }

    .pilrek-home-shell .mil-top-panel.mil-active {
        height: 84px;
        background-color: #ffffff;
        box-shadow: 0 8px 24px rgba(13, 81, 82, 0.1);
    }

    .pilrek-home-shell .mil-top-panel,
    .pilrek-home-shell .mil-top-panel .container {
        transition: all 0.4s ease;
    }

    .pilrek-home-shell .mil-top-panel .container {
        min-height: 100px;
    }

    .pilrek-home-shell .mil-top-panel.mil-active .container {
        min-height: 84px;
    }

    .pilrek-hero {
        margin-top: 0 !important;
        padding: 100px 0 180px;
        min-height: 100vh;
    }

    .pilrek-hero::before {
        content: "";
        position: absolute;
        inset: -40px;
        background:
            linear-gradient(180deg, rgba(10, 16, 28, 0.45) 0%, rgba(10, 16, 28, 0.78) 100%),
            url("{{ asset('template/img/inner-pages/2.png') }}") center/cover no-repeat;
        filter: blur(10px) brightness(0.45);
        transform: scale(1.08);
    }

    .pilrek-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top, rgba(62, 198, 208, 0.18), transparent 48%);
    }

    .pilrek-hero-content {
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
    }

    .pilrek-hero-kicker {
        display: inline-flex;
        padding: 10px 18px;
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        color: #9be7ea;
        font-size: 14px;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        backdrop-filter: blur(12px);
    }

    .pilrek-hero h1 {
        margin: 28px 0 20px;
        color: #fff;
        text-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
    }

    .pilrek-hero-subtitle {
        max-width: 660px;
        margin: 0 auto 42px;
        color: rgba(255, 255, 255, 0.78);
    }

    .pilrek-countdown {
        display: grid;
        grid-template-columns: repeat(4, minmax(110px, 1fr));
        gap: 12px;
        max-width: 560px;
        margin: 0 auto;
    }

    .pilrek-countdown-item {
        padding: 20px 12px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
        backdrop-filter: blur(14px);
    }

    .pilrek-countdown-item strong {
        display: block;
        color: #fff;
        font-size: 38px;
        line-height: 1;
        margin-bottom: 8px;
        font-variant-numeric: tabular-nums;
    }

    .pilrek-countdown-item span {
        color: rgba(255, 255, 255, 0.68);
        font-size: 11px;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .pilrek-rules-card {
        max-width: 100%;
        margin: 0 auto;
        padding: 62px 72px;
        border: none;
        border-radius: 36px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbf8 100%);
        box-shadow: 0 24px 55px rgba(23, 67, 46, 0.08);
        text-align: center;
    }

    .pilrek-rules-card p {
        max-width: 1000px;
        margin: 0 auto;
        color: #5b7263;
        font-size: 15px;
        line-height: 2;
    }

    .pilrek-rules-card h3 {
        color: #1f4b35;
    }

    @media (max-width: 991px) {
        .pilrek-hero {
            margin-top: 0 !important;
            padding: 100px 0 140px;
            min-height: auto;
        }

        .pilrek-countdown {
            grid-template-columns: repeat(4, minmax(74px, 1fr));
            gap: 8px;
            max-width: 360px;
        }

        .pilrek-rules-card {
            padding: 50px 34px;
        }
    }

    @media (max-width: 767px) {
        .pilrek-home-shell .mil-top-panel,
        .pilrek-home-shell .mil-top-panel.mil-active {
            height: 80px;
            background-color: #ffffff;
            box-shadow: 0 8px 24px rgba(13, 81, 82, 0.1);
        }

        .pilrek-home-shell .mil-top-panel .container,
        .pilrek-home-shell .mil-top-panel.mil-active .container {
            min-height: 80px;
        }

        .pilrek-hero {
            margin-top: 0 !important;
            padding: 80px 0 120px;
        }

        .pilrek-hero h1 {
            margin: 24px 0 18px;
        }

        .pilrek-countdown {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 6px;
            max-width: 320px;
        }

        .pilrek-countdown-item {
            padding: 12px 6px 10px;
            border-radius: 14px;
        }

        .pilrek-countdown-item strong {
            font-size: 24px;
            margin-bottom: 2px;
        }

        .pilrek-countdown-item span {
            font-size: 9px;
            letter-spacing: 0.1em;
        }

        .pilrek-rules-card {
            padding: 40px 22px;
        }

        .pilrek-rules-card p {
            font-size: 14px;
            line-height: 1.9;
        }
    }
</style>

<div id="smooth-wrapper" class="mil-wrapper pilrek-home-shell">

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
    @include('partials.navbar', ['activePage' => 'home'])



    <div id="smooth-content">

        <div class="mil-banner mil-dissolve pilrek-hero">
            <div class="container">
                <div class="pilrek-hero-content">
                    <div class="pilrek-hero-kicker">Agenda Utama Kampus</div>
                    <h1 class="mil-display">Pemilihan Rektor Periode 2026</h1>
                    <p class="mil-text-m pilrek-hero-subtitle">
                        Informasi resmi seputar tahapan pemilihan, persyaratan peserta, dan agenda penting untuk seluruh sivitas akademika.
                    </p>
                    <div class="pilrek-countdown">
                        <div class="pilrek-countdown-item">
                            <strong>27</strong>
                            <span>Hari</span>
                        </div>
                        <div class="pilrek-countdown-item">
                            <strong>14</strong>
                            <span>Jam</span>
                        </div>
                        <div class="pilrek-countdown-item">
                            <strong>36</strong>
                            <span>Menit</span>
                        </div>
                        <div class="pilrek-countdown-item">
                            <strong>12</strong>
                            <span>Detik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mil-p-160-160">
            <div class="container">
                <div class="pilrek-rules-card mil-up">
                    <div class="mil-text-m mil-mb-20 mil-text-gradient-2">Syarat-Syarat</div>
                    <h3 class="mil-mb-30">Ketentuan Umum Pemilihan</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Curabitur blandit tempus porttitor. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec id elit non mi porta gravida at eget metus. Sed posuere consectetur est at lobortis. Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas faucibus mollis interdum. Vestibulum id ligula porta felis euismod semper. Cras mattis consectetur purus sit amet fermentum. Nulla vitae elit libero, a pharetra augue. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                    </p>
                </div>
            </div>
        </div>
        @include('partials.footer')

    </div>
</div>
@endsection
