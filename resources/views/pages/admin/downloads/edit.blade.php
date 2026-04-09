@extends('layouts.admin.app')

@section('title', 'Edit Dokumen Unduhan | Pilrek CMS')
@section('page_title', 'Edit Dokumen Unduhan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $document->title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.downloads.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.downloads.update', $document) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Dokumen</label>
                            <input type="text" name="title" value="{{ old('title', $document->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Singkat</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $document->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>File Dokumen (PDF/DOC/DOCX)</label>
                            <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror"
                                accept=".pdf,.doc,.docx">
                            <small class="text-muted">Kosongkan jika tidak mengganti file.</small>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($document->file_path)
                            <div class="form-group">
                                <label>File Saat Ini</label>
                                <div class="border rounded p-2 bg-light">
                                    <a href="{{ asset($document->file_path) }}" target="_blank" rel="noopener">
                                        {{ $document->file_name ?: basename($document->file_path) }}
                                    </a>
                                    <div class="small text-muted mt-1">
                                        {{ strtoupper((string) $document->file_extension) }} -
                                        {{ $document->file_size_kb ? number_format($document->file_size_kb, 0, ',', '.') . ' KB' : '-' }}
                                    </div>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" name="remove_file" value="1" id="remove_file"
                                        class="form-check-input" @checked(old('remove_file'))>
                                    <label class="form-check-label" for="remove_file">Hapus file saat ini</label>
                                </div>
                            </div>
                        @endif

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="download_is_active"
                                class="form-check-input" @checked(old('is_active', $document->is_active))>
                            <label class="form-check-label" for="download_is_active">Tampilkan di website</label>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.downloads.index') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-info">Update Dokumen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

