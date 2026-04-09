@extends('layouts.admin.app')

@section('title', 'Kelola Balon & Calon | Pilrek CMS')
@section('page_title', 'Kelola Kandidat Rektor (Balon -> Calon)')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Kandidat Rektor</h3>
                </div>
                <form action="{{ route('admin.candidates.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body" style="max-height: 72vh; overflow: auto;">
                        <div class="form-group">
                            <label>Status Kandidat (Tahap Saat Ini)</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                @foreach ($statusOptions as $statusValue => $statusLabel)
                                    <option value="{{ $statusValue }}" @selected(old('status', \App\Models\RectorCandidate::STATUS_BALON) === $statusValue)>{{ $statusLabel }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ringkasan Jabatan (untuk kartu)</label>
                            <input type="text" name="role_summary" value="{{ old('role_summary') }}"
                                class="form-control @error('role_summary') is-invalid @enderror"
                                placeholder="Contoh: Guru Besar / Dekan Fakultas Teknik">
                            @error('role_summary')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Fakultas / Unit</label>
                                <input type="text" name="faculty_unit" value="{{ old('faculty_unit') }}"
                                    class="form-control @error('faculty_unit') is-invalid @enderror">
                                @error('faculty_unit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Program Studi</label>
                                <input type="text" name="study_program" value="{{ old('study_program') }}"
                                    class="form-control @error('study_program') is-invalid @enderror">
                                @error('study_program')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jabatan Akademik</label>
                                <input type="text" name="academic_position" value="{{ old('academic_position') }}"
                                    class="form-control @error('academic_position') is-invalid @enderror">
                                @error('academic_position')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jabatan Saat Ini</label>
                                <input type="text" name="current_position" value="{{ old('current_position') }}"
                                    class="form-control @error('current_position') is-invalid @enderror">
                                @error('current_position')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Pendidikan Terakhir</label>
                                <input type="text" name="latest_education" value="{{ old('latest_education') }}"
                                    class="form-control @error('latest_education') is-invalid @enderror">
                                @error('latest_education')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>NIP</label>
                                <input type="text" name="nip" value="{{ old('nip') }}"
                                    class="form-control @error('nip') is-invalid @enderror">
                                @error('nip')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tempat Lahir</label>
                                <input type="text" name="birth_place" value="{{ old('birth_place') }}"
                                    class="form-control @error('birth_place') is-invalid @enderror">
                                @error('birth_place')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                    class="form-control @error('birth_date') is-invalid @enderror">
                                @error('birth_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
                            @error('photo')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Profil Singkat</label>
                            <textarea name="short_profile" rows="3" class="form-control @error('short_profile') is-invalid @enderror">{{ old('short_profile') }}</textarea>
                            @error('short_profile')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Visi</label>
                            <textarea name="vision" rows="3" class="form-control @error('vision') is-invalid @enderror">{{ old('vision') }}</textarea>
                            @error('vision')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Misi (1 baris = 1 misi, format: Judul | Deskripsi)</label>
                            <textarea name="missions_input" rows="5" class="form-control @error('missions_input') is-invalid @enderror" placeholder="Penguatan Mutu Akademik | Meningkatkan kualitas pembelajaran ...">{{ old('missions_input') }}</textarea>
                            @error('missions_input')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="candidate_is_active"
                                class="form-check-input" @checked(old('is_active', true))>
                            <label class="form-check-label" for="candidate_is_active">Tampilkan di website</label>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Kandidat</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Daftar Kandidat Rektor</h3>
                    <div class="card-tools">
                        <span class="badge badge-light">Total: {{ $candidates->total() }}</span>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form action="{{ route('admin.candidates.index') }}" method="get" class="form-row align-items-end">
                        <div class="form-group col-md-8 mb-2">
                            <label class="mb-1">Cari</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                                placeholder="Cari nama, ringkasan jabatan, fakultas, prodi...">
                        </div>
                        <div class="form-group col-md-2 mb-2">
                            <label class="mb-1">Tampil</label>
                            <select name="active" class="form-control">
                                <option value="all" @selected(($filters['active'] ?? 'all') === 'all')>Semua</option>
                                <option value="1" @selected(($filters['active'] ?? 'all') === '1')>Aktif</option>
                                <option value="0" @selected(($filters['active'] ?? 'all') === '0')>Nonaktif</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 mb-2">
                            <label class="mb-1">Status</label>
                            <select name="status" class="form-control">
                                <option value="all" @selected(($filters['status'] ?? 'all') === 'all')>Semua</option>
                                @foreach ($statusOptions as $statusValue => $statusLabel)
                                    <option value="{{ $statusValue }}" @selected(($filters['status'] ?? 'all') === $statusValue)>{{ $statusLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12 mb-2 text-md-right">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-light btn-block mt-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 84px;">Urutan</th>
                                    <th>Nama</th>
                                    <th style="width: 100px;">Status</th>
                                    <th style="min-width: 180px;">Unit</th>
                                    <th style="width: 80px;">Aktif</th>
                                    <th style="width: 190px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($candidates as $candidate)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2 font-weight-bold">{{ str_pad((string) $candidate->candidate_order, 2, '0', STR_PAD_LEFT) }}</span>
                                                <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Move order">
                                                    <form action="{{ route('admin.candidates.move', $candidate) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="direction" value="up">
                                                        <button type="submit" class="btn btn-light border px-2 py-0" title="Naik">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.candidates.move', $candidate) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="direction" value="down">
                                                        <button type="submit" class="btn btn-light border px-2 py-0" title="Turun">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $candidate->name }}</div>
                                            <div class="text-muted text-sm">{{ $candidate->role_summary ?: '-' }}</div>
                                        </td>
                                        <td>
                                            @php
                                                $candidateStatus = $candidate->status ?: \App\Models\RectorCandidate::STATUS_CALON;
                                            @endphp
                                            <span class="badge badge-{{ $candidateStatus === \App\Models\RectorCandidate::STATUS_BALON ? 'warning' : 'success' }}">
                                                {{ $statusOptions[$candidateStatus] ?? ucfirst($candidateStatus) }}
                                            </span>
                                        </td>
                                        <td>{{ $candidate->faculty_unit ?: '-' }}</td>
                                        <td>
                                            @if ($candidate->is_active)
                                                <span class="badge badge-primary">Ya</span>
                                            @else
                                                <span class="badge badge-dark">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.candidates.edit', $candidate) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            @if (($candidate->status ?? \App\Models\RectorCandidate::STATUS_BALON) === \App\Models\RectorCandidate::STATUS_BALON)
                                                <form action="{{ route('admin.candidates.promote', $candidate) }}" method="post"
                                                    class="d-inline" onsubmit="return confirm('Angkat kandidat ini menjadi Calon?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-arrow-up"></i> Angkat Calon
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.candidates.demote', $candidate) }}" method="post"
                                                    class="d-inline" onsubmit="return confirm('Ubah kandidat ini kembali ke Balon?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-arrow-down"></i> Set Balon
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="post"
                                                class="d-inline" onsubmit="return confirm('Hapus kandidat ini?')">
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
                                        <td colspan="6" class="text-center text-muted py-4">Belum ada data kandidat rektor.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($candidates->hasPages())
                    <div class="card-footer">
                        {{ $candidates->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

