@php
    $activePage = $activePage ?? '';
    $navbarInstitutionLogos = collect($institutionLogos ?? [])
        ->filter(static fn (array $item): bool => ($item['is_active'] ?? true) && !empty($item['path']))
        ->sortBy('logo_order')
        ->values();
    $navbarCandidateStatuses = collect();

    if (\Illuminate\Support\Facades\Schema::hasTable('rector_candidates')) {
        if (\Illuminate\Support\Facades\Schema::hasColumn('rector_candidates', 'status')) {
            $navbarCandidateStatuses = \App\Models\RectorCandidate::query()
                ->where('is_active', true)
                ->select('status')
                ->distinct()
                ->pluck('status')
                ->filter();
        } elseif (\App\Models\RectorCandidate::query()->where('is_active', true)->exists()) {
            $navbarCandidateStatuses = collect([\App\Models\RectorCandidate::STATUS_CALON]);
        }
    } else {
        $navbarCandidateStatuses = collect(\App\Models\RectorCandidate::defaultSeedData())
            ->where('is_active', true)
            ->pluck('status')
            ->filter();
    }

    $hasBalonNavbar = $navbarCandidateStatuses->contains(\App\Models\RectorCandidate::STATUS_BALON)
        || $navbarCandidateStatuses->contains(\App\Models\RectorCandidate::STATUS_CALON);
    $hasCalonNavbar = $navbarCandidateStatuses->contains(\App\Models\RectorCandidate::STATUS_CALON);
@endphp

