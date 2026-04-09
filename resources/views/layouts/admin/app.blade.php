@extends('layouts.admin.base')

@section('body_class', 'hold-transition sidebar-mini layout-fixed layout-navbar-fixed')

@section('body')
    @php
        $adminUser = auth()->user();
    @endphp
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-md-block mr-2">
                    <span class="nav-link text-sm text-muted">
                        <i class="far fa-user mr-1"></i>{{ $adminUser->email ?? '-' }}
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" target="_blank" rel="noopener">
                        <i class="fas fa-external-link-alt mr-1"></i>Lihat Website
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light">{{ $siteSettings?->site_name ?? 'Admin Pilrek' }}</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.content') }}"
                                class="nav-link {{ request()->routeIs('admin.content') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Kelola Konten</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.timeline.index') }}"
                                class="nav-link {{ request()->routeIs('admin.timeline.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-stream"></i>
                                <p>Kelola Timeline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.candidates.index') }}"
                                class="nav-link {{ request()->routeIs('admin.candidates.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Kelola Balon & Calon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.requirements.index') }}"
                                class="nav-link {{ request()->routeIs('admin.requirements.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Kelola Persyaratan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.news.index') }}"
                                class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-newspaper"></i>
                                <p>Kelola Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.downloads.index') }}"
                                class="nav-link {{ request()->routeIs('admin.downloads.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-download"></i>
                                <p>Kelola Unduhan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.messages.index') }}"
                                class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-inbox"></i>
                                <p>Pesan Masuk</p>
                            </a>
                        </li>
                        @if ($adminUser && $adminUser->isSuperAdmin())
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.edit') }}"
                                    class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>Pengaturan Situs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users') }}"
                                    class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>Manajemen User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.activity.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>Activity Log</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page_title', 'Dashboard')</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @yield('content')
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>{{ $siteSettings?->site_name ?? 'Admin CMS Pilrek Unmul' }}</strong>
            &copy; {{ date('Y') }}.
        </footer>
    </div>
@endsection
