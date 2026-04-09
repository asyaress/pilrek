@extends('layouts.admin.app')

@section('title', 'Edit Persyaratan | Pilrek CMS')
@section('page_title', 'Edit Persyaratan Calon Rektor')

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
                border-color: #17a2b8;
                background: #e8f8fb;
            }
        </style>
    @endpush

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

                        <div class="form-group">
                            <label>Icon Card</label>
                            <select name="icon_class" id="requirement_icon_class_edit"
                                class="form-control @error('icon_class') is-invalid @enderror" data-icon-select
                                required>
                                @foreach ($iconOptions as $iconValue => $iconLabel)
                                    <option value="{{ $iconValue }}"
                                        @selected(old('icon_class', $requirement->icon_class ?? 'fa-file-alt') === $iconValue)>
                                        {{ $iconLabel }} ({{ $iconValue }})
                                    </option>
                                @endforeach
                            </select>
                            @error('icon_class')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="pilrek-icon-preview-box mt-2"
                                data-icon-preview-for="requirement_icon_class_edit">
                                <div class="small text-muted mb-1">Preview Icon</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-file-alt mr-2" data-icon-preview></i>
                                    <code data-icon-preview-label>fa-file-alt</code>
                                </div>
                            </div>

                            <div class="pilrek-icon-grid" data-icon-grid-for="requirement_icon_class_edit">
                                @foreach ($iconOptions as $iconValue => $iconLabel)
                                    <button type="button" class="pilrek-icon-btn" data-icon-value="{{ $iconValue }}"
                                        title="{{ $iconLabel }}">
                                        <i class="fas {{ $iconValue }}"></i>
                                        <span>{{ $iconLabel }}</span>
                                    </button>
                                @endforeach
                            </div>
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

    @push('scripts')
        <script>
            (function() {
                var select = document.getElementById('requirement_icon_class_edit');
                if (!select) return;

                var previewBox = document.querySelector('[data-icon-preview-for="requirement_icon_class_edit"]');
                var previewIcon = previewBox ? previewBox.querySelector('[data-icon-preview]') : null;
                var previewLabel = previewBox ? previewBox.querySelector('[data-icon-preview-label]') : null;
                var iconButtons = Array.prototype.slice.call(document.querySelectorAll(
                    '[data-icon-grid-for="requirement_icon_class_edit"] [data-icon-value]'
                ));

                function syncIconUI() {
                    var value = select.value || 'fa-file-alt';
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
