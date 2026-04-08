@extends('layouts.admin.app')

@section('title', 'Edit User Admin | Pilrek CMS')
@section('page_title', 'Edit User Admin')

@section('content')
    @php
        $currentUser = auth()->user();
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $userItem->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.users') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.users.update', $userItem) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" value="{{ old('name', $userItem->name) }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $userItem->email) }}"
                                class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                                @foreach ($roleOptions as $roleValue => $roleLabel)
                                    <option value="{{ $roleValue }}" @selected(old('role', $userItem->role) === $roleValue)>
                                        {{ $roleLabel }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($currentUser && $currentUser->id === $userItem->id)
                                <small class="form-text text-muted">Anda sedang mengedit akun yang sedang login.</small>
                            @endif
                            @error('role')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>
                        <p class="text-muted mb-3">Kosongkan password jika tidak ingin mengubah password.</p>

                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.users') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-info">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
