@extends('layouts.app')

@section('title', 'Detail Calon Rektor')

@section('content')
<style>
    .pilrek-detail-section {
        max-width: 1120px;
        margin: 0 auto;
    }

    .pilrek-candidate-photo {
        padding: 18px;
        border: none;
        border-radius: 32px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbf8 100%);
        box-shadow: 0 22px 55px rgba(23, 67, 46, 0.08);
    }

    .pilrek-candidate-photo img {
        width: 100%;
        border-radius: 24px;
        display: block;
        object-fit: cover;
    }

    .pilrek-profile-card,
    .pilrek-content-card {
        padding: 38px 34px;
        border: none;
        border-radius: 30px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbf8 100%);
        box-shadow: 0 22px 55px rgba(23, 67, 46, 0.08);
    }

    .pilrek-section-kicker {
        color: #2b7a4b;
        font-size: 14px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .pilrek-section-title,
    .pilrek-profile-card h3,
    .pilrek-content-card h3 {
        color: #1f4b35;
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
        border-bottom: 1px solid rgba(43, 122, 75, 0.12);
    }

    .pilrek-profile-list li:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .pilrek-profile-label {
        color: #6d8576;
        font-size: 14px;
        letter-spacing: 0.04em;
    }

    .pilrek-profile-value {
        color: #294836;
        font-size: 16px;
        line-height: 1.7;
    }

    .pilrek-content-card p {
        color: #5b7263;
        font-size: 15px;
        line-height: 1.9;
        margin-bottom: 18px;
    }

    .pilrek-content-card p:last-child {
        margin-bottom: 0;
    }

    .pilrek-vision-statement {
        padding: 28px 30px;
        border-radius: 24px;
        background: #f1f7f2;
        border-left: 5px solid #2b7a4b;
        margin-bottom: 24px;
    }

    .pilrek-vision-statement h4 {
        color: #1f4b35;
        line-height: 1.5;
        margin: 0;
    }

    .pilrek-mission-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pilrek-mission-item {
        display: grid;
        grid-template-columns: 72px 1fr;
        gap: 22px;
        padding: 24px 0;
        border-bottom: 1px solid rgba(43, 122, 75, 0.12);
    }

    .pilrek-mission-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .pilrek-mission-number {
        width: 56px;
        height: 56px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #2b7a4b;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }

    .pilrek-mission-body h5 {
        color: #1f4b35;
        margin-bottom: 10px;
    }

    .pilrek-mission-body p {
        margin: 0;
        color: #5b7263;
        line-height: 1.8;
    }

    @media (max-width: 991px) {
        .pilrek-profile-list li {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .pilrek-profile-card,
        .pilrek-content-card {
            padding: 30px 24px;
        }
    }

    @media (max-width: 767px) {
        .pilrek-mission-item {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .pilrek-mission-number {
            width: 48px;
            height: 48px;
            font-size: 16px;
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
            <div class="container pilrek-detail-section">

                <div class="row align-items-start">
                    <div class="col-xl-4 col-lg-5 mil-mb-60">
                        <div class="pilrek-candidate-photo mil-up">
                            <img src="{{ asset('template/img/inner-pages/team/1.png') }}" alt="Prof. Dr. Ir. Ahmad Prasetyo, M.Sc.">
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 mil-mb-60">
                        <div class="pilrek-profile-card mil-up">
                            <div class="pilrek-section-kicker mil-mb-20">Profil Calon</div>
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
                    <div class="col-xl-10 mil-mb-30">
                        <div class="pilrek-content-card mil-up">
                            <div class="pilrek-section-kicker mil-mb-20">Profil Singkat</div>
                            <h3 class="mil-mb-25">Ringkasan Akademik dan Kepemimpinan</h3>
                            <p>Prof. Dr. Ir. Ahmad Prasetyo, M.Sc. merupakan akademisi senior yang telah mengabdikan diri secara konsisten dalam pengembangan pendidikan tinggi, penguatan riset terapan, dan peningkatan tata kelola fakultas. Pengalaman panjang dalam tridarma perguruan tinggi membentuk kepemimpinan yang menekankan integritas, kualitas akademik, dan pelayanan kelembagaan yang berkelanjutan.</p>
                            <p>Dalam perjalanan kariernya, beliau pernah mengemban amanah sebagai ketua program studi, wakil dekan, hingga dekan, dengan fokus pada penguatan mutu pembelajaran, pembinaan dosen muda, dan perluasan jejaring kolaborasi. Rekam jejak tersebut menjadi landasan utama dalam menawarkan arah kepemimpinan universitas yang lebih tertata, inklusif, dan responsif terhadap kebutuhan sivitas akademika.</p>
                        </div>
                    </div>

                    <div class="col-xl-10 mil-mb-30">
                        <div class="pilrek-content-card mil-up">
                            <div class="pilrek-section-kicker mil-mb-20">Visi</div>
                            <div class="pilrek-vision-statement">
                                <h4>Mewujudkan universitas yang unggul, berintegritas, inklusif, dan berdaya saing global melalui tata kelola akademik yang kolaboratif dan berkelanjutan.</h4>
                            </div>
                            <p>Visi ini menempatkan penguatan mutu akademik, pengembangan sumber daya manusia, serta tata kelola institusi yang terbuka sebagai pilar utama dalam membangun universitas yang adaptif terhadap perubahan zaman dan tetap berakar pada nilai-nilai keilmuan.</p>
                        </div>
                    </div>

                    <div class="col-xl-10">
                        <div class="pilrek-content-card mil-up">
                            <div class="pilrek-section-kicker mil-mb-20">Misi</div>
                            <h3 class="mil-mb-15">Agenda Strategis Kepemimpinan</h3>
                            <ul class="pilrek-mission-list">
                                <li class="pilrek-mission-item">
                                    <div class="pilrek-mission-number">01</div>
                                    <div class="pilrek-mission-body">
                                        <h5>Penguatan Mutu Akademik</h5>
                                        <p>Mendorong peningkatan kualitas pembelajaran, akreditasi program studi, serta pengembangan kurikulum yang relevan dengan kebutuhan ilmu pengetahuan, dunia kerja, dan kepentingan masyarakat luas.</p>
                                    </div>
                                </li>
                                <li class="pilrek-mission-item">
                                    <div class="pilrek-mission-number">02</div>
                                    <div class="pilrek-mission-body">
                                        <h5>Peningkatan Riset dan Inovasi</h5>
                                        <p>Memperkuat ekosistem riset unggulan melalui kolaborasi lintas disiplin, dukungan terhadap publikasi ilmiah, serta hilirisasi inovasi yang memberikan dampak nyata bagi pembangunan daerah dan nasional.</p>
                                    </div>
                                </li>
                                <li class="pilrek-mission-item">
                                    <div class="pilrek-mission-number">03</div>
                                    <div class="pilrek-mission-body">
                                        <h5>Tata Kelola Transparan dan Akuntabel</h5>
                                        <p>Membangun sistem tata kelola universitas yang partisipatif, berbasis data, dan akuntabel guna memastikan setiap kebijakan kelembagaan dapat dipertanggungjawabkan secara akademik maupun administratif.</p>
                                    </div>
                                </li>
                                <li class="pilrek-mission-item">
                                    <div class="pilrek-mission-number">04</div>
                                    <div class="pilrek-mission-body">
                                        <h5>Penguatan Jejaring Strategis</h5>
                                        <p>Meningkatkan kemitraan dengan perguruan tinggi, lembaga pemerintah, industri, dan komunitas internasional untuk memperluas ruang kolaborasi akademik, mobilitas, dan pengabdian kepada masyarakat.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('partials.footer')

    </div>
</div>
@endsection
