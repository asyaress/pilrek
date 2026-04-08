@extends('layouts.admin.app')

@section('title', 'Edit Berita | Pilrek CMS')
@section('page_title', 'Edit Berita / Publikasi')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $post->title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.news.update', $post) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" id="news_title" name="title" value="{{ old('title', $post->title) }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            <small class="news-slug-preview">Slug: <code id="slug_preview">{{ old('title') ? \Illuminate\Support\Str::slug(old('title')) : $post->slug }}</code></small>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ringkasan</label>
                            <textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Isi Berita</label>
                            <textarea id="news_content" name="content" rows="10" class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                            <small class="text-muted d-block mt-1">Gunakan toolbar editor untuk format teks, gambar, dan media.</small>
                            @error('content')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tags (pisahkan dengan koma)</label>
                            <input type="text" name="tags_input" value="{{ old('tags_input', $tagsInput) }}"
                                class="form-control @error('tags_input') is-invalid @enderror">
                            @error('tags_input')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    @foreach ($statusOptions as $statusValue => $statusLabel)
                                        <option value="{{ $statusValue }}" @selected(old('status', $post->status) === $statusValue)>
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
                                <input type="datetime-local" name="published_at"
                                    value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}"
                                    class="form-control @error('published_at') is-invalid @enderror">
                                @error('published_at')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cover</label>
                            <input type="file" name="cover_image" class="form-control-file @error('cover_image') is-invalid @enderror">
                            @if ($post->cover_image_path)
                                <div class="mt-2">
                                    <img src="{{ asset($post->cover_image_path) }}" alt="{{ $post->title }}" style="height: 76px; border-radius: 8px;">
                                </div>
                            @endif
                            @error('cover_image')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check mb-2">
                            <input type="checkbox" name="is_featured" value="1" id="is_featured"
                                class="form-check-input" @checked(old('is_featured', $post->is_featured))>
                            <label class="form-check-label" for="is_featured">Tandai Featured</label>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-info">Update Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('pages.admin.news.partials.editor-enhancer', [
        'initialSlug' => old('title') ? \Illuminate\Support\Str::slug(old('title')) : $post->slug,
    ])
@endsection
