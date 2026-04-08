@php
    $siteName = $siteSettings?->site_name ?? 'Portal Pilrek Unmul';
    $siteTagline = $siteSettings?->site_tagline ?? 'Pemilihan Rektor 2026-2030';
    $contactEmail = $siteSettings?->contact_email ?? 'pilrek2026@universitas.ac.id';
    $contactPhone = $siteSettings?->contact_phone;
    $contactAddress = $siteSettings?->contact_address ?? 'Gedung Rektorat Lt. 2, Universitas Mulawarman';
    $footerNote = $siteSettings?->footer_note ?? 'Portal resmi informasi Pemilihan Rektor Universitas Mulawarman.';
    $footerCopyright = $siteSettings?->footer_copyright ?? 'Portal Pemilihan Rektor Universitas Mulawarman';
    $footerInstitutionLogos = collect($institutionLogos ?? [])
        ->filter(static fn (array $item): bool => ($item['is_active'] ?? true) && !empty($item['path']))
        ->sortBy('logo_order')
        ->values();
@endphp

@once
    <style>
        .pilrek-footer-logo-strip {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .pilrek-footer-logo-item {
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }

        .pilrek-footer-logo-item.pilrek-footer-logo-square {
            width: 56px;
        }

        .pilrek-footer-logo-item.pilrek-footer-logo-dies {
            width: 46px;
        }

        .pilrek-footer-logo-item.pilrek-footer-logo-dikti {
            width: 150px;
        }

        .pilrek-footer-logo-item.pilrek-footer-logo-unggul {
            width: 126px;
        }

        .pilrek-footer-logo-item img {
            max-width: 100%;
            max-height: 56px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }

        @media (max-width: 767px) {
            .pilrek-footer-logo-strip {
                justify-content: flex-start;
                gap: 20px;
            }

            .pilrek-footer-logo-item {
                height: 44px;
            }

            .pilrek-footer-logo-item.pilrek-footer-logo-square {
                width: 42px;
            }

            .pilrek-footer-logo-item.pilrek-footer-logo-dies {
                width: 34px;
            }

            .pilrek-footer-logo-item.pilrek-footer-logo-dikti {
                width: 106px;
            }

            .pilrek-footer-logo-item.pilrek-footer-logo-unggul {
                width: 90px;
            }

            .pilrek-footer-logo-item img {
                max-height: 44px;
            }
        }
    </style>
@endonce

<footer class="mil-footer-with-bg mil-p-160-0">
    <div class="container">
        <div class="row">
            <div class="col-12 mil-mb-60">
                <div class="pilrek-footer-logo-strip">
                    @foreach ($footerInstitutionLogos as $logoIndex => $logo)
                        @php
                            $logoPath = strtolower((string) ($logo['path'] ?? ''));
                            $logoSizeClass = 'pilrek-footer-logo-square';
                            if (str_contains($logoPath, 'dies-natalis')) {
                                $logoSizeClass = 'pilrek-footer-logo-dies';
                            } elseif (str_contains($logoPath, 'diktisaintek')) {
                                $logoSizeClass = 'pilrek-footer-logo-dikti';
                            } elseif (str_contains($logoPath, 'logo-unggul')) {
                                $logoSizeClass = 'pilrek-footer-logo-unggul';
                            }
                        @endphp
                        <div class="pilrek-footer-logo-item {{ $logoSizeClass }}">
                            <img src="{{ asset($logo['path']) }}" alt="{{ $logo['name'] ?: ('Logo Institusi ' . ($logoIndex + 1)) }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-4 mil-mb-60">
                <h6 class="mil-mb-60">Navigasi</h6>
                <ul class="mil-footer-list">
                    <li class="mil-text-m mil-soft mil-mb-15">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="mil-text-m mil-soft mil-mb-15">
                        <a href="{{ route('timeline') }}">Timeline</a>
                    </li>
                    <li class="mil-text-m mil-soft mil-mb-15">
                        <a href="{{ route('calon-rektor') }}">Calon Rektor</a>
                    </li>
                    <li class="mil-text-m mil-soft mil-mb-15">
                        <a href="{{ route('persyaratan') }}">Persyaratan</a>
                    </li>
                    <li class="mil-text-m mil-soft mil-mb-15">
                        <a href="{{ route('berita') }}">Berita</a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-4 mil-mb-60">
                <h6 class="mil-mb-60">Informasi</h6>
                <ul class="mil-footer-list">
                    <li class="mil-text-m mil-soft mil-mb-15">
                        {{ $siteTagline }}
                    </li>
                    <li class="mil-text-m mil-soft mil-mb-15">
                        {{ $contactAddress }}
                    </li>
                    @if ($contactPhone)
                        <li class="mil-text-m mil-soft mil-mb-15">
                            {{ $contactPhone }}
                        </li>
                    @endif
                    <li class="mil-text-m mil-soft mil-mb-15">
                        {{ $contactEmail }}
                    </li>
                </ul>
            </div>
            <div class="col-xl-4 mil-mb-80">
                <h6 class="mil-mb-60">Catatan</h6>
                <p class="mil-text-xs mil-soft mil-mb-15">
                    {{ $footerNote }}
                </p>
            </div>
        </div>
        <div class="mil-footer-bottom">
            <div class="row">
                <div class="col-xl-6">
                    <p class="mil-text-s mil-soft">&copy; {{ date('Y') }} {{ $footerCopyright }}</p>
                </div>
                <div class="col-xl-6">
                    <p class="mil-text-s mil-text-right mil-sm-text-left mil-soft">
                        {{ $siteName }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
