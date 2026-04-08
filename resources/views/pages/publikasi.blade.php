@extends('layouts.app')

@section('title', $post['title'] ?? 'Publikasi')

@section('content')
<div id="smooth-wrapper" class="mil-wrapper">
    <div class="mil-preloader">
        <div class="mil-load"></div>
        <p class="h2 mil-mb-30"><span class="mil-light mil-counter" data-number="100">100</span><span class="mil-light">%</span></p>
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
                    <div class="col-xl-9">
                        <div class="mil-banner-text mil-text-center">
                            <div class="mil-text-m mil-mb-20">Publikasi Berita</div>
                            <h1 class="mil-mb-60">{{ $post['title'] }}</h1>
                            <ul class="mil-breadcrumbs mil-pub-info mil-center">
                                <li><span>{{ $post['published_label'] ?? '-' }}</span></li>
                                <li><a href="{{ route('berita') }}">Semua Berita</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mil-blog-list mil-p-0-160">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="mil-pub-cover mil-up">
                            <img src="{{ $post['cover_url'] }}" alt="{{ $post['title'] }}" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                        </div>
                    </div>

                    <div class="col-xl-9 mil-p-80-80">
                        <h2 class="mil-mb-40 mil-up">{{ $post['title'] }}</h2>
                        <p class="mil-text-m mil-soft mil-mb-30 mil-up">{{ $post['excerpt'] ?: 'Ringkasan berita belum tersedia.' }}</p>
                        <div class="mil-text-m mil-soft mil-up">
                            {!! $post['content'] ?: '<p>Konten berita belum tersedia.</p>' !!}
                        </div>
                    </div>

                    <div class="col-xl-9">
                        @if (!empty($post['tags']))
                            <ul class="mil-pup-tags mil-mb-80 mil-up">
                                @foreach ($post['tags'] as $tag)
                                    <li><a href="javascript:void(0)">{{ $tag }}</a></li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="mil-next-post">
                            <a href="{{ route('publikasi', ['slug' => $nextPost['slug']]) }}" class="mil-descr mil-up">
                                <p class="mil-text-m mil-soft mil-mb-15">Baca berita berikutnya</p>
                                <h5>{{ $nextPost['title'] }}</h5>
                            </a>
                            <a href="{{ route('publikasi', ['slug' => $nextPost['slug']]) }}" class="mil-cover mil-up">
                                <img src="{{ $nextPost['cover_url'] }}" alt="{{ $nextPost['title'] }}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>
</div>
@endsection
