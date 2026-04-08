@extends('layouts.admin.app')

@section('title', 'Detail Pesan | Pilrek CMS')
@section('page_title', 'Detail Pesan Kontak')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Pesan dari {{ $messageItem->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{ $messageItem->name }}</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{ $messageItem->email }}</dd>

                        <dt class="col-sm-3">Telepon</dt>
                        <dd class="col-sm-9">{{ $messageItem->phone ?: '-' }}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            @if ($messageItem->is_read)
                                <span class="badge badge-success">Read</span>
                                <span class="text-muted ml-2">{{ $messageItem->read_at?->format('d M Y H:i') }}</span>
                            @else
                                <span class="badge badge-warning">Unread</span>
                            @endif
                        </dd>

                        <dt class="col-sm-3">Dikirim</dt>
                        <dd class="col-sm-9">{{ $messageItem->created_at?->format('d M Y H:i') }}</dd>

                        <dt class="col-sm-3">IP Address</dt>
                        <dd class="col-sm-9">{{ $messageItem->ip_address ?: '-' }}</dd>

                        <dt class="col-sm-3">User Agent</dt>
                        <dd class="col-sm-9 text-muted">{{ $messageItem->user_agent ?: '-' }}</dd>

                        <dt class="col-sm-3">Isi Pesan</dt>
                        <dd class="col-sm-9" style="white-space: pre-line;">{{ $messageItem->message }}</dd>
                    </dl>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="mailto:{{ $messageItem->email }}" class="btn btn-primary">
                        <i class="fas fa-reply"></i> Balas Email
                    </a>
                    <form action="{{ route('admin.messages.destroy', $messageItem) }}" method="post"
                        onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