@once
    <style>
        .mil-top-panel.pilrek-top-panel-inline-logos {
            height: auto !important;
            min-height: 94px;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 12px rgba(13, 81, 82, 0.08);
            padding: 6px 0;
        }

        .mil-top-panel.pilrek-top-panel-inline-logos.mil-active {
            height: auto !important;
            background: rgba(255, 255, 255, 0.98);
        }

        .mil-top-panel.pilrek-top-panel-inline-logos .container {
            min-height: 0 !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .pilrek-navbar-logo-group {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 0 0 auto;
            min-width: 0;
            white-space: nowrap;
        }

        .pilrek-navbar-center {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1 1 auto;
            position: relative;
        }

        .mil-top-panel.pilrek-top-panel-inline-logos .mil-menu-buttons {
            flex: 0 0 auto;
            position: relative;
            z-index: 35;
        }

        .pilrek-navbar-inst-item {
            flex: 0 0 auto;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .pilrek-navbar-inst-item.pilrek-navbar-logo-square {
            width: 56px;
        }

        .pilrek-navbar-inst-item.pilrek-navbar-logo-dies {
            width: 46px;
        }

        .pilrek-navbar-inst-item.pilrek-navbar-logo-dikti {
            width: 150px;
        }

        .pilrek-navbar-inst-item.pilrek-navbar-logo-unggul {
            width: 126px;
        }

        .pilrek-navbar-inst-item img {
            width: auto;
            max-width: 100%;
            max-height: 56px;
            object-fit: contain;
            display: block;
        }

        @media (max-width: 1200px) {
            .mil-top-panel.pilrek-top-panel-inline-logos {
                min-height: 80px;
                padding: 0;
            }

            .mil-top-panel.pilrek-top-panel-inline-logos .container {
                gap: 8px;
            }

            .pilrek-navbar-logo-group {
                display: flex;
                flex: 1 1 auto;
                overflow-x: auto;
                scrollbar-width: thin;
                padding-right: 8px;
            }

            .pilrek-navbar-logo-group::-webkit-scrollbar {
                height: 4px;
            }

            .pilrek-navbar-logo-group::-webkit-scrollbar-thumb {
                background: rgba(20, 88, 67, 0.22);
                border-radius: 999px;
            }

            .pilrek-navbar-center {
                justify-content: flex-end;
                flex: 0 0 auto;
            }

            .pilrek-navbar-inst-item {
                height: 48px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-square {
                width: 50px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-dies {
                width: 40px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-dikti {
                width: 132px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-unggul {
                width: 112px;
            }

            .pilrek-navbar-inst-item img {
                max-height: 48px;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a {
                color: #145843;
                -webkit-tap-highlight-color: rgba(255, 193, 7, 0.24);
            }

            .pilrek-top-panel-inline-logos .mil-top-menu {
                position: fixed;
                inset: 0;
                top: 0;
                left: 0;
                width: 100vw;
                max-width: 100vw;
                height: 100dvh;
                padding: 0;
                background: rgba(10, 28, 29, 0.22);
                opacity: 0;
                pointer-events: none;
                transform: none;
                box-shadow: none;
                overflow: hidden;
                transition: opacity 0.25s ease;
                z-index: 30;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu.mil-active {
                opacity: 1;
                pointer-events: auto;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                width: min(340px, 86vw);
                max-width: 86vw;
                display: flex;
                flex-direction: column;
                gap: 8px;
                margin: 0;
                padding: 94px 14px 18px;
                background: linear-gradient(180deg, #ffffff 0%, #f3faf7 100%);
                box-shadow: -18px 0 34px rgba(13, 81, 82, 0.18);
                overflow-y: auto;
                transform: translateX(100%);
                transition: transform 0.28s ease;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu.mil-active ul {
                transform: translateX(0);
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul li {
                width: 100%;
                max-width: 100%;
                margin: 0;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a {
                display: block;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                padding: 14px 16px;
                border-radius: 16px;
                background: #f4faf8;
                font-size: 15px;
                font-weight: 600;
                line-height: 1.35;
                white-space: normal;
                overflow-wrap: anywhere;
                word-break: normal;
                transition: transform 0.18s ease, background-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease;
                box-shadow: 0 1px 0 rgba(13, 81, 82, 0.04);
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:hover,
            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:focus,
            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:focus-visible,
            .pilrek-top-panel-inline-logos .mil-top-menu ul li.mil-active > a {
                color: #ffc107 !important;
                background: #145843;
                box-shadow: 0 10px 24px rgba(20, 88, 67, 0.18);
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:active {
                color: #ffc107 !important;
                background: #145843;
                transform: scale(0.98);
                box-shadow: 0 6px 14px rgba(20, 88, 67, 0.16);
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul li.mil-active > a:before {
                opacity: 1;
                background: #ffc107;
            }
        }

        @media (max-width: 767px) {
            .mil-top-panel.pilrek-top-panel-inline-logos .container {
                gap: 6px;
            }

            .pilrek-navbar-logo-group {
                gap: 2px;
                padding-right: 10px;
            }

            .pilrek-navbar-inst-item {
                height: 40px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-square {
                width: 42px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-dies {
                width: 34px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-dikti {
                width: 106px;
            }

            .pilrek-navbar-inst-item.pilrek-navbar-logo-unggul {
                width: 90px;
            }

            .pilrek-navbar-inst-item img {
                max-height: 40px;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu {
                width: 100vw;
                max-width: 100vw;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul {
                width: min(300px, 88vw);
                max-width: 88vw;
                padding: 84px 12px 16px;
            }

            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a {
                padding: 12px 14px;
                font-size: 14px;
            }
        }
    </style>
@endonce

<div class="mil-top-panel pilrek-top-panel-inline-logos">
    <div class="container">
        <div class="pilrek-navbar-logo-group">
            @foreach ($navbarInstitutionLogos as $logoIndex => $logo)
                @php
                    $logoPath = strtolower((string) ($logo['path'] ?? ''));
                    $logoSizeClass = 'pilrek-navbar-logo-square';
                    if (str_contains($logoPath, 'dies-natalis')) {
                        $logoSizeClass = 'pilrek-navbar-logo-dies';
                    } elseif (str_contains($logoPath, 'diktisaintek')) {
                        $logoSizeClass = 'pilrek-navbar-logo-dikti';
                    } elseif (str_contains($logoPath, 'logo-unggul')) {
                        $logoSizeClass = 'pilrek-navbar-logo-unggul';
                    }
                @endphp
                <div class="pilrek-navbar-inst-item {{ $logoSizeClass }}">
                    <img src="{{ asset($logo['path']) }}" alt="{{ $logo['name'] ?: ('Logo Institusi ' . ($logoIndex + 1)) }}">
                </div>
            @endforeach
        </div>

        <div class="pilrek-navbar-center">
            <nav class="mil-top-menu">
                <ul>
                    <li class="{{ $activePage === 'home' ? 'mil-active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="{{ $activePage === 'timeline' ? 'mil-active' : '' }}">
                        <a href="{{ route('timeline') }}">Timeline</a>
                    </li>
                    @if ($hasBalonNavbar)
                        <li class="{{ $activePage === 'balon' ? 'mil-active' : '' }}">
                            <a href="{{ route('balon') }}">Balon</a>
                        </li>
                    @endif
                    @if ($hasCalonNavbar)
                        <li class="{{ $activePage === 'calon-rektor' ? 'mil-active' : '' }}">
                            <a href="{{ route('calon-rektor') }}">Calon Rektor</a>
                        </li>
                    @endif
                    <li class="{{ $activePage === 'persyaratan' ? 'mil-active' : '' }}">
                        <a href="{{ route('persyaratan') }}">Persyaratan</a>
                    </li>
                    <li class="{{ $activePage === 'berita' ? 'mil-active' : '' }}">
                        <a href="{{ route('berita') }}">Berita</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="mil-menu-buttons">
            <div class="mil-menu-btn">
                <span></span>
            </div>
        </div>
    </div>
</div>
