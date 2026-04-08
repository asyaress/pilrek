@extends('layouts.admin.app')

@section('title', 'Activity Log | Pilrek CMS')
@section('page_title', 'Log Aktivitas Admin')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <form method="get" action="{{ route('admin.activity.index') }}" class="form-row align-items-end">
                <div class="form-group col-md-3">
                    <label>Aksi</label>
                    <select name="action" class="form-control">
                        <option value="">Semua Aksi</option>
                        @foreach ($actions as $action)
                            <option value="{{ $action }}" @selected(($filters['action'] ?? '') === $action)>{{ $action }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Admin</label>
                    <select name="admin_user_id" class="form-control">
                        <option value="">Semua Admin</option>
                        @foreach ($adminUsers as $admin)
                            <option value="{{ $admin->id }}" @selected(($filters['admin_user_id'] ?? '') === (string) $admin->id)>
                                {{ $admin->name }} ({{ $admin->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Kata Kunci</label>
                    <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                        placeholder="Cari aksi/deskripsi...">
                </div>
                <div class="form-group col-md-3">
                    <label>Dari Tanggal</label>
                    <input type="date" name="from_date" value="{{ $filters['from_date'] ?? '' }}" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="to_date" value="{{ $filters['to_date'] ?? '' }}" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary btn-block mb-2">Filter</button>
                    <a href="{{ route('admin.activity.index') }}" class="btn btn-default btn-block">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Riwayat Aktivitas</h3>
            <div class="card-tools">
                <span class="badge badge-light">Total: {{ $logs->total() }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 170px;">Waktu</th>
                            <th style="width: 220px;">Admin</th>
                            <th style="width: 180px;">Aksi</th>
                            <th>Deskripsi</th>
                            <th style="width: 130px;">Subjek</th>
                            <th style="width: 140px;">IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>{{ $log->created_at?->format('d M Y H:i:s') }}</td>
                                <td>
                                    @if ($log->adminUser)
                                        <div class="font-weight-bold">{{ $log->adminUser->name }}</div>
                                        <div class="text-muted text-sm">{{ $log->adminUser->email }}</div>
                                    @else
                                        <span class="text-muted">System/Unknown</span>
                                    @endif
                                </td>
                                <td><span class="badge badge-info">{{ $log->action }}</span></td>
                                <td>
                                    <div>{{ $log->description }}</div>
                                    @if (!empty($log->properties))
                                        <pre class="mb-0 mt-2 p-2 bg-light text-muted" style="font-size: 11px; white-space: pre-wrap;">{{ json_encode($log->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    @if ($log->subject_type)
                                        {{ class_basename($log->subject_type) }}#{{ $log->subject_id }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $log->ip_address ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data activity log.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($logs->hasPages())
            <div class="card-footer">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
@endsection
