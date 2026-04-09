@extends('layouts.app')

@section('title', 'Unduhan | Pilrek Unmul 2026-2030')

@section('content')
    <style>
        .pilrek-download-hero {
            padding-top: 170px;
            padding-bottom: 56px;
        }

        .pilrek-download-kicker {
            color: #145843;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .pilrek-download-shell {
            border-radius: 26px;
            border: 1px solid rgba(20, 88, 67, 0.14);
            background: #fff;
            box-shadow: 0 14px 32px rgba(20, 88, 67, 0.08);
            overflow: hidden;
        }

        .pilrek-download-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            align-items: center;
            gap: 16px;
            padding: 22px 28px;
            border-bottom: 1px solid rgba(20, 88, 67, 0.1);
        }

        .pilrek-download-row:last-child {
            border-bottom: 0;
        }

        .pilrek-download-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 8px;
        }

        .pilrek-download-type {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 58px;
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(20, 88, 67, 0.1);
            color: #145843;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .pilrek-download-info {
            display: inline-flex;
            align-items: center;
            color: #658276;
            font-size: 13px;
        }

        .pilrek-download-name {
            margin: 0;
            color: #113d2f;
            font-size: clamp(18px, 1.5vw, 22px);
            line-height: 1.35;
        }

        .pilrek-download-btn {
            white-space: nowrap;
        }

        .pilrek-download-btn.pilrek-disabled {
            background: #e7ece9 !important;
            color: #7f8f88 !important;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width: 767px) {
            .pilrek-download-row {
                grid-template-columns: 1fr;
                align-items: flex-start;
                padding: 18px 16px;
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
        @include('partials.navbar', ['activePage' => 'unduhan'])

        <div id="smooth-content">
            <div class="pilrek-download-hero">
                <div class="container mil-text-center">
                    <div class="mil-text-m pilrek-download-kicker mil-mb-15">Unduhan</div>
                    <h1 class="mil-mb-20">Dokumen Pilrek Unmul</h1>
                    <p class="mil-text-m mil-soft">
                        Daftar dokumen resmi pemilihan rektor yang dapat diunduh dalam format PDF/DOCX.
                    </p>
                </div>
            </div>

            <div class="mil-p-0-160">
                <div class="container">
                    <div class="pilrek-download-shell mil-up">
                        @forelse ($documents as $document)
                            <div class="pilrek-download-row">
                                <div>
                                    <div class="pilrek-download-meta">
                                        <span class="pilrek-download-type">{{ $document['type'] ?? 'FILE' }}</span>
                                        <span class="pilrek-download-info">Diperbarui: {{ $document['updated_label'] ?? '-' }}</span>
                                        <span class="pilrek-download-info">Ukuran: {{ $document['size_label'] ?? '-' }}</span>
                                    </div>
                                    <h5 class="pilrek-download-name">{{ $document['title'] ?? '-' }}</h5>
                                    @if (!empty($document['description']))
                                        <p class="mil-text-s mil-soft mt-2 mb-0">{{ $document['description'] }}</p>
                                    @endif
                                </div>
                                <a href="{{ !empty($document['is_available']) ? ($document['file_url'] ?? '#') : '#' }}"
                                    class="mil-btn mil-m pilrek-download-btn {{ !empty($document['is_available']) ? 'mil-add-arrow' : 'pilrek-disabled' }}"
                                    {{ !empty($document['is_available']) ? 'download' : 'aria-disabled=true' }}>
                                    {{ !empty($document['is_available']) ? 'Download' : 'Segera Tersedia' }}
                                </a>
                            </div>
                        @empty
                            <div class="pilrek-download-row">
                                <div>
                                    <h5 class="pilrek-download-name">Belum ada dokumen unduhan.</h5>
                                    <p class="mil-text-s mil-soft mt-2 mb-0">Dokumen akan ditampilkan setelah ditambahkan dari
                                        panel admin.</p>
                                </div>
                                <a href="#" class="mil-btn mil-m pilrek-download-btn pilrek-disabled"
                                    aria-disabled="true">Segera Tersedia</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>
@endsection
