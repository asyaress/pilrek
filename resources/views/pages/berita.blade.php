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

        @php
            $allPosts = [
                [
                    'id' => 1,
                    'slug' => 'pengumuman-tahapan-penjaringan',
                    'image' => '1.png',
                    'title' => 'Pengumuman Tahapan Penjaringan Bakal Calon Rektor Periode 2026-2030',
                    'tags' => ['pengumuman', 'tahapan', 'resmi'],
                    'published_at' => '03 April 2026',
                ],
                [
                    'id' => 2,
                    'slug' => 'sosialisasi-pilrek-senat-akademik',
                    'image' => '2.png',
                    'title' => 'Sosialisasi Pemilihan Rektor Bersama Senat Akademik dan Sivitas Kampus',
                    'tags' => ['sosialisasi', 'senat', 'kampus'],
                    'published_at' => '05 April 2026',
                ],
                [
                    'id' => 3,
                    'slug' => 'rapat-koordinasi-panitia-pilrek',
                    'image' => '3.png',
                    'title' => 'Rapat Koordinasi Panitia Pemilihan Rektor Membahas Agenda Verifikasi Administrasi',
                    'tags' => ['rapat', 'panitia', 'verifikasi'],
                    'published_at' => '07 April 2026',
                ],
                [
                    'id' => 4,
                    'slug' => 'penetapan-daftar-calon-sementara',
                    'image' => '4.png',
                    'title' => 'Penetapan Daftar Calon Sementara Pemilihan Rektor Tahun 2026',
                    'tags' => ['penetapan', 'calon', 'pengumuman'],
                    'published_at' => '09 April 2026',
                ],
                [
                    'id' => 5,
                    'slug' => 'kegiatan-dialog-terbuka-kandidat',
                    'image' => '5.png',
                    'title' => 'Kegiatan Dialog Terbuka Kandidat Bersama Dosen, Mahasiswa, dan Tenaga Kependidikan',
                    'tags' => ['kegiatan', 'dialog', 'kandidat'],
                    'published_at' => '11 April 2026',
                ],
                [
                    'id' => 6,
                    'slug' => 'publikasi-jadwal-penyampaian-visi-misi',
                    'image' => '6.png',
                    'title' => 'Publikasi Jadwal Penyampaian Visi dan Misi Calon Rektor Secara Terbuka',
                    'tags' => ['jadwal', 'visi-misi', 'publikasi'],
                    'published_at' => '13 April 2026',
                ],
                [
                    'id' => 7,
                    'slug' => 'hasil-verifikasi-berkas-calon',
                    'image' => '7.png',
                    'title' => 'Hasil Verifikasi Berkas Administratif Calon Rektor Diumumkan Secara Resmi',
                    'tags' => ['verifikasi', 'berkas', 'resmi'],
                    'published_at' => '15 April 2026',
                ],
                [
                    'id' => 8,
                    'slug' => 'notulensi-rapat-senat-terbuka',
                    'image' => '8.png',
                    'title' => 'Notulensi Rapat Senat Terbuka Terkait Proses Pemilihan Rektor 2026',
                    'tags' => ['senat', 'rapat', 'dokumen'],
                    'published_at' => '17 April 2026',
                ],
                [
                    'id' => 9,
                    'slug' => 'pengumuman-debat-terbuka',
                    'image' => '9.png',
                    'title' => 'Pengumuman Debat Terbuka Calon Rektor untuk Sivitas Akademika',
                    'tags' => ['debat', 'pengumuman', 'akademika'],
                    'published_at' => '19 April 2026',
                ],
                [
                    'id' => 10,
                    'slug' => 'dokumentasi-kegiatan-panitia',
                    'image' => '10.png',
                    'title' => 'Dokumentasi Kegiatan Panitia dalam Menyiapkan Tahapan Pemilihan Rektor',
                    'tags' => ['dokumentasi', 'panitia', 'kegiatan'],
                    'published_at' => '21 April 2026',
                ],
                [
                    'id' => 11,
                    'slug' => 'surat-edaran-tata-tertib',
                    'image' => '11.png',
                    'title' => 'Surat Edaran Tata Tertib Penyampaian Program Kerja Calon Rektor',
                    'tags' => ['surat edaran', 'tata tertib', 'resmi'],
                    'published_at' => '23 April 2026',
                ],
                [
                    'id' => 12,
                    'slug' => 'pengumuman-hasil-tahap-akhir',
                    'image' => '12.png',
                    'title' => 'Pengumuman Hasil Tahap Akhir Seleksi Pemilihan Rektor Periode 2026-2030',
                    'tags' => ['hasil akhir', 'pengumuman', 'pilrek'],
                    'published_at' => '25 April 2026',
                ],
            ];

            $perPage = 6;
            $currentPage = request()->integer('page', 1);
            $postCollection = collect($allPosts);
            $currentItems = $postCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $posts = new \Illuminate\Pagination\LengthAwarePaginator(
                $currentItems,
                $postCollection->count(),
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );
        @endphp

        <div class="mil-blog-list mil-p-0-160">
            <div class="container">
                <div class="row pilrek-news-grid">
                    @foreach ($posts as $post)
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <a href="{{ route('publikasi') }}" class="pilrek-news-card mil-mb-30 mil-up">
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
                                    <div class="pilrek-news-tags">
                                        @foreach ($post['tags'] as $tag)
                                            <span class="pilrek-news-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                    <h4 class="pilrek-news-title">{{ $post['title'] }}</h4>
                                    <div class="pilrek-news-meta-label">Tanggal Terbit</div>
                                    <div class="pilrek-news-meta-value">{{ $post['published_at'] }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mil-text-center mil-mt-30 mil-up">
                    <div class="pilrek-pagination">
                        <a href="{{ $posts->previousPageUrl() ?: '#' }}" class="pilrek-pagination-link {{ $posts->onFirstPage() ? 'pilrek-disabled' : '' }}">Previous</a>
                        @for ($page = 1; $page <= $posts->lastPage(); $page++)
                            <a href="{{ $posts->url($page) }}" class="pilrek-pagination-link {{ $posts->currentPage() === $page ? 'pilrek-active' : '' }}">{{ $page }}</a>
                        @endfor
                        <a href="{{ $posts->nextPageUrl() ?: '#' }}" class="pilrek-pagination-link {{ $posts->hasMorePages() ? '' : 'pilrek-disabled' }}">Next</a>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer')

    </div>
</div>
@endsection


