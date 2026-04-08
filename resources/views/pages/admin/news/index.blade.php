@extends('layouts.admin.app')

@section('title', 'Kelola Berita | Pilrek CMS')
@section('page_title', 'Kelola Berita / Publikasi')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Berita</h3>
                </div>
                <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body" style="max-height: 72vh; overflow: auto;">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" id="news_title" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            <small class="news-slug-preview">Slug: <code id="slug_preview">-</code></small>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ringkasan</label>
                            <textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Isi Berita</label>
                            <textarea id="news_content" name="content" rows="7" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            <small class="text-muted d-block mt-1">Gunakan toolbar editor untuk format teks, gambar, dan media.</small>
                            @error('content')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tags (pisahkan dengan koma)</label>
                            <input type="text" name="tags_input" value="{{ old('tags_input') }}"
                                class="form-control @error('tags_input') is-invalid @enderror"
                                placeholder="pengumuman, pilrek, kampus">
                            @error('tags_input')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    @foreach ($statusOptions as $statusValue => $statusLabel)
                                        <option value="{{ $statusValue }}" @selected(old('status', 'draft') === $statusValue)>
                                            {{ $statusLabel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Publish</label>
                                <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                                    class="form-control @error('published_at') is-invalid @enderror">
                                @error('published_at')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" name="cover_image" class="form-control-file @error('cover_image') is-invalid @enderror">
                            @error('cover_image')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check mb-2">
                            <input type="checkbox" name="is_featured" value="1" id="is_featured"
                                class="form-check-input" @checked(old('is_featured'))>
                            <label class="form-check-label" for="is_featured">Tandai Featured</label>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Berita</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Daftar Berita</h3>
                    <div class="card-tools">
                        <span class="badge badge-light">Total: {{ $posts->total() }}</span>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form action="{{ route('admin.news.index') }}" method="get" class="form-row align-items-end">
                        <div class="form-group col-md-5 mb-2">
                            <label class="mb-1">Cari</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                                placeholder="Cari judul, ringkasan, isi...">
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label class="mb-1">Status</label>
                            <select name="status" class="form-control">
                                <option value="all" @selected(($filters['status'] ?? 'all') === 'all')>Semua</option>
                                @foreach ($statusOptions as $statusValue => $statusLabel)
                                    <option value="{{ $statusValue }}" @selected(($filters['status'] ?? 'all') === $statusValue)>
                                        {{ $statusLabel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 mb-2">
                            <label class="mb-1">Featured</label>
                            <select name="featured" class="form-control">
                                <option value="all" @selected(($filters['featured'] ?? 'all') === 'all')>Semua</option>
                                <option value="1" @selected(($filters['featured'] ?? 'all') === '1')>Ya</option>
                                <option value="0" @selected(($filters['featured'] ?? 'all') === '0')>Tidak</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 mb-2 text-md-right">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-light btn-block mt-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th style="width: 110px;">Status</th>
                                    <th style="width: 140px;">Publish</th>
                                    <th style="width: 80px;">Feat.</th>
                                    <th style="width: 190px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    @php
                                        $statusBadge = $post->status === 'published' ? 'badge-success' : 'badge-secondary';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">{{ $post->title }}</div>
                                            <div class="text-muted text-sm">/{{ $post->slug }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusBadge }}">{{ $statusOptions[$post->status] ?? $post->status }}</span>
                                        </td>
                                        <td>{{ optional($post->published_at)->format('d M Y') ?: '-' }}</td>
                                        <td>
                                            @if ($post->is_featured)
                                                <span class="badge badge-warning">Ya</span>
                                            @else
                                                <span class="badge badge-light">Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.news.edit', $post) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.news.destroy', $post) }}" method="post" class="d-inline"
                                                onsubmit="return confirm('Hapus berita ini?')">
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
                                        <td colspan="5" class="text-center text-muted py-4">Belum ada berita.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($posts->hasPages())
                    <div class="card-footer">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('pages.admin.news.partials.editor-enhancer', [
        'initialSlug' => old('title') ? \Illuminate\Support\Str::slug(old('title')) : '',
    ])
@endsection
