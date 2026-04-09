@extends('layouts.admin.app')

@section('title', 'Pengaturan Situs | Pilrek CMS')
@section('page_title', 'Pengaturan Situs')

@section('content')
    @php
        $institutionLogos = old('institution_logos', $settings->institution_logos ?? \App\Models\SiteSetting::defaultInstitutionLogos());
        $institutionLogos = is_array($institutionLogos) && !empty($institutionLogos) ? array_values($institutionLogos) : \App\Models\SiteSetting::defaultInstitutionLogos();
        $calonOptions = $calonOptions ?? [];
    @endphp
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Konfigurasi Global Website</h3>
        </div>
        <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Situs</label>
                            <input type="text" name="site_name" value="{{ old('site_name', $settings->site_name) }}"
                                class="form-control @error('site_name') is-invalid @enderror" required>
                            @error('site_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tagline</label>
                            <input type="text" name="site_tagline"
                                value="{{ old('site_tagline', $settings->site_tagline) }}"
                                class="form-control @error('site_tagline') is-invalid @enderror">
                            @error('site_tagline')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rektor Terpilih (Home)</label>
                            <select name="selected_rector_candidate_id"
                                class="form-control @error('selected_rector_candidate_id') is-invalid @enderror">
                                <option value="">-- Belum dipilih --</option>
                                @foreach ($calonOptions as $candidateId => $candidateName)
                                    <option value="{{ $candidateId }}"
                                        @selected((string) old('selected_rector_candidate_id', $settings->selected_rector_candidate_id) === (string) $candidateId)>
                                        {{ $candidateName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('selected_rector_candidate_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">
                                Ambil langsung dari data kandidat berstatus Calon. Jika kosong, section rektor terpilih tidak tampil di Home.
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="mb-3">
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-user-tie mr-1"></i>Buka Kelola Balon & Calon
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control-file @error('logo') is-invalid @enderror">
                            @if ($settings->logo_path)
                                <div class="mt-2">
                                    <img src="{{ asset($settings->logo_path) }}" alt="Logo" style="height: 56px;">
                                </div>
                            @endif
                            @error('logo')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Favicon</label>
                            <input type="file" name="favicon"
                                class="form-control-file @error('favicon') is-invalid @enderror">
                            @if ($settings->favicon_path)
                                <div class="mt-2">
                                    <img src="{{ asset($settings->favicon_path) }}" alt="Favicon" style="height: 32px;">
                                </div>
                            @endif
                            @error('favicon')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Logo Institusi (Dinamis)</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addInstitutionLogoRow">
                        <i class="fas fa-plus"></i> Tambah Slot
                    </button>
                </div>
                <p class="text-muted text-sm mb-3">
                    Urutan default: <code>tut-wuri</code> - <code>unmul</code> - <code>blu</code> = <code>dies-natalis</code> -
                    <code>diktisaintek</code> - <code>logo-unggul</code>.
                </p>
                <div id="institutionLogoRows">
                    @foreach ($institutionLogos as $index => $logo)
                        @php
                            $logoPath = $logo['path'] ?? ($logo['existing_path'] ?? null);
                            $logoUrl = $logoPath ? asset($logoPath) : null;
                        @endphp
                        <div class="border rounded p-3 mb-3 institution-logo-row">
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-1">
                                    <label>Urut</label>
                                    <input type="number" min="1"
                                        name="institution_logos[{{ $index }}][logo_order]"
                                        value="{{ old("institution_logos.$index.logo_order", $logo['logo_order'] ?? ($index + 1)) }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Nama Logo</label>
                                    <input type="text" name="institution_logos[{{ $index }}][name]"
                                        value="{{ old("institution_logos.$index.name", $logo['name'] ?? '') }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Upload Logo</label>
                                    <input type="file" name="institution_logos[{{ $index }}][file]"
                                        class="form-control-file @error("institution_logos.$index.file") is-invalid @enderror">
                                    @error("institution_logos.$index.file")
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="form-check mt-4">
                                        <input type="hidden" name="institution_logos[{{ $index }}][is_active]"
                                            value="0">
                                        <input class="form-check-input" type="checkbox"
                                            name="institution_logos[{{ $index }}][is_active]" value="1"
                                            id="institution_logo_active_{{ $index }}"
                                            @checked((string) old("institution_logos.$index.is_active", (int) ($logo['is_active'] ?? 1)) === '1')>
                                        <label class="form-check-label" for="institution_logo_active_{{ $index }}">Aktif</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-1">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox"
                                            name="institution_logos[{{ $index }}][remove]" value="1"
                                            id="institution_logo_remove_{{ $index }}">
                                        <label class="form-check-label text-danger"
                                            for="institution_logo_remove_{{ $index }}">Hapus</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 text-md-right">
                                    @if ($logoUrl)
                                        <img src="{{ $logoUrl }}" alt="{{ $logo['name'] ?? 'Logo' }}"
                                            style="max-height: 46px; max-width: 100%; object-fit: contain;">
                                    @else
                                        <span class="text-muted text-sm">Belum ada logo</span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="institution_logos[{{ $index }}][existing_path]"
                                value="{{ old("institution_logos.$index.existing_path", $logoPath) }}">
                        </div>
                    @endforeach
                </div>
                @error('institution_logos')
                    <div class="text-danger text-sm mb-3">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label>Catatan Footer</label>
                    <textarea name="footer_note" rows="3" class="form-control @error('footer_note') is-invalid @enderror">{{ old('footer_note', $settings->footer_note) }}</textarea>
                    @error('footer_note')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Copyright Footer</label>
                    <input type="text" name="footer_copyright"
                        value="{{ old('footer_copyright', $settings->footer_copyright) }}"
                        class="form-control @error('footer_copyright') is-invalid @enderror">
                    @error('footer_copyright')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email Kontak</label>
                            <input type="email" name="contact_email"
                                value="{{ old('contact_email', $settings->contact_email) }}"
                                class="form-control @error('contact_email') is-invalid @enderror">
                            @error('contact_email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Telepon Kontak</label>
                            <input type="text" name="contact_phone"
                                value="{{ old('contact_phone', $settings->contact_phone) }}"
                                class="form-control @error('contact_phone') is-invalid @enderror">
                            @error('contact_phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Alamat Kontak</label>
                            <input type="text" name="contact_address"
                                value="{{ old('contact_address', $settings->contact_address) }}"
                                class="form-control @error('contact_address') is-invalid @enderror">
                            @error('contact_address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Instagram URL</label>
                            <input type="url" name="instagram_url"
                                value="{{ old('instagram_url', $settings->instagram_url) }}"
                                class="form-control @error('instagram_url') is-invalid @enderror">
                            @error('instagram_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Facebook URL</label>
                            <input type="url" name="facebook_url"
                                value="{{ old('facebook_url', $settings->facebook_url) }}"
                                class="form-control @error('facebook_url') is-invalid @enderror">
                            @error('facebook_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>YouTube URL</label>
                            <input type="url" name="youtube_url"
                                value="{{ old('youtube_url', $settings->youtube_url) }}"
                                class="form-control @error('youtube_url') is-invalid @enderror">
                            @error('youtube_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>X / Twitter URL</label>
                            <input type="url" name="x_url" value="{{ old('x_url', $settings->x_url) }}"
                                class="form-control @error('x_url') is-invalid @enderror">
                            @error('x_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </div>
        </form>
    </div>

    <template id="institutionLogoRowTemplate">
        <div class="border rounded p-3 mb-3 institution-logo-row">
                <div class="form-row align-items-end">
                <div class="form-group col-md-1">
                    <label>Urut</label>
                    <input type="number" min="1" name="institution_logos[__INDEX__][logo_order]"
                        value="__ORDER__" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Nama Logo</label>
                    <input type="text" name="institution_logos[__INDEX__][name]" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Upload Logo</label>
                    <input type="file" name="institution_logos[__INDEX__][file]" class="form-control-file">
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check mt-4">
                        <input type="hidden" name="institution_logos[__INDEX__][is_active]" value="0">
                        <input class="form-check-input" type="checkbox" name="institution_logos[__INDEX__][is_active]"
                            value="1" id="institution_logo_active___INDEX__" checked>
                        <label class="form-check-label" for="institution_logo_active___INDEX__">Aktif</label>
                    </div>
                </div>
                <div class="form-group col-md-1">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="institution_logos[__INDEX__][remove]"
                            value="1" id="institution_logo_remove___INDEX__">
                        <label class="form-check-label text-danger" for="institution_logo_remove___INDEX__">Hapus</label>
                    </div>
                </div>
                <div class="form-group col-md-2 text-md-right">
                    <span class="text-muted text-sm">Logo baru</span>
                </div>
            </div>
            <input type="hidden" name="institution_logos[__INDEX__][existing_path]" value="">
        </div>
    </template>

    <script>
        (function() {
            var addButton = document.getElementById('addInstitutionLogoRow');
            var rowsHost = document.getElementById('institutionLogoRows');
            var templateEl = document.getElementById('institutionLogoRowTemplate');

            if (!addButton || !rowsHost || !templateEl) {
                return;
            }

            function nextIndex() {
                return rowsHost.querySelectorAll('.institution-logo-row').length;
            }

            addButton.addEventListener('click', function() {
                var index = nextIndex();
                var html = templateEl.innerHTML
                    .replace(/__INDEX__/g, String(index))
                    .replace(/__ORDER__/g, String(index + 1));
                var wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                rowsHost.appendChild(wrapper.firstChild);
            });
        })();
    </script>
@endsection
