@extends('layouts.admin.app')

@section('title', 'Kelola Konten | Pilrek CMS')
@section('page_title', 'Kelola Konten')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modul Konten</h3>
        </div>
        <div class="card-body">
            <p class="mb-3">Halaman ini bisa diakses oleh role <code>super_admin</code> dan <code>editor</code>.</p>
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('admin.timeline.index') }}" class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-stream"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Timeline</span>
                                <span class="info-box-number">Kelola Tahapan</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.candidates.index') }}" class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-user-tie"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Calon Rektor</span>
                                <span class="info-box-number">Kelola Profil</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.requirements.index') }}" class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary"><i class="fas fa-tasks"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Persyaratan</span>
                                <span class="info-box-number">Kelola Card</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.news.index') }}" class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-newspaper"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Berita</span>
                                <span class="info-box-number">Kelola Artikel</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.messages.index') }}" class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-inbox"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pesan Kontak</span>
                                <span class="info-box-number">Inbox Masuk</span>
                            </div>
                        </div>
                    </a>
                </div>
                @if (auth()->user()?->isSuperAdmin())
                    <div class="col-md-3">
                        <a href="{{ route('admin.activity.index') }}" class="text-dark">
                            <div class="info-box">
                                <span class="info-box-icon bg-secondary"><i class="fas fa-history"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Activity Log</span>
                                    <span class="info-box-number">Audit Admin</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
