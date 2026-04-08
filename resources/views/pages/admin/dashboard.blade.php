@extends('layouts.admin.app')

@section('title', 'Dashboard Admin | Pilrek CMS')
@section('page_title', 'Dashboard CMS Pilrek')

@section('content')
    @php
        $adminUser = auth()->user();
        $timelineCount = 0;
        $candidateCount = 0;
        $newsCount = 0;
        $unreadMessageCount = 0;
        $recentActivities = collect();

        if (\Illuminate\Support\Facades\Schema::hasTable('timeline_stages')) {
            $timelineCount = \App\Models\TimelineStage::query()->count();
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('rector_candidates')) {
            $candidateCount = \App\Models\RectorCandidate::query()->where('is_active', true)->count();
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('news_posts')) {
            $newsCount = \App\Models\NewsPost::query()->where('status', 'published')->count();
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('contact_messages')) {
            $unreadMessageCount = \App\Models\ContactMessage::query()->where('is_read', false)->count();
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('activity_logs')) {
            $recentActivities = \App\Models\ActivityLog::query()
                ->latestFirst()
                ->limit(8)
                ->get();
        }
    @endphp

    <div class="alert alert-info">
        Login sebagai: <strong>{{ $adminUser->name }}</strong>
        ({{ $adminUser->email }}) - Role:
        <strong>{{ str($adminUser->role)->replace('_', ' ')->title() }}</strong>
    </div>

    <div class="row">
        <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $timelineCount }}</h3>
                    <p>Total Tahapan Timeline</p>
                </div>
                <div class="icon">
                    <i class="fas fa-stream"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $candidateCount }}</h3>
                    <p>Total Kandidat Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $newsCount }}</h3>
                    <p>Berita Terpublikasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-12">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $unreadMessageCount }}</h3>
                    <p>Pesan Belum Dibaca</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Status Implementasi CMS</h3>
        </div>
        <div class="card-body">
            <p class="mb-2">Fondasi admin sudah siap dipakai untuk pengembangan berikutnya:</p>
            <ul class="mb-0">
                <li>Layout AdminLTE reusable untuk halaman login dan panel admin</li>
                <li>Halaman login admin (UI)</li>
                <li>Halaman dashboard admin awal</li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Aktivitas Admin Terbaru</h3>
            @if (auth()->user()?->isSuperAdmin())
                <a href="{{ route('admin.activity.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Log</a>
            @endif
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @forelse ($recentActivities as $activity)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $activity->description }}</strong>
                            <small class="text-muted">{{ $activity->created_at?->format('d M Y H:i') }}</small>
                        </div>
                        <div class="text-muted text-sm">
                            {{ $activity->action }}
                            @if ($activity->adminUser)
                                oleh {{ $activity->adminUser->name }}
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Belum ada aktivitas tercatat.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
