@extends('layouts.admin.app')

@section('title', 'Edit Calon Rektor | Pilrek CMS')
@section('page_title', 'Edit Calon Rektor')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $candidate->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.candidates.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.candidates.update', $candidate) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $candidate->name) }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ringkasan Jabatan (untuk kartu)</label>
                            <input type="text" name="role_summary"
                                value="{{ old('role_summary', $candidate->role_summary) }}"
                                class="form-control @error('role_summary') is-invalid @enderror">
                            @error('role_summary')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Fakultas / Unit</label>
                                <input type="text" name="faculty_unit"
                                    value="{{ old('faculty_unit', $candidate->faculty_unit) }}"
                                    class="form-control @error('faculty_unit') is-invalid @enderror">
                                @error('faculty_unit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Program Studi</label>
                                <input type="text" name="study_program"
                                    value="{{ old('study_program', $candidate->study_program) }}"
                                    class="form-control @error('study_program') is-invalid @enderror">
                                @error('study_program')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jabatan Akademik</label>
                                <input type="text" name="academic_position"
                                    value="{{ old('academic_position', $candidate->academic_position) }}"
                                    class="form-control @error('academic_position') is-invalid @enderror">
                                @error('academic_position')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jabatan Saat Ini</label>
                                <input type="text" name="current_position"
                                    value="{{ old('current_position', $candidate->current_position) }}"
                                    class="form-control @error('current_position') is-invalid @enderror">
                                @error('current_position')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Pendidikan Terakhir</label>
                                <input type="text" name="latest_education"
                                    value="{{ old('latest_education', $candidate->latest_education) }}"
                                    class="form-control @error('latest_education') is-invalid @enderror">
                                @error('latest_education')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>NIP</label>
                                <input type="text" name="nip" value="{{ old('nip', $candidate->nip) }}"
                                    class="form-control @error('nip') is-invalid @enderror">
                                @error('nip')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tempat Lahir</label>
                                <input type="text" name="birth_place"
                                    value="{{ old('birth_place', $candidate->birth_place) }}"
                                    class="form-control @error('birth_place') is-invalid @enderror">
                                @error('birth_place')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="birth_date"
                                    value="{{ old('birth_date', optional($candidate->birth_date)->format('Y-m-d')) }}"
                                    class="form-control @error('birth_date') is-invalid @enderror">
                                @error('birth_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
                            @if ($candidate->photo_path)
                                <div class="mt-2">
                                    <img src="{{ asset($candidate->photo_path) }}" alt="{{ $candidate->name }}" style="height: 72px; border-radius: 8px;">
                                </div>
                            @endif
                            @error('photo')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Profil Singkat</label>
                            <textarea name="short_profile" rows="3" class="form-control @error('short_profile') is-invalid @enderror">{{ old('short_profile', $candidate->short_profile) }}</textarea>
                            @error('short_profile')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Visi</label>
                            <textarea name="vision" rows="3" class="form-control @error('vision') is-invalid @enderror">{{ old('vision', $candidate->vision) }}</textarea>
                            @error('vision')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Misi (1 baris = 1 misi, format: Judul | Deskripsi)</label>
                            <textarea name="missions_input" rows="6" class="form-control @error('missions_input') is-invalid @enderror">{{ old('missions_input', $missionsInput) }}</textarea>
                            @error('missions_input')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="candidate_is_active"
                                class="form-check-input" @checked(old('is_active', $candidate->is_active))>
                            <label class="form-check-label" for="candidate_is_active">Tampilkan di website</label>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.candidates.index') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-info">Update Calon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
