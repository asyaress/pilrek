@extends('layouts.admin.app')

@section('title', 'Pesan Masuk | Pilrek CMS')
@section('page_title', 'Inbox Pesan Kontak')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $unreadCount }}</h3>
                    <p>Pesan Belum Dibaca</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Daftar Pesan</h3>
            <div class="card-tools">
                <span class="badge badge-light">Total: {{ $messages->total() }}</span>
            </div>
        </div>
        <div class="card-body border-bottom">
            <form action="{{ route('admin.messages.index') }}" method="get" class="form-row align-items-end">
                <div class="form-group col-md-8 mb-2">
                    <label class="mb-1">Cari</label>
                    <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                        placeholder="Cari nama, email, telepon, isi pesan...">
                </div>
                <div class="form-group col-md-2 mb-2">
                    <label class="mb-1">Status</label>
                    <select name="status" class="form-control">
                        <option value="all" @selected(($filters['status'] ?? 'all') === 'all')>Semua</option>
                        <option value="unread" @selected(($filters['status'] ?? 'all') === 'unread')>Unread</option>
                        <option value="read" @selected(($filters['status'] ?? 'all') === 'read')>Read</option>
                    </select>
                </div>
                <div class="form-group col-md-2 mb-2 text-md-right">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-light btn-block mt-2">Reset</a>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Status</th>
                            <th>Pengirim</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th style="width: 140px;">Tanggal</th>
                            <th style="width: 230px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                            <tr>
                                <td>
                                    @if ($message->is_read)
                                        <span class="badge badge-success">Read</span>
                                    @else
                                        <span class="badge badge-warning">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $message->name }}</div>
                                    <div class="text-muted text-sm">{{ $message->phone ?: '-' }}</div>
                                </td>
                                <td>{{ $message->email }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($message->message, 90) }}</td>
                                <td>{{ $message->created_at?->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    @if (!$message->is_read)
                                        <form action="{{ route('admin.messages.read', $message) }}" method="post" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fas fa-check"></i> Mark Read
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.messages.destroy', $message) }}" method="post" class="d-inline"
                                        onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada pesan kontak masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($messages->hasPages())
            <div class="card-footer">{{ $messages->links() }}</div>
        @endif
    </div>
@endsection
