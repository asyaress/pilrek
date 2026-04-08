@push('styles')
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .news-slug-preview {
            display: inline-block;
            margin-top: 6px;
            font-size: 12px;
            color: #6c757d;
        }

        .news-media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 12px;
            max-height: 420px;
            overflow: auto;
        }

        .news-media-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #fff;
            overflow: hidden;
        }

        .news-media-card img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            display: block;
        }

        .news-media-card .meta {
            padding: 8px;
            font-size: 11px;
        }
    </style>
@endpush

<div class="modal fade" id="newsMediaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Media Manager Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row mb-3">
                    <div class="col-md-9 mb-2 mb-md-0">
                        <input type="text" id="newsMediaSearch" class="form-control"
                            placeholder="Cari file gambar berdasarkan nama...">
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="newsMediaSearchBtn" class="btn btn-outline-primary btn-block">
                            Cari Media
                        </button>
                    </div>
                </div>
                <div id="newsMediaGrid" class="news-media-grid">
                    <div class="text-muted">Memuat media...</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.1.0/plugins/summernote/lang/summernote-id-ID.min.js') }}"></script>
    <script>
        (function() {
            const titleInput = document.getElementById('news_title');
            const slugPreview = document.getElementById('slug_preview');
            const baseSlug = @json($initialSlug ?? '');
            const mediaGrid = document.getElementById('newsMediaGrid');
            const mediaSearch = document.getElementById('newsMediaSearch');
            const mediaSearchBtn = document.getElementById('newsMediaSearchBtn');
            const mediaModal = document.getElementById('newsMediaModal');
            const uploadUrl = @json(route('admin.news.media.upload'));
            const libraryUrl = @json(route('admin.news.media.library'));

            const slugify = function(text) {
                return String(text || '')
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            };

            const updateSlugPreview = function() {
                if (!titleInput || !slugPreview) {
                    return;
                }

                const titleSlug = slugify(titleInput.value);
                slugPreview.textContent = titleSlug || baseSlug || '-';
            };

            updateSlugPreview();
            if (titleInput) {
                titleInput.addEventListener('input', updateSlugPreview);
            }

            const renderMedia = function(items) {
                if (!mediaGrid) {
                    return;
                }

                if (!Array.isArray(items) || items.length === 0) {
                    mediaGrid.innerHTML = '<div class="text-muted">Belum ada media yang cocok.</div>';
                    return;
                }

                mediaGrid.innerHTML = items.map(function(item) {
                    return '' +
                        '<div class="news-media-card">' +
                        '<img src="' + item.url + '" alt="' + item.name + '">' +
                        '<div class="meta">' +
                        '<div class="font-weight-bold text-truncate" title="' + item.name + '">' + item.name + '</div>' +
                        '<div class="text-muted mb-2">' + item.size_kb + ' KB</div>' +
                        '<button type="button" class="btn btn-sm btn-primary btn-block js-insert-media" data-url="' + item.url + '" data-name="' + item.name + '">Pakai</button>' +
                        '</div>' +
                        '</div>';
                }).join('');
            };

            const loadMedia = function() {
                if (!mediaGrid) {
                    return;
                }

                mediaGrid.innerHTML = '<div class="text-muted">Memuat media...</div>';
                const q = mediaSearch ? mediaSearch.value.trim() : '';
                const requestUrl = q ? (libraryUrl + '?q=' + encodeURIComponent(q)) : libraryUrl;

                fetch(requestUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                }).then(function(response) {
                    return response.json();
                }).then(function(data) {
                    renderMedia(data.items || []);
                }).catch(function() {
                    mediaGrid.innerHTML = '<div class="text-danger">Gagal memuat media.</div>';
                });
            };

            if (mediaModal) {
                $(mediaModal).on('shown.bs.modal', function() {
                    loadMedia();
                    if (mediaSearch) {
                        mediaSearch.focus();
                    }
                });
            }

            if (mediaSearchBtn) {
                mediaSearchBtn.addEventListener('click', loadMedia);
            }

            if (mediaSearch) {
                mediaSearch.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        loadMedia();
                    }
                });
            }

            $(document).on('click', '.js-insert-media', function() {
                const imageUrl = $(this).data('url');
                const imageName = $(this).data('name') || 'gambar';
                $('#news_content').summernote('insertImage', imageUrl, imageName);
                $('#newsMediaModal').modal('hide');
            });

            const uploadImage = function(file) {
                const data = new FormData();
                data.append('image', file);
                data.append('_token', @json(csrf_token()));

                return $.ajax({
                    url: uploadUrl,
                    method: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                });
            };

            const mediaButton = function(context) {
                const ui = $.summernote.ui;
                return ui.button({
                    contents: '<i class="fas fa-photo-video"></i>',
                    tooltip: 'Media Manager',
                    click: function() {
                        $('#newsMediaModal').modal('show');
                    }
                }).render();
            };

            $('#news_content').summernote({
                lang: 'id-ID',
                height: 320,
                minHeight: 220,
                placeholder: 'Tulis konten berita di sini...',
                buttons: {
                    mediaManager: mediaButton,
                },
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video', 'mediaManager']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        Array.from(files).forEach(function(file) {
                            uploadImage(file).done(function(response) {
                                if (response && response.url) {
                                    $('#news_content').summernote('insertImage', response.url, response.name || 'gambar');
                                }
                            }).fail(function() {
                                alert('Upload gambar gagal. Pastikan format jpg/jpeg/png/webp dan ukuran maksimal 5MB.');
                            });
                        });
                    }
                }
            });
        })();
    </script>
@endpush
