@extends('layouts.admin.app')

@section('title', 'Manajemen User | Pilrek CMS')
@section('page_title', 'Manajemen User Admin')

@section('content')
    @php
        $currentUser = auth()->user();
    @endphp

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah User Admin</h3>
                </div>
                <form action="{{ route('admin.users.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                                @foreach ($roleOptions as $roleValue => $roleLabel)
                                    <option value="{{ $roleValue }}" @selected(old('role', 'editor') === $roleValue)>{{ $roleLabel }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan User</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Daftar User Admin</h3>
                    <div class="card-tools">
                        <span class="badge badge-light">Total: {{ $users->total() }}</span>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form action="{{ route('admin.users') }}" method="get" class="form-row align-items-end">
                        <div class="form-group col-md-8 mb-2">
                            <label class="mb-1">Cari</label>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control"
                                placeholder="Cari nama atau email...">
                        </div>
                        <div class="form-group col-md-2 mb-2">
                            <label class="mb-1">Role</label>
                            <select name="role" class="form-control">
                                <option value="all" @selected(($filters['role'] ?? 'all') === 'all')>Semua</option>
                                @foreach ($roleOptions as $roleValue => $roleLabel)
                                    <option value="{{ $roleValue }}" @selected(($filters['role'] ?? 'all') === $roleValue)>
                                        {{ $roleLabel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 mb-2 text-md-right">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            <a href="{{ route('admin.users') }}" class="btn btn-light btn-block mt-2">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th style="width: 120px;">Role</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    @php
                                        $roleBadge = $user->role === 'super_admin' ? 'badge-danger' : 'badge-info';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">{{ $user->name }}</div>
                                            @if ($currentUser && $currentUser->id === $user->id)
                                                <span class="badge badge-secondary">Akun Saat Ini</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge {{ $roleBadge }}">{{ $roleOptions[$user->role] ?? $user->role }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="d-inline"
                                                onsubmit="return confirm('Hapus user ini?')">
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
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada user admin.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($users->hasPages())
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
