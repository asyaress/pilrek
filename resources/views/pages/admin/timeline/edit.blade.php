@extends('layouts.admin.app')

@section('title', 'Edit Timeline | Pilrek CMS')
@section('page_title', 'Edit Tahap Timeline')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $timelineStage->title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.timeline.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.timeline.update', $timelineStage) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Label Tanggal</label>
                            <input type="text" name="date_label"
                                value="{{ old('date_label', $timelineStage->date_label) }}"
                                class="form-control @error('date_label') is-invalid @enderror" required>
                            @error('date_label')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Judul Tahap</label>
                            <input type="text" name="title" value="{{ old('title', $timelineStage->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $timelineStage->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                @foreach ($statusOptions as $statusValue => $statusLabel)
                                    <option value="{{ $statusValue }}"
                                        @selected(old('status', $timelineStage->status) === $statusValue)>
                                        {{ $statusLabel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                class="form-check-input" @checked(old('is_active', $timelineStage->is_active))>
                            <label class="form-check-label" for="is_active">Tampilkan di website</label>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.timeline.index') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-info">Update Tahap</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection