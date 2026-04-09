@extends('layouts.admin.app')

@section('title', 'Edit Timeline | Pilrek CMS')
@section('page_title', 'Edit Tahap Timeline')

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

                        <div class="form-group">
                            <label>Icon Timeline</label>
                            <select name="icon_class" id="timeline_icon_class_edit"
                                class="form-control @error('icon_class') is-invalid @enderror" data-icon-select required>
                                @foreach ($iconOptions as $iconValue => $iconLabel)
                                    <option value="{{ $iconValue }}"
                                        @selected(old('icon_class', $timelineStage->icon_class ?? 'fa-calendar-alt') === $iconValue)>
                                        {{ $iconLabel }} ({{ $iconValue }})
                                    </option>
                                @endforeach
                            </select>
                            @error('icon_class')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="pilrek-icon-preview-box mt-2"
                                data-icon-preview-for="timeline_icon_class_edit">
                                <div class="small text-muted mb-1">Preview Icon</div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt mr-2" data-icon-preview></i>
                                    <code data-icon-preview-label>fa-calendar-alt</code>
                                </div>
                            </div>

                            <div class="pilrek-icon-grid" data-icon-grid-for="timeline_icon_class_edit">
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

    @push('scripts')
        <script>
            (function() {
                var select = document.getElementById('timeline_icon_class_edit');
                if (!select) return;

                var previewBox = document.querySelector('[data-icon-preview-for="timeline_icon_class_edit"]');
                var previewIcon = previewBox ? previewBox.querySelector('[data-icon-preview]') : null;
                var previewLabel = previewBox ? previewBox.querySelector('[data-icon-preview-label]') : null;
                var iconButtons = Array.prototype.slice.call(document.querySelectorAll(
                    '[data-icon-grid-for="timeline_icon_class_edit"] [data-icon-value]'
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
