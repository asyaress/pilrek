@extends('layouts.app')

@section('title', 'Pilrek Unmul 2026-2030')

@section('content')
    <style>
        .pilrek-home-kicker {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(3, 166, 166, 0.12);
            color: #0a6565;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .pilrek-countdown-panel {
            max-width: 980px;
            margin: 0 auto;
            padding: 38px 34px;
            border-radius: 26px;
            border: 1px solid rgba(2, 34, 53, 0.08);
            background: linear-gradient(180deg, #ffffff 0%, #f7fafb 100%);
            box-shadow: 0 16px 45px rgba(2, 34, 53, 0.08);
        }

        .pilrek-countdown-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(120px, 1fr));
            gap: 12px;
        }

        .pilrek-countdown-item {
            border-radius: 18px;
            padding: 16px 8px;
            text-align: center;
            background: #ffffff;
            border: 1px solid rgba(2, 34, 53, 0.08);
        }

        .pilrek-countdown-value {
            display: block;
            font-size: 34px;
            line-height: 1;
            margin-bottom: 6px;
            color: #022235;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        .pilrek-countdown-label {
            color: #6c7b88;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .pilrek-candidate-card {
            border-radius: 24px;
            padding: 18px 18px 24px;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #ffffff 0%, #f7fafb 100%);
            border: 1px solid rgba(2, 34, 53, 0.08);
            box-shadow: 0 16px 40px rgba(2, 34, 53, 0.08);
        }

        .pilrek-candidate-role {
            min-height: 76px;
        }

        .pilrek-candidate-card .mil-link {
            margin-top: auto;
        }

        .pilrek-candidate-card .mil-link.mil-accent {
            color: #ffc107;
        }

        .pilrek-candidate-card .mil-link.mil-accent:hover {
            color: #e0a800;
        }

        .pilrek-candidate-section {
            padding-top: 40px;
        }

        .pilrek-candidate-photo {
            border-radius: 18px;
            overflow: hidden;
            margin-bottom: 18px;
            aspect-ratio: 4 / 5;
            background: #e8eef2;
        }

        .pilrek-candidate-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .pilrek-selected-rector-section {
            padding-top: 24px;
        }

        .pilrek-selected-rector-card {
            border-radius: 28px;
            overflow: hidden;
            border: 1px solid rgba(2, 34, 53, 0.08);
            background: linear-gradient(180deg, #ffffff 0%, #f7fafb 100%);
            box-shadow: 0 18px 45px rgba(2, 34, 53, 0.1);
            padding: 22px;
        }

        .pilrek-selected-rector-photo {
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4 / 5;
            background: #e8eef2;
            height: 100%;
        }

        .pilrek-selected-rector-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .pilrek-roadmap-shell {
            background: transparent;
        }

        .pilrek-roadmap-canvas {
            display: grid;
            grid-template-columns: minmax(420px, 56%) minmax(300px, 44%);
            gap: 18px;
            align-items: stretch;
            position: relative;
            background: transparent;
        }

        .pilrek-roadmap-left {
            position: relative;
            z-index: 5;
        }

        .pilrek-roadmap-heading {
            margin-bottom: 14px;
        }

        .pilrek-roadmap-heading h3 {
            margin: 0;
            font-size: clamp(30px, 2.6vw, 48px);
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #0c2230;
        }

        .pilrek-roadmap-heading p {
            margin: 10px 0 0;
            font-size: clamp(14px, 1.05vw, 18px);
            color: #253745;
        }

        .pilrek-roadmap-steps {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pilrek-step-card {
            position: relative;
            min-height: 106px;
            padding: 16px 28px 16px 112px;
            background: rgba(255, 255, 255, 0.58);
            clip-path: polygon(30px 0, calc(100% - 30px) 0, 100% 50%, calc(100% - 30px) 100%, 30px 100%, 0 50%);
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.06);
        }

        .pilrek-step-number {
            position: absolute;
            left: 36px;
            top: 50%;
            transform: translateY(-50%);
            margin: 0;
            font-size: 30px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: 0.02em;
            color: var(--step-color, #f2c400);
        }

        .pilrek-step-date {
            margin: 0 0 6px;
            color: #0f7180;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .pilrek-step-title {
            margin: 0 0 4px;
            font-size: 22px;
            line-height: 1.2;
            font-weight: 800;
            color: #0a3d4b;
        }

        .pilrek-step-desc {
            margin: 0;
            font-size: 15px;
            line-height: 1.45;
            color: #243540;
            max-width: 420px;
        }

        .pilrek-hidden {
            display: none !important;
        }

        .pilrek-roadmap-right {
            position: relative;
            min-height: 640px;
            background: transparent;
            overflow: visible;
        }

        .pilrek-road-svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
            overflow: hidden;
        }

        .pilrek-road-fill {
            fill: none;
            stroke: #000;
            stroke-width: 124;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .pilrek-road-lane {
            fill: none;
            stroke: #dddddd;
            stroke-width: 3.2;
            stroke-dasharray: 22 16;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0.95;
        }

        .pilrek-road-milestones {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
        }

        .pilrek-road-milestone {
            --size: 88px;
            position: absolute;
            width: var(--size);
            height: var(--size);
            transform: translate(-50%, -50%);
            border-radius: 50%;
            display: grid;
            place-items: center;
            cursor: pointer;
            pointer-events: auto;
        }

        .pilrek-road-milestone::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: var(--color, #f2c400);
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.14);
        }

        .pilrek-road-milestone .icon {
            position: relative;
            z-index: 1;
            color: #fff;
            font-size: 22px;
            display: grid;
            place-items: center;
        }

        .pilrek-road-milestone .icon i,
        .pilrek-road-milestone .icon svg {
            color: #fff !important;
            fill: #fff;
            stroke: #fff;
        }

        .pilrek-road-milestone .connector {
            position: absolute;
            top: calc(100% - 2px);
            left: 50%;
            width: 3px;
            height: var(--line, 38px);
            transform: translateX(-50%);
            background: repeating-linear-gradient(to bottom,
                    color-mix(in srgb, var(--color, #f2c400) 96%, white 4%) 0 5px,
                    transparent 5px 10px);
        }

        .pilrek-road-milestone .dot {
            position: absolute;
            left: 50%;
            bottom: calc(-1 * var(--line, 38px) - 10px);
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--color, #f2c400);
        }

        .pilrek-road-flag {
            position: absolute;
            transform: translate(-50%, -50%) rotate(var(--rot, 0deg));
            transform-origin: center center;
            z-index: 2;
            pointer-events: none;
            opacity: 0.56;
            text-align: center;
        }

        .pilrek-road-flag-line {
            position: relative;
            width: 16px;
            height: 58px;
            border-radius: 3px;
            border: 2px solid rgba(255, 255, 255, 0.88);
            background-color: #e9ecef;
            background-image:
                linear-gradient(45deg, #101010 25%, transparent 25%, transparent 75%, #101010 75%, #101010),
                linear-gradient(45deg, #101010 25%, transparent 25%, transparent 75%, #101010 75%, #101010);
            background-size: 10px 10px;
            background-position: 0 0, 5px 5px;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.28);
        }

        .pilrek-road-flag-line::before,
        .pilrek-road-flag-line::after {
            content: "";
            position: absolute;
            left: 50%;
            width: 30px;
            height: 5px;
            transform: translateX(-50%);
            border-radius: 999px;
            background: repeating-linear-gradient(90deg,
                    #d61f1f 0 8px,
                    #ffffff 8px 16px);
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2);
        }

        .pilrek-road-flag-line::before {
            top: -8px;
        }

        .pilrek-road-flag-line::after {
            bottom: -8px;
        }

        .pilrek-road-flag-text {
            margin-top: 10px;
            font-size: 9px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #f8fbfd;
            font-weight: 700;
            text-shadow: 0 2px 7px rgba(0, 0, 0, 0.35);
        }

        .pilrek-roadmap-load {
            margin-top: 18px;
            text-align: center;
        }

        .pilrek-road-milestone:focus-visible {
            outline: 3px solid rgba(3, 166, 166, 0.65);
            outline-offset: 4px;
        }

        .pilrek-tl-modal[hidden] {
            display: none !important;
        }

        .pilrek-tl-modal {
            position: fixed;
            inset: 0;
            z-index: 1200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .pilrek-tl-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(6, 19, 27, 0.62);
            backdrop-filter: blur(2px);
        }

        .pilrek-tl-modal-dialog {
            position: relative;
            width: min(560px, 100%);
            border-radius: 18px;
            padding: 24px 24px 22px;
            background: #fff;
            border: 1px solid rgba(2, 34, 53, 0.08);
            box-shadow: 0 22px 45px rgba(2, 34, 53, 0.24);
        }

        .pilrek-tl-modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 50%;
            font-size: 24px;
            line-height: 1;
            color: #29414f;
            background: #f1f5f7;
            cursor: pointer;
        }

        .pilrek-tl-modal-kicker {
            margin: 0 0 8px;
            font-size: 12px;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: #6c7b88;
        }

        .pilrek-tl-modal-title {
            margin: 0 0 10px;
            font-size: 28px;
            line-height: 1.2;
            color: #0a3d4b;
        }

        .pilrek-tl-modal-date {
            margin: 0 0 12px;
            font-size: 14px;
            color: #0f7180;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .pilrek-tl-modal-desc {
            margin: 0;
            color: #304551;
            font-size: 16px;
            line-height: 1.65;
        }

        .pilrek-news-card {
            display: block;
            height: 100%;
            border-radius: 24px;
            overflow: hidden;
            background: linear-gradient(180deg, #ffffff 0%, #f7fafb 100%);
            border: 1px solid rgba(2, 34, 53, 0.08);
            box-shadow: 0 16px 40px rgba(2, 34, 53, 0.08);
        }

        .pilrek-news-cover {
            aspect-ratio: 16 / 10;
            overflow: hidden;
        }

        .pilrek-news-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .pilrek-news-body {
            padding: 22px 20px 24px;
        }

        .pilrek-news-date {
            color: #6c7b88;
            font-size: 12px;
            margin-bottom: 8px;
        }

        @media (max-width: 991px) {
            .pilrek-countdown-grid {
                grid-template-columns: repeat(2, minmax(120px, 1fr));
            }

            .pilrek-roadmap-canvas {
                grid-template-columns: 1fr;
            }

            .pilrek-roadmap-left {
                width: 100%;
                order: 2;
            }

            .pilrek-roadmap-right {
                order: 1;
                display: block;
                width: 100%;
                min-height: 430px;
                margin-bottom: 16px;
            }

            .pilrek-step-card {
                min-height: 96px;
                padding: 16px 22px 16px 92px;
            }

            .pilrek-step-number {
                left: 28px;
                font-size: 26px;
            }

            .pilrek-step-title {
                font-size: 19px;
            }

            .pilrek-step-desc {
                font-size: 14px;
                max-width: none;
            }

            .pilrek-road-fill {
                stroke-width: 112;
            }

            .pilrek-road-lane {
                stroke-width: 3;
                stroke-dasharray: 18 14;
            }
        }

        @media (max-width: 575px) {
            .pilrek-countdown-panel {
                padding: 28px 16px;
            }

            .pilrek-countdown-grid {
                gap: 8px;
            }

            .pilrek-countdown-item {
                padding: 12px 6px;
            }

            .pilrek-countdown-value {
                font-size: 24px;
            }

            .pilrek-roadmap-right {
                min-height: 350px;
            }

            .pilrek-candidate-section {
                padding-top: 24px;
            }

            .pilrek-candidate-role {
                min-height: 0;
            }
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
        @include('partials.navbar', ['activePage' => 'home'])

        <div id="smooth-content">
            <div class="mil-banner mil-dissolve">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6">
                            <div class="mil-banner-text">
                                <div class="pilrek-home-kicker mil-mb-20">Portal Resmi</div>
                                <h1 class="mil-display mil-text-gradient-3 mil-mb-30">Pilrek Unmul 2026-2030</h1>
                                <p class="mil-text-m mil-soft mil-mb-40">
                                    Pusat informasi resmi Pemilihan Rektor Universitas Mulawarman periode 2026-2030, mulai
                                    dari timeline tahapan, profil calon, hingga publikasi berita terbaru.
                                </p>
                                <div class="mil-buttons-frame">
                                    <a href="{{ route('calon-rektor') }}" class="mil-btn mil-md mil-add-arrow">Lihat Calon
                                        Rektor</a>
                                    <a href="{{ route('timeline') }}" class="mil-btn mil-md mil-light">Lihat Timeline</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mil-banner-img">
                                <img src="{{ asset('rektorat.png') }}" alt="Pilrek Unmul"
                                    style="max-width: 135%; transform: translateX(5%)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mil-p-100-160">
                <div class="container">
                    <div class="pilrek-countdown-panel mil-up">
                        <div class="mil-text-center mil-mb-10">
                            <h4 class="mil-mb-10">Hitung Mundur Tahap Utama Pilrek</h4>
                            <p class="mil-text-m mil-soft">Menuju pemaparan visi dan misi calon rektor</p>
                        </div>
                        <div class="pilrek-countdown-grid" data-countdown-target="2026-09-01T08:00:00+08:00">
                            <div class="pilrek-countdown-item">
                                <span class="pilrek-countdown-value" data-countdown="days">00</span>
                                <span class="pilrek-countdown-label">Hari</span>
                            </div>
                            <div class="pilrek-countdown-item">
                                <span class="pilrek-countdown-value" data-countdown="hours">00</span>
                                <span class="pilrek-countdown-label">Jam</span>
                            </div>
                            <div class="pilrek-countdown-item">
                                <span class="pilrek-countdown-value" data-countdown="minutes">00</span>
                                <span class="pilrek-countdown-label">Menit</span>
                            </div>
                            <div class="pilrek-countdown-item">
                                <span class="pilrek-countdown-value" data-countdown="seconds">00</span>
                                <span class="pilrek-countdown-label">Detik</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($selectedRector))
                <div class="mil-p-0-130 pilrek-selected-rector-section">
                    <div class="container">
                        <div class="row justify-content-between align-items-end mil-mb-40">
                            <div class="col-xl-8">
                                <div class="mil-text-m mil-text-gradient-2 mil-mb-15">Rektor Terpilih</div>
                                <h2>{{ $selectedRector['name'] }}</h2>
                            </div>
                            <div class="col-xl-4 mil-text-right mil-sm-text-left">
                                <a href="{{ route('calon-rektor.detail', $selectedRector['slug']) }}" class="mil-btn mil-m mil-add-arrow">Profil Lengkap</a>
                            </div>
                        </div>
                        <div class="pilrek-selected-rector-card mil-up">
                            <div class="row align-items-center">
                                <div class="col-lg-4 mil-mb-30 mil-lg-mb-0">
                                    <div class="pilrek-selected-rector-photo">
                                        <img src="{{ $selectedRector['photo_url'] }}" alt="{{ $selectedRector['name'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <h4 class="mil-mb-10">{{ $selectedRector['name'] }}</h4>
                                    <p class="mil-text-m mil-soft mil-mb-10">{{ $selectedRector['faculty_unit'] ?: '-' }}</p>
                                    <p class="mil-text-m mil-soft mil-mb-20">{{ $selectedRector['role_summary'] ?: '-' }}</p>
                                    <p class="mil-text-s mil-soft mil-mb-0">
                                        {{ $selectedRector['short_profile'] ?: 'Profil singkat rektor terpilih belum tersedia.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($homeBalonCandidates))
                <div class="mil-p-0-130 pilrek-candidate-section">
                    <div class="container">
                        <div class="row justify-content-between align-items-end mil-mb-60">
                            <div class="col-xl-8">
                                <div class="mil-text-m mil-text-gradient-2 mil-mb-15">Balon Rektor</div>
                                <h2>Balon Rektor Unmul</h2>
                            </div>
                            <div class="col-xl-4 mil-text-right mil-sm-text-left">
                                <a href="{{ route('balon') }}" class="mil-btn mil-m mil-add-arrow">Lihat Semua Balon</a>
                            </div>
                        </div>
                        <div class="row">
                            @foreach (($homeBalonCandidates ?? []) as $candidate)
                                <div class="col-xl-3 col-md-6 mil-mb-30">
                                    <div class="pilrek-candidate-card mil-up">
                                        <div class="pilrek-candidate-photo">
                                            <img src="{{ $candidate['photo_url'] }}" alt="{{ $candidate['name'] }}">
                                        </div>
                                        <h5 class="mil-mb-10">{{ $candidate['name'] }}</h5>
                                        <p class="mil-text-s mil-soft mil-mb-20 pilrek-candidate-role">{{ $candidate['role_summary'] ?: '-' }}</p>
                                        <a href="{{ route('balon.detail', $candidate['slug']) }}" class="mil-link mil-accent">Profil Lengkap</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($homeCalonCandidates))
                <div class="mil-p-0-130 pilrek-candidate-section">
                    <div class="container">
                        <div class="row justify-content-between align-items-end mil-mb-60">
                            <div class="col-xl-8">
                                <div class="mil-text-m mil-text-gradient-2 mil-mb-15">Calon Rektor</div>
                                <h2>Calon Rektor Unmul</h2>
                            </div>
                            <div class="col-xl-4 mil-text-right mil-sm-text-left">
                                <a href="{{ route('calon-rektor') }}" class="mil-btn mil-m mil-add-arrow">Lihat Semua Calon</a>
                            </div>
                        </div>
                        <div class="row">
                            @foreach (($homeCalonCandidates ?? []) as $candidate)
                                <div class="col-xl-3 col-md-6 mil-mb-30">
                                    <div class="pilrek-candidate-card mil-up">
                                        <div class="pilrek-candidate-photo">
                                            <img src="{{ $candidate['photo_url'] }}" alt="{{ $candidate['name'] }}">
                                        </div>
                                        <h5 class="mil-mb-10">{{ $candidate['name'] }}</h5>
                                        <p class="mil-text-s mil-soft mil-mb-20 pilrek-candidate-role">{{ $candidate['role_summary'] ?: '-' }}</p>
                                        <a href="{{ route('calon-rektor.detail', $candidate['slug']) }}" class="mil-link mil-accent">Profil Lengkap</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @php
                $timelineItems = $timelineItems ?? [];
                $timelineCount = count($timelineItems);
                $homeTimelineVisible = 5;
                $homeTimelineItems = $homeTimelineItems ?? array_slice($timelineItems, 0, $homeTimelineVisible);
                $timelineStepColors = ['#f2c400', '#a8b42d', '#56a35f', '#158a7b', '#0f463d'];
                $timelineStepIcons = collect($homeTimelineItems)
                    ->map(
                        static fn (array $item): string => \App\Models\TimelineStage::resolveIconClass(
                            $item['icon_class'] ?? null,
                        ),
                    )
                    ->values()
                    ->all();
            @endphp

            <div class="mil-p-0-130">
                <div class="container">
                    <div class="row justify-content-between align-items-end mil-mb-60">
                        <div class="col-xl-8">
                            <div class="mil-text-m mil-text-gradient-2 mil-mb-15">Timeline</div>
                            <h2>Timeline Pemilihan Rektor Universitas Mulawarman Periode 2026-2030</h2>
                        </div>
                        <div class="col-xl-4 mil-text-right mil-sm-text-left">
                            <a href="{{ route('timeline') }}" class="mil-btn mil-m mil-add-arrow">Detail Timeline</a>
                        </div>
                    </div>
                    <div class="pilrek-roadmap-shell mil-up" data-roadmap-section>
                        <div class="pilrek-roadmap-canvas" data-road-canvas>
                            <div class="pilrek-roadmap-left" data-road-left>
                                <!-- <div class="pilrek-roadmap-heading">
                                    <h3>Optimization Path Roadmap</h3>
                                    <p>Focuses on ongoing improvement and long-term planning</p>
                                </div> -->
                                <div class="pilrek-roadmap-steps">
                                    @foreach ($homeTimelineItems as $itemIndex => $item)
                                        @php
                                            $stepNumber = str_pad((string) ($itemIndex + 1), 2, '0', STR_PAD_LEFT);
                                            $stepColor = $timelineStepColors[$itemIndex % count($timelineStepColors)];
                                        @endphp
                                        <article class="pilrek-step-card" data-road-step>
                                            <p class="pilrek-step-number" style="--step-color: {{ $stepColor }};">
                                                {{ $stepNumber }}</p>
                                            <p class="pilrek-step-date">{{ $item['date'] }}</p>
                                            <h4 class="pilrek-step-title">{{ $item['title'] }}</h4>
                                            <p class="pilrek-step-desc">{{ $item['description'] }}</p>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                            <div class="pilrek-roadmap-right" data-road-visual>
                                <svg class="pilrek-road-svg" viewBox="0 0 1000 1000" preserveAspectRatio="none"
                                    aria-hidden="true">
                                    <path class="pilrek-road-fill" data-road-fill />
                                    <path class="pilrek-road-lane" data-road-lane />
                                </svg>
                                <div class="pilrek-road-milestones" data-road-milestones></div>
                            </div>
                        </div>

                        @if ($timelineCount > $homeTimelineVisible)
                            <div class="pilrek-roadmap-load">
                                <a href="{{ route('timeline') }}" class="mil-btn mil-m mil-add-arrow">Lihat Timeline
                                    Lengkap</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mil-p-0-130">
                <div class="container">
                    <div class="row justify-content-between align-items-end mil-mb-60">
                        <div class="col-xl-8">
                            <div class="mil-text-m mil-text-gradient-2 mil-mb-15">Persyaratan</div>
                            <h2>Persyaratan Calon Rektor</h2>
                        </div>
                        <div class="col-xl-4 mil-text-right mil-sm-text-left">
                            <a href="{{ route('persyaratan') }}" class="mil-btn mil-m mil-add-arrow">Halaman
                                Persyaratan</a>
                        </div>
                    </div>
                    <div class="mil-up">
                        @include('partials.requirement-card-stack', [
                            'items' => $homeRequirementItems ?? [],
                            'showHeading' => false,
                            'stackId' => 'home-requirement-stack',
                        ])
                    </div>
                </div>
            </div>

            <div class="mil-p-0-160">
                <div class="container">
                    <div class="row justify-content-between align-items-end mil-mb-60">
                        <div class="col-xl-8">
                            <div class="mil-text-m mil-text-gradient-2 mil-mb-15">Berita</div>
                            <h2>Berita Terkini Pilrek Unmul</h2>
                        </div>
                        <div class="col-xl-4 mil-text-right mil-sm-text-left">
                            <a href="{{ route('berita') }}" class="mil-btn mil-m mil-add-arrow">Semua Berita</a>
                        </div>
                    </div>
                    <div class="row">
                        @forelse (($homeNewsItems ?? []) as $newsItem)
                            <div class="col-xl-4 col-md-6 mil-mb-30">
                                <a href="{{ route('publikasi', ['slug' => $newsItem['slug']]) }}" class="pilrek-news-card mil-up">
                                    <div class="pilrek-news-cover">
                                        <img src="{{ $newsItem['cover_url'] }}" alt="{{ $newsItem['title'] }}">
                                    </div>
                                    <div class="pilrek-news-body">
                                        <div class="pilrek-news-date">{{ $newsItem['published_label'] }}</div>
                                        <h6 class="mil-mb-15">{{ $newsItem['title'] }}</h6>
                                        <p class="mil-text-s mil-soft">{{ $newsItem['excerpt'] ?: 'Ringkasan berita belum tersedia.' }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light text-center">Belum ada berita untuk ditampilkan.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="pilrek-tl-modal" data-pilrek-tl-modal hidden>
                <div class="pilrek-tl-modal-backdrop" data-pilrek-tl-close></div>
                <div class="pilrek-tl-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="pilrekTlTitleHome">
                    <button type="button" class="pilrek-tl-modal-close" data-pilrek-tl-close
                        aria-label="Tutup detail timeline">&times;</button>
                    <p class="pilrek-tl-modal-kicker" data-pilrek-tl-number>Timeline</p>
                    <h4 class="pilrek-tl-modal-title" id="pilrekTlTitleHome" data-pilrek-tl-title>-</h4>
                    <p class="pilrek-tl-modal-date" data-pilrek-tl-date>-</p>
                    <p class="pilrek-tl-modal-desc" data-pilrek-tl-desc>-</p>
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>

    <script>
        (function () {
            var countdownContainer = document.querySelector("[data-countdown-target]");
            if (!countdownContainer) return;

            var targetDate = new Date(countdownContainer.getAttribute("data-countdown-target")).getTime();
            var daysEl = countdownContainer.querySelector('[data-countdown="days"]');
            var hoursEl = countdownContainer.querySelector('[data-countdown="hours"]');
            var minutesEl = countdownContainer.querySelector('[data-countdown="minutes"]');
            var secondsEl = countdownContainer.querySelector('[data-countdown="seconds"]');

            function pad(value) {
                return String(value).padStart(2, "0");
            }

            function updateCountdown() {
                var now = new Date().getTime();
                var diff = targetDate - now;
                if (diff < 0) diff = 0;

                var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                var hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                var minutes = Math.floor((diff / (1000 * 60)) % 60);
                var seconds = Math.floor((diff / 1000) % 60);

                daysEl.textContent = pad(days);
                hoursEl.textContent = pad(hours);
                minutesEl.textContent = pad(minutes);
                secondsEl.textContent = pad(seconds);
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        })();

        (function () {
            var roadmapSection = document.querySelector("[data-roadmap-section]");
            if (!roadmapSection) return;

            var steps = Array.prototype.slice.call(roadmapSection.querySelectorAll("[data-road-step]"));
            if (!steps.length) return;

            var roadmapCanvas = roadmapSection.querySelector("[data-road-canvas]");
            var roadVisual = roadmapSection.querySelector("[data-road-visual]");
            var roadSvg = roadmapSection.querySelector(".pilrek-road-svg");
            var roadFill = roadmapSection.querySelector("[data-road-fill]");
            var roadLane = roadmapSection.querySelector("[data-road-lane]");
            var milestonesHost = roadmapSection.querySelector("[data-road-milestones]");
            var roadmapLeft = roadmapSection.querySelector("[data-road-left]");
            var modal = document.querySelector("[data-pilrek-tl-modal]");
            var modalNumber = modal ? modal.querySelector("[data-pilrek-tl-number]") : null;
            var modalTitle = modal ? modal.querySelector("[data-pilrek-tl-title]") : null;
            var modalDate = modal ? modal.querySelector("[data-pilrek-tl-date]") : null;
            var modalDesc = modal ? modal.querySelector("[data-pilrek-tl-desc]") : null;

            var milestoneColors = @json($timelineStepColors);
            var milestoneIcons = @json($timelineStepIcons);

            function isCompactView() {
                return window.matchMedia("(max-width: 991px)").matches;
            }

            function getStepDetail(index) {
                var step = steps[index];
                if (!step) return null;

                var numberEl = step.querySelector(".pilrek-step-number");
                var titleEl = step.querySelector(".pilrek-step-title");
                var dateEl = step.querySelector(".pilrek-step-date");
                var descEl = step.querySelector(".pilrek-step-desc");

                return {
                    number: numberEl ? numberEl.textContent.trim() : String(index + 1),
                    title: titleEl ? titleEl.textContent.trim() : "Timeline",
                    date: dateEl ? dateEl.textContent.trim() : "-",
                    description: descEl ? descEl.textContent.trim() : "-"
                };
            }

            function openModal(index) {
                if (!modal) return;
                var detail = getStepDetail(index);
                if (!detail) return;

                if (modalNumber) modalNumber.textContent = "Tahap " + detail.number;
                if (modalTitle) modalTitle.textContent = detail.title;
                if (modalDate) modalDate.textContent = detail.date;
                if (modalDesc) modalDesc.textContent = detail.description;
                modal.hidden = false;
                document.body.style.overflow = "hidden";
            }

            function closeModal() {
                if (!modal) return;
                modal.hidden = true;
                document.body.style.overflow = "";
            }

            if (modal) {
                Array.prototype.forEach.call(modal.querySelectorAll("[data-pilrek-tl-close]"), function (closeEl) {
                    closeEl.addEventListener("click", closeModal);
                });

                document.addEventListener("keydown", function (event) {
                    if (event.key === "Escape" && !modal.hidden) {
                        closeModal();
                    }
                });
            }

            function buildRoadCorePath(width, height, compact) {
                if (compact) {
                    var samples = 150;
                    var startY = height * 0.05;
                    var endY = height * 1.03;
                    var centerX = width * 0.54;
                    var amplitude = width * 0.40;
                    var waves = 1.45;
                    var path = "";

                    for (var s = 0; s <= samples; s++) {
                        var t = s / samples;
                        var envelope = 0.72 + 0.28 * Math.sin(Math.PI * t);
                        var waveX = centerX + amplitude * envelope * Math.sin(Math.PI / 2 + (t * Math.PI * 2 * waves));
                        var waveY = startY + (endY - startY) * t;

                        if (s === 0) {
                            path = "M " + waveX + " " + waveY;
                        } else {
                            path += " L " + waveX + " " + waveY;
                        }
                    }

                    return path;
                }

                function x(value) {
                    return width * value;
                }

                function y(value) {
                    return height * value;
                }

                return [
                    "M " + x(0.43) + " " + y(-0.02),
                    "C " + x(0.56) + " " + y(0.01) + ", " + x(0.69) + " " + y(0.06) + ", " + x(0.80) + " " + y(0.10),
                    "C " + x(0.95) + " " + y(0.15) + ", " + x(0.97) + " " + y(0.28) + ", " + x(0.80) + " " + y(0.34),
                    "C " + x(0.60) + " " + y(0.37) + ", " + x(0.24) + " " + y(0.40) + ", " + x(0.18) + " " + y(0.56),
                    "C " + x(0.11) + " " + y(0.75) + ", " + x(0.42) + " " + y(0.86) + ", " + x(0.74) + " " + y(0.89),
                    "C " + x(0.88) + " " + y(0.91) + ", " + x(0.94) + " " + y(0.95) + ", " + x(0.98) + " " + y(1.04)
                ].join(" ");
            }

            function drawRoad() {
                if (!roadVisual || !roadSvg || !roadFill || !roadLane || !milestonesHost) return;

                var compact = isCompactView();
                var markerCount = Math.min(steps.length, 5);

                if (compact) {
                    var compactHeight = Math.max(340, Math.min(560, 250 + markerCount * 62));
                    roadVisual.style.height = compactHeight + "px";
                    roadVisual.style.minHeight = compactHeight + "px";
                } else {
                    var leftHeight = roadmapLeft ? roadmapLeft.offsetHeight : (roadmapCanvas ? roadmapCanvas.offsetHeight : 620);
                    roadVisual.style.height = leftHeight + "px";
                    roadVisual.style.minHeight = leftHeight + "px";
                }

                var width = roadVisual.clientWidth;
                var height = roadVisual.clientHeight;
                if (width < 40 || height < 40) return;

                roadSvg.setAttribute("viewBox", "0 0 " + width + " " + height);

                var corePath = buildRoadCorePath(width, height, compact);
                roadFill.setAttribute("d", corePath);
                roadLane.setAttribute("d", corePath);

                milestonesHost.innerHTML = "";
                var totalLength = roadLane.getTotalLength();
                var presetRatios = compact ? [0.16, 0.31, 0.48, 0.65, 0.82] : [0.18, 0.32, 0.47, 0.64, 0.80];
                var presetOffsets = compact ? [52, 58, 56, 58, 62] : [62, 72, 70, 72, 78];

                function createRoadFlag(label, ratio, yOffset) {
                    var atLength = totalLength * ratio;
                    var p = roadLane.getPointAtLength(atLength);
                    var pPrev = roadLane.getPointAtLength(Math.max(0, atLength - 2));
                    var pNext = roadLane.getPointAtLength(Math.min(totalLength, atLength + 2));
                    var angle = Math.atan2(pNext.y - pPrev.y, pNext.x - pPrev.x) * 180 / Math.PI;
                    var flag = document.createElement("div");

                    flag.className = "pilrek-road-flag";
                    flag.style.left = p.x + "px";
                    flag.style.top = (p.y + yOffset) + "px";
                    flag.style.setProperty("--rot", angle + "deg");
                    flag.innerHTML = '<div class="pilrek-road-flag-text">' + label + '</div>';
                    milestonesHost.appendChild(flag);
                }

                createRoadFlag("Start", compact ? 0.1 : 0.12, compact ? -8 : -10);
                createRoadFlag("Finish", compact ? 0.93 : 0.94, compact ? 10 : 12);

                for (var i = 0; i < markerCount; i++) {
                    var ratio = presetRatios[i] !== undefined
                        ? presetRatios[i]
                        : (0.1 + (0.78 * i) / Math.max(1, markerCount - 1));
                    var point = roadLane.getPointAtLength(totalLength * ratio);
                    var color = milestoneColors[i % milestoneColors.length];
                    var icon = milestoneIcons[i % milestoneIcons.length];
                    var marker = document.createElement("div");
                    var size = compact ? 74 : 88;
                    var offset = presetOffsets[i] !== undefined ? presetOffsets[i] : 76;
                    var lineHeight = Math.max(28, Math.round(offset - size / 2 - 5));

                    marker.className = "pilrek-road-milestone";
                    marker.style.left = point.x + "px";
                    marker.style.top = (point.y - offset) + "px";
                    marker.style.setProperty("--color", color);
                    marker.style.setProperty("--line", lineHeight + "px");
                    marker.style.setProperty("--size", size + "px");
                    marker.innerHTML = '<div class="icon"><i class="fas ' + icon + '"></i></div><span class="connector"></span><span class="dot"></span>';
                    marker.setAttribute("role", "button");
                    marker.setAttribute("tabindex", "0");
                    marker.setAttribute("aria-label", "Lihat detail tahap " + (i + 1));
                    marker.addEventListener("click", (function (index) {
                        return function () {
                            openModal(index);
                        };
                    })(i));
                    marker.addEventListener("keydown", (function (index) {
                        return function (event) {
                            if (event.key === "Enter" || event.key === " ") {
                                event.preventDefault();
                                openModal(index);
                            }
                        };
                    })(i));

                    milestonesHost.appendChild(marker);
                }
            }

            window.addEventListener("resize", function () {
                window.requestAnimationFrame(drawRoad);
            });

            window.requestAnimationFrame(drawRoad);
        })();
    </script>
@endsection
