@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<style>
    .pilrek-news-grid {
        row-gap: 30px;
    }

    .pilrek-news-card {
        display: block;
        height: 100%;
        border-radius: 28px;
        overflow: hidden;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbf8 100%);
        border: none;
        box-shadow: 0 18px 50px rgba(23, 67, 46, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pilrek-news-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 24px 55px rgba(23, 67, 46, 0.12);
    }

    .pilrek-news-card .mil-card-cover {
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: #edf5ee;
    }

    .pilrek-news-card .mil-card-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pilrek-news-card .mil-descr {
        padding: 26px 24px 28px;
    }

    .pilrek-news-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
    }

    .pilrek-news-tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        border-radius: 999px;
        background: #2b7a4b;
        color: #fff;
        font-size: 11px;
        line-height: 1;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .pilrek-news-title {
        min-height: 86px;
        margin-bottom: 18px;
        color: #1f4b35;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    .pilrek-news-meta-label {
        color: rgba(31, 75, 53, 0.58);
        font-size: 12px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .pilrek-news-meta-value {
        color: #547361;
        font-size: 15px;
        line-height: 1.5;
    }

    .pilrek-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .pilrek-pagination-link {
        min-width: 46px;
        height: 46px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        border: 1px solid rgba(43, 122, 75, 0.14);
        background: #ffffff;
        color: #1f4b35;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .pilrek-pagination-link:hover,
    .pilrek-pagination-link.pilrek-active {
        background: #2b7a4b;
        border-color: #2b7a4b;
        color: #fff;
    }

    .pilrek-pagination-link.pilrek-disabled {
        opacity: 0.45;
        pointer-events: none;
    }

    @media (max-width: 767px) {
        .pilrek-news-grid {
            row-gap: 22px;
        }

        .pilrek-news-card .mil-descr {
            padding: 22px 20px 24px;
        }
    }
</style>
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
    @include('partials.navbar', ['activePage' => 'berita'])

    <div id="smooth-content">
        <div class="mil-banner mil-banner-inner mil-dissolve">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8">
                        <div class="mil-banner-text mil-text-center">
                            <div class="mil-text-m mil-mb-20">Informasi &amp; Berita</div>
                            <h1 class="mil-mb-30">Pemilihan Rektor 2026</h1>
                            <p class="mil-text-m mil-soft mil-mb-40">Pengumuman, kegiatan, dan informasi resmi terkait pemilihan rektor</p>
                            <ul class="mil-breadcrumbs mil-center">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('berita') }}">Berita</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mil-blog-list mil-p-0-160">
            <div class="container">
                <div class="row pilrek-news-grid">
                    @forelse ($posts as $post)
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <a href="{{ route('publikasi', ['slug' => $post['slug']]) }}" class="pilrek-news-card mil-mb-30 mil-up">
                                <div class="mil-card-cover">
                                    <img src="{{ $post['cover_url'] }}" alt="{{ $post['title'] }}" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                                </div>
                                <div class="mil-descr">
                                    <div class="pilrek-news-tags">
                                        @forelse ($post['tags'] as $tag)
                                            <span class="pilrek-news-tag">{{ $tag }}</span>
                                        @empty
                                            <span class="pilrek-news-tag">berita</span>
                                        @endforelse
                                    </div>
                                    <h4 class="pilrek-news-title">{{ $post['title'] }}</h4>
                                    <div class="pilrek-news-meta-label">Tanggal Terbit</div>
                                    <div class="pilrek-news-meta-value">{{ $post['published_label'] }}</div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-light text-center">Belum ada berita yang dipublikasikan.</div>
                        </div>
                    @endforelse
                </div>

                @if ($posts->lastPage() > 1)
                    <div class="mil-text-center mil-mt-30 mil-up">
                        <div class="pilrek-pagination">
                            <a href="{{ $posts->previousPageUrl() ?: '#' }}" class="pilrek-pagination-link {{ $posts->onFirstPage() ? 'pilrek-disabled' : '' }}">Previous</a>
                            @for ($page = 1; $page <= $posts->lastPage(); $page++)
                                <a href="{{ $posts->url($page) }}" class="pilrek-pagination-link {{ $posts->currentPage() === $page ? 'pilrek-active' : '' }}">{{ $page }}</a>
                            @endfor
                            <a href="{{ $posts->nextPageUrl() ?: '#' }}" class="pilrek-pagination-link {{ $posts->hasMorePages() ? '' : 'pilrek-disabled' }}">Next</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @include('partials.footer')
    </div>
</div>
@endsection
