@extends('layouts.app')

@section('title', 'Calon Rektor Detail')

@section('content')
<style>
    .pilrek-candidate-photo {
        padding: 22px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 32px;
        background: linear-gradient(180deg, rgba(19, 26, 39, 0.96) 0%, rgba(14, 19, 31, 0.96) 100%);
        box-shadow: 0 30px 70px rgba(0, 0, 0, 0.16);
    }

    .pilrek-candidate-photo img {
        width: 100%;
        border-radius: 22px;
        display: block;
    }

    .pilrek-profile-card {
        padding: 36px 34px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 28px;
        background: linear-gradient(180deg, rgba(19, 26, 39, 0.96) 0%, rgba(14, 19, 31, 0.96) 100%);
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.14);
    }

    .pilrek-profile-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pilrek-profile-list li {
        display: grid;
        grid-template-columns: minmax(180px, 220px) 1fr;
        gap: 18px;
        padding: 16px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .pilrek-profile-list li:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .pilrek-profile-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
        letter-spacing: 0.04em;
    }

    .pilrek-profile-value {
        color: #fff;
        font-size: 16px;
        line-height: 1.6;
    }

    .pilrek-vision-box {
        padding: 42px 38px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .pilrek-program-card {
        height: 100%;
        padding: 34px 30px;
        border-radius: 26px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    @media (max-width: 991px) {
        .pilrek-profile-list li {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .pilrek-profile-card,
        .pilrek-vision-box {
            padding: 30px 24px;
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
    @include('partials.navbar', ['activePage' => 'calon-rektor'])



    <div id="smooth-content">

        <div class="mil-banner mil-banner-inner mil-dissolve">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-9">
                        <div class="mil-banner-text mil-text-center">
                            <div class="mil-text-m mil-mb-20">Calon Rektor</div>
                            <h1 class="mil-mb-40">Prof. Dr. Ir. Ahmad Prasetyo, M.Sc.</h1>
                            <ul class="mil-breadcrumbs mil-pub-info mil-center">
                                <li><span>Fakultas Teknik</span></li>
                                <li><span>Guru Besar Teknik Industri</span></li>
                                <li><span>Pencalonan 2026-2030</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mil-p-0-160">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-xl-4 col-lg-5 mil-mb-60">
                        <div class="pilrek-candidate-photo mil-up">
                            <img src="{{ asset('template/img/inner-pages/team/1.png') }}" alt="Prof. Dr. Ir. Ahmad Prasetyo, M.Sc.">
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 mil-mb-60">
                        <div class="pilrek-profile-card mil-up">
                            <div class="mil-text-m mil-text-gradient-2 mil-mb-20">Profil Calon</div>
                            <h3 class="mil-mb-30">Informasi Akademik dan Kelembagaan</h3>
                            <ul class="pilrek-profile-list">
                                <li>
                                    <div class="pilrek-profile-label">Nama Lengkap</div>
                                    <div class="pilrek-profile-value">Prof. Dr. Ir. Ahmad Prasetyo, M.Sc.</div>
                                </li>
                                <li>
                                    <div class="pilrek-profile-label">NIP</div>
                                    <div class="pilrek-profile-value">19690415 199403 1 002</div>
                                </li>
                                <li>
                                    <div class="pilrek-profile-label">Tempat, Tanggal Lahir</div>
                                    <div class="pilrek-profile-value">Makassar, 15 April 1969</div>
                                </li>
                                <li>
                                    <div class="pilrek-profile-label">Fakultas / Unit</div>
                                    <div class="pilrek-profile-value">Fakultas Teknik</div>
                                </li>
                                <li>
                                    <div class="pilrek-profile-label">Jurusan / Program Studi</div>
                                    <div class="pilrek-profile-value">Teknik Industri</div>
                                </li>
                                <li>
                                    <div class="pilrek-profile-label">Jabatan Akademik</div>
                                    <div class="pilrek-profile-value">Guru Besar</div>
                                </li>
                                <li>
                                    <div class="pilrek-profile-label">Jabatan Saat Ini</div>
                                    <div class="pilrek-profile-value">Dekan Fakultas Teknik</div>
                                </li>
                                <li>
                                    <div class="pilrek-profile-label">Pendidikan Terakhir</div>
                                    <div class="pilrek-profile-value">Doktor Manajemen Teknologi Pendidikan Tinggi</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="pilrek-vision-box mil-mb-30 mil-up">
                            <div class="mil-text-m mil-text-gradient-2 mil-mb-20">Visi</div>
                            <h3 class="mil-mb-20">Mewujudkan universitas yang unggul, berintegritas, inklusif, dan berdaya saing global melalui tata kelola akademik yang kolaboratif dan berkelanjutan.</h3>
                            <p class="mil-text-m mil-soft">Visi ini menempatkan kualitas akademik, penguatan riset, pelayanan kelembagaan, serta pengembangan sumber daya manusia sebagai fondasi utama dalam membangun universitas yang relevan terhadap kebutuhan masyarakat dan perkembangan ilmu pengetahuan.</p>
                        </div>

                        <div class="pilrek-vision-box mil-up">
                            <div class="mil-text-m mil-text-gradient-2 mil-mb-20">Misi</div>
                            <ul class="mil-list-2 mil-type-2">
                                <li>
                                    <div class="mil-up">
                                        <h5 class="mil-mb-15">Penguatan Mutu Akademik</h5>
                                        <p class="mil-text-m mil-soft">Mendorong peningkatan kualitas pembelajaran, akreditasi program studi, dan budaya akademik yang adaptif terhadap tantangan masa depan.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="mil-up">
                                        <h5 class="mil-mb-15">Peningkatan Riset dan Inovasi</h5>
                                        <p class="mil-text-m mil-soft">Memperluas ekosistem riset unggulan yang terintegrasi dengan kebutuhan industri, pemerintah, dan masyarakat.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="mil-up">
                                        <h5 class="mil-mb-15">Tata Kelola Transparan</h5>
                                        <p class="mil-text-m mil-soft">Membangun sistem tata kelola yang akuntabel, partisipatif, dan berbasis data dalam seluruh proses kelembagaan.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="mil-up">
                                        <h5 class="mil-mb-15">Penguatan Jejaring Strategis</h5>
                                        <p class="mil-text-m mil-soft">Meningkatkan kemitraan nasional dan internasional untuk mendukung mobilitas akademik, kolaborasi riset, dan pengabdian masyarakat.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        @include('partials.footer')

    </div>
</div>
@endsection

