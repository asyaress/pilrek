@extends('layouts.admin.app')

@section('title', 'Kelola Unduhan | Pilrek CMS')
@section('page_title', 'Kelola Dokumen Unduhan')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Dokumen</h3>
                </div>
                <form action="{{ route('admin.downloads.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body" style="max-height: 72vh; overflow: auto;">
                        <div class="form-group">
                            <label>Judul Dokumen</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Contoh: Jadwal Tahapan Pilrek Unmul 2026-2030" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Singkat</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Keterangan singkat dokumen (opsional)">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>File Dokumen (PDF/DOC/DOCX)</label>
                            <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror"
                                accept=".pdf,.doc,.docx" required>
                            <small class="text-muted">Maksimal 10 MB.</small>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="download_is_active"
                                class="form-check-input" @checked(old('is_active', true))>
                            <label class="form-check-label" for="download_is_active">Tampilkan di website</label>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Daftar Dokumen Unduhan</h3>
                    <div class="card-tools">
                        <span class="badge badge-light">Total: {{ $documents->total() }}</span>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form action="{{ route('admin.downloads.index') }}" method="get" class="form-row align-items-end">
                        <div class="form-group col-md-8 mb-2">
                            <label class="mb-1">Cari</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                                placeholder="Cari judul, deskripsi, nama file...">
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
                            <a href="{{ route('admin.downloads.index') }}" class="btn btn-light btn-block mt-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 84px;">Urutan</th>
                                    <th style="min-width: 220px;">Dokumen</th>
                                    <th style="width: 110px;">Tipe</th>
                                    <th style="width: 120px;">Ukuran</th>
                                    <th style="width: 80px;">Aktif</th>
                                    <th style="width: 190px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documents as $document)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="mr-2 font-weight-bold">{{ str_pad((string) $document->document_order, 2, '0', STR_PAD_LEFT) }}</span>
                                                <div class="btn-group-vertical btn-group-sm" role="group"
                                                    aria-label="Move order">
                                                    <form action="{{ route('admin.downloads.move', $document) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="direction" value="up">
                                                        <button type="submit" class="btn btn-light border px-2 py-0"
                                                            title="Naik">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.downloads.move', $document) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="direction" value="down">
                                                        <button type="submit" class="btn btn-light border px-2 py-0"
                                                            title="Turun">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $document->title }}</div>
                                            <div class="text-muted text-sm">
                                                {{ \Illuminate\Support\Str::limit($document->description, 90) }}
                                            </div>
                                            @if ($document->file_path)
                                                <div class="text-xs mt-1">
                                                    <a href="{{ asset($document->file_path) }}" target="_blank"
                                                        rel="noopener">{{ $document->file_name ?: 'Lihat file' }}</a>
                                                </div>
                                            @else
                                                <div class="text-xs text-warning mt-1">File belum diunggah</div>
                                            @endif
                                        </td>
                                        <td>{{ strtoupper((string) ($document->file_extension ?: '-')) }}</td>
                                        <td>{{ $document->file_size_kb ? number_format($document->file_size_kb, 0, ',', '.') . ' KB' : '-' }}
                                        </td>
                                        <td>
                                            @if ($document->is_active)
                                                <span class="badge badge-primary">Ya</span>
                                            @else
                                                <span class="badge badge-dark">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.downloads.edit', $document) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.downloads.destroy', $document) }}"
                                                method="post" class="d-inline"
                                                onsubmit="return confirm('Hapus dokumen ini?')">
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
                                        <td colspan="6" class="text-center text-muted py-4">Belum ada dokumen
                                            unduhan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($documents->hasPages())
                    <div class="card-footer">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

