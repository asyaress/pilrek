@extends('layouts.admin.app')

@section('title', 'Edit Persyaratan | Pilrek CMS')
@section('page_title', 'Edit Persyaratan Calon Rektor')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $requirement->title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.requirements.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.requirements.update', $requirement) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Label Tab</label>
                            <input type="text" name="label" value="{{ old('label', $requirement->label) }}"
                                class="form-control @error('label') is-invalid @enderror" required>
                            @error('label')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Judul Card</label>
                            <input type="text" name="title" value="{{ old('title', $requirement->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $requirement->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Detail (1 baris = 1 poin)</label>
                            <textarea name="details_input" rows="6" class="form-control @error('details_input') is-invalid @enderror">{{ old('details_input', $detailsInput) }}</textarea>
                            @error('details_input')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Warna Tab</label>
                                <input type="text" name="tab_color"
                                    value="{{ old('tab_color', $requirement->tab_color) }}"
                                    class="form-control @error('tab_color') is-invalid @enderror" required>
                                @error('tab_color')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gradient Awal</label>
                                <input type="text" name="gradient_start"
                                    value="{{ old('gradient_start', $requirement->gradient_start) }}"
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
                                    value="{{ old('gradient_middle', $requirement->gradient_middle) }}"
                                    class="form-control @error('gradient_middle') is-invalid @enderror" required>
                                @error('gradient_middle')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gradient Akhir</label>
                                <input type="text" name="gradient_end"
                                    value="{{ old('gradient_end', $requirement->gradient_end) }}"
                                    class="form-control @error('gradient_end') is-invalid @enderror" required>
                                @error('gradient_end')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="requirement_is_active"
                                class="form-check-input" @checked(old('is_active', $requirement->is_active))>
                            <label class="form-check-label" for="requirement_is_active">Tampilkan di website</label>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.requirements.index') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-info">Update Persyaratan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
