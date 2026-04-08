@extends('layouts.admin.auth')

@section('title', 'Login Admin | Pilrek CMS')

@section('content')
    <p class="login-box-msg">Masuk ke dashboard admin Pilrek Unmul</p>

    @if (session('status'))
        <div class="alert alert-success py-2">{{ session('status') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning py-2">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.login.attempt') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" placeholder="Email Admin" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="rememberAdmin" {{ old('remember') ? 'checked' : '' }}>
                    <label for="rememberAdmin">Ingat saya</label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </div>
    </form>
@endsection
