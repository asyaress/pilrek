@extends('layouts.admin.app')

@section('title', 'Kelola Timeline | Pilrek CMS')
@section('page_title', 'Kelola Timeline Pilrek')

@section('content')
    @push('styles')
        <style>
            .pilrek-icon-preview-box {
                border: 1px solid #dfe4ea;
                border-radius: .375rem;
                background: #f8f9fa;
                padding: .75rem;
            }

            .pilrek-icon-preview-box i {
                font-size: 1.5rem;
            }

            .pilrek-icon-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: .5rem;
                margin-top: .5rem;
            }

            .pilrek-icon-btn {
                border: 1px solid #dfe4ea;
                border-radius: .5rem;
                padding: .45rem .35rem;
                background: #fff;
                text-align: center;
                transition: .2s ease;
                cursor: pointer;
            }

            .pilrek-icon-btn i {
                display: block;
                font-size: 1.05rem;
                margin-bottom: .2rem;
            }

            .pilrek-icon-btn span {
                display: block;
                font-size: .7rem;
                line-height: 1.2;
                color: #6c757d;
            }

            .pilrek-icon-btn.is-active {
                border-color: #007bff;
                background: #eaf3ff;
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Tahap Timeline</h3>
                </div>
                <form action="{{ route('admin.timeline.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Label Tanggal</label>
                            <input type="text" name="date_label" value="{{ old('date_label') }}"
                                placeholder="Contoh: Juni 2026"
                                class="form-control @error('date_label') is-invalid @enderror" required>
                            @error('date_label')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Judul Tahap</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                @foreach ($statusOptions as $statusValue => $statusLabel)
                                    <option value="{{ $statusValue }}" @selected(old('status', 'upcoming') === $statusValue)>
                                        {{ $statusLabel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Icon Timeline</label>
                            <select name="icon_class" id="timeline_icon_class"
                                class="form-control @error('icon_class') is-invalid @enderror" data-icon-select required>
                                @foreach ($iconOptions as $iconValue => $iconLabel)
                                    <option value="{{ $iconValue }}" @selected(old('icon_class', 'fa-calendar-alt') === $iconValue)>
                                        {{ $iconLabel }} ({{ $iconValue }})
                                    </option>
                                @endforeach
                            </select>
                            @error('icon_class')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="pilrek-icon-preview-box mt-2" data-icon-preview-for="timeline_icon_class">
                                <div class="small text-muted mb-1">Preview Icon</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt mr-2" data-icon-preview></i>
                                    <code data-icon-preview-label>fa-calendar-alt</code>
                                </div>
                            </div>

                            <div class="pilrek-icon-grid" data-icon-grid-for="timeline_icon_class">
                                @foreach ($iconOptions as $iconValue => $iconLabel)
                                    <button type="button" class="pilrek-icon-btn" data-icon-value="{{ $iconValue }}"
                                        title="{{ $iconLabel }}">
                                        <i class="fas {{ $iconValue }}"></i>
                                        <span>{{ $iconLabel }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                class="form-check-input" @checked(old('is_active', true))>
                            <label class="form-check-label" for="is_active">Tampilkan di website</label>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Tahap</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Daftar Tahap Timeline</h3>
                    <div class="card-tools">
                        <span class="badge badge-light">Total: {{ $timelineStages->total() }}</span>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form action="{{ route('admin.timeline.index') }}" method="get" class="form-row align-items-end">
                        <div class="form-group col-md-5 mb-2">
                            <label class="mb-1">Cari</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                                placeholder="Cari judul, deskripsi, tanggal...">
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label class="mb-1">Status</label>
                            <select name="status" class="form-control">
                                <option value="all" @selected(($filters['status'] ?? 'all') === 'all')>Semua</option>
                                @foreach ($statusOptions as $statusValue => $statusLabel)
                                    <option value="{{ $statusValue }}" @selected(($filters['status'] ?? 'all') === $statusValue)>
                                        {{ $statusLabel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 mb-2">
                            <label class="mb-1">Tampil</label>
                            <select name="active" class="form-control">
                                <option value="all" @selected(($filters['active'] ?? 'all') === 'all')>Semua</option>
                                <option value="1" @selected(($filters['active'] ?? 'all') === '1')>Aktif</option>
                                <option value="0" @selected(($filters['active'] ?? 'all') === '0')>Nonaktif</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 mb-2 text-md-right">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            <a href="{{ route('admin.timeline.index') }}" class="btn btn-light btn-block mt-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 84px;">Urutan</th>
                                    <th style="min-width: 150px;">Tanggal</th>
                                    <th style="min-width: 220px;">Tahap</th>
                                    <th style="width: 120px;">Status</th>
                                    <th style="width: 120px;">Icon</th>
                                    <th style="width: 90px;">Aktif</th>
                                    <th style="width: 210px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($timelineStages as $stage)
                                    @php
                                        $statusBadge = match ($stage->status) {
                                            'done' => 'badge-success',
                                            'ongoing' => 'badge-warning',
                                            default => 'badge-secondary',
                                        };
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2 font-weight-bold">{{ str_pad((string) $stage->stage_order, 2, '0', STR_PAD_LEFT) }}</span>
                                                <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Move order">
                                                    <form action="{{ route('admin.timeline.move', $stage) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="direction" value="up">
                                                        <button type="submit" class="btn btn-light border px-2 py-0" title="Naik">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.timeline.move', $stage) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="direction" value="down">
                                                        <button type="submit" class="btn btn-light border px-2 py-0" title="Turun">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $stage->date_label }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ $stage->title }}</div>
                                            <div class="text-muted text-sm">{{ \Illuminate\Support\Str::limit($stage->description, 90) }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusBadge }}">{{ $statusOptions[$stage->status] ?? ucfirst($stage->status) }}</span>
                                        </td>
                                        <td>
                                            <i class="fas {{ $stage->icon_class ?? 'fa-calendar-alt' }} mr-1"></i>
                                            <span class="text-muted text-sm">{{ $stage->icon_class ?? 'fa-calendar-alt' }}</span>
                                        </td>
                                        <td>
                                            @if ($stage->is_active)
                                                <span class="badge badge-primary">Ya</span>
                                            @else
                                                <span class="badge badge-dark">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.timeline.edit', $stage) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.timeline.destroy', $stage) }}" method="post"
                                                class="d-inline" onsubmit="return confirm('Hapus tahap ini?')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Belum ada data timeline.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($timelineStages->hasPages())
                    <div class="card-footer">
                        {{ $timelineStages->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            (function() {
                var select = document.getElementById('timeline_icon_class');
                if (!select) return;

                var previewBox = document.querySelector('[data-icon-preview-for="timeline_icon_class"]');
                var previewIcon = previewBox ? previewBox.querySelector('[data-icon-preview]') : null;
                var previewLabel = previewBox ? previewBox.querySelector('[data-icon-preview-label]') : null;
                var iconButtons = Array.prototype.slice.call(document.querySelectorAll(
                    '[data-icon-grid-for="timeline_icon_class"] [data-icon-value]'
                ));

                function syncIconUI() {
                    var value = select.value || 'fa-calendar-alt';
                    if (previewIcon) {
                        previewIcon.className = 'fas ' + value + ' mr-2';
                    }
                    if (previewLabel) {
                        previewLabel.textContent = value;
                    }
                    iconButtons.forEach(function(btn) {
                        btn.classList.toggle('is-active', btn.getAttribute('data-icon-value') === value);
                    });
                }

                iconButtons.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var value = btn.getAttribute('data-icon-value');
                        if (!value) return;
                        select.value = value;
                        syncIconUI();
                    });
                });

                select.addEventListener('change', syncIconUI);
                syncIconUI();
            })();
        </script>
    @endpush
@endsection
