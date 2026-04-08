@php
    $activePage = $activePage ?? '';
    $navbarInstitutionLogos = collect($institutionLogos ?? [])
        ->filter(static fn (array $item): bool => ($item['is_active'] ?? true) && !empty($item['path']))
        ->sortBy('logo_order')
        ->values();
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
                padding-right: 2px;
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

            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:hover,
            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:focus,
            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:focus-visible,
            .pilrek-top-panel-inline-logos .mil-top-menu ul li > a:active,
            .pilrek-top-panel-inline-logos .mil-top-menu ul li.mil-active > a {
                color: #ffc107 !important;
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
                gap: 0;
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
                    <li class="{{ $activePage === 'calon-rektor' ? 'mil-active' : '' }}">
                        <a href="{{ route('calon-rektor') }}">Calon Rektor</a>
                    </li>
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
