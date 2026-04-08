@extends('layouts.admin.base')

@section('body_class', 'hold-transition login-page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('admin.dashboard') }}"><b>Pilrek</b>CMS</a>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>
@endsection
