@extends('layouts.admin.app')

@section('title', 'Kelola Persyaratan | Pilrek CMS')
@section('page_title', 'Kelola Persyaratan Calon Rektor')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Persyaratan</h3>
                </div>
                <form action="{{ route('admin.requirements.store') }}" method="post">
                    @csrf
                    <div class="card-body" style="max-height: 72vh; overflow: auto;">
                        <div class="form-group">
                            <label>Label Tab</label>
                            <input type="text" name="label" value="{{ old('label') }}"
                                class="form-control @error('label') is-invalid @enderror"
                                placeholder="Contoh: Kartu Identitas" required>
                            @error('label')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Judul Card</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Contoh: Persyaratan 1 - Kartu Identitas" required>
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
                            <label>Detail (1 baris = 1 poin)</label>
                            <textarea name="details_input" rows="5" class="form-control @error('details_input') is-invalid @enderror"
                                placeholder="Unggah dokumen A&#10;Pastikan data B&#10;Periksa ulang C">{{ old('details_input') }}</textarea>
                            @error('details_input')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Warna Tab</label>
                                <input type="text" name="tab_color" value="{{ old('tab_color', '#36b6a5') }}"
                                    class="form-control @error('tab_color') is-invalid @enderror" required>
                                @error('tab_color')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gradient Awal</label>
                                <input type="text" name="gradient_start" value="{{ old('gradient_start', '#299a8d') }}"
                                    class="form-control @error('gradient_start') is-invalid @enderror" required>
                                @error('gradient_start')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Gradient Tengah</label>
                                <input type="text" name="gradient_middle"
                                    value="{{ old('gradient_middle', '#36b6a5') }}"
                                    class="form-control @error('gradient_middle') is-invalid @enderror" required>
                                @error('gradient_middle')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gradient Akhir</label>
                                <input type="text" name="gradient_end" value="{{ old('gradient_end', '#268d83') }}"
                                    class="form-control @error('gradient_end') is-invalid @enderror" required>
                                @error('gradient_end')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="requirement_is_active"
                                class="form-check-input" @checked(old('is_active', true))>
                            <label class="form-check-label" for="requirement_is_active">Tampilkan di website</label>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Persyaratan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Daftar Persyaratan</h3>
                    <div class="card-tools">
                        <span class="badge badge-light">Total: {{ $requirements->total() }}</span>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form action="{{ route('admin.requirements.index') }}" method="get" class="form-row align-items-end">
                        <div class="form-group col-md-8 mb-2">
                            <label class="mb-1">Cari</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                                placeholder="Cari label, judul, deskripsi...">
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
                            <a href="{{ route('admin.requirements.index') }}"
                                class="btn btn-light btn-block mt-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 84px;">Urutan</th>
                                    <th style="min-width: 160px;">Label</th>
                                    <th style="min-width: 220px;">Judul</th>
                                    <th style="width: 120px;">Warna</th>
                                    <th style="width: 80px;">Aktif</th>
                                    <th style="width: 190px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($requirements as $requirement)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="mr-2 font-weight-bold">{{ str_pad((string) $requirement->requirement_order, 2, '0', STR_PAD_LEFT) }}</span>
                                                <div class="btn-group-vertical btn-group-sm" role="group"
                                                    aria-label="Move order">
                                                    <form action="{{ route('admin.requirements.move', $requirement) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="direction" value="up">
                                                        <button type="submit" class="btn btn-light border px-2 py-0"
                                                            title="Naik">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.requirements.move', $requirement) }}"
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
                                        <td>{{ $requirement->label }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ $requirement->title }}</div>
                                            <div class="text-muted text-sm">
                                                {{ \Illuminate\Support\Str::limit($requirement->description, 78) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="d-inline-block rounded-circle mr-1"
                                                    style="width: 18px;height: 18px;background: {{ $requirement->tab_color }};"></span>
                                                <span class="d-inline-block rounded-circle mr-1"
                                                    style="width: 18px;height: 18px;background: {{ $requirement->gradient_start }};"></span>
                                                <span class="d-inline-block rounded-circle mr-1"
                                                    style="width: 18px;height: 18px;background: {{ $requirement->gradient_middle }};"></span>
                                                <span class="d-inline-block rounded-circle"
                                                    style="width: 18px;height: 18px;background: {{ $requirement->gradient_end }};"></span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($requirement->is_active)
                                                <span class="badge badge-primary">Ya</span>
                                            @else
                                                <span class="badge badge-dark">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.requirements.edit', $requirement) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.requirements.destroy', $requirement) }}"
                                                method="post" class="d-inline"
                                                onsubmit="return confirm('Hapus persyaratan ini?')">
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
                                        <td colspan="6" class="text-center text-muted py-4">Belum ada data
                                            persyaratan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($requirements->hasPages())
                    <div class="card-footer">
                        {{ $requirements->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
