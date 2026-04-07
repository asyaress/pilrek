@php
    $activePage = $activePage ?? '';
@endphp

<div class="mil-top-panel">
    <div class="container">
        <a href="{{ route('home') }}" class="mil-logo">
            <img src="{{ asset('template/img/logo.png') }}" alt="Portal Pilrek 2026" width="83" height="32">
        </a>

        <nav class="mil-top-menu">
            <ul>
                <li class="{{ $activePage === 'home' ? 'mil-active' : '' }}">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="{{ $activePage === 'timeline' ? 'mil-active' : '' }}">
                    <a href="{{ route('about') }}">Timeline</a>
                </li>
                <li class="{{ $activePage === 'calon-rektor' ? 'mil-active' : '' }}">
                    <a href="{{ route('calon-rektor') }}">Calon Rektor</a>
                </li>
                <li class="{{ $activePage === 'blog' ? 'mil-active' : '' }}">
                    <a href="{{ route('blog') }}">Berita</a>
                </li>
                <li class="{{ $activePage === 'contact' ? 'mil-active' : '' }}">
                    <a href="{{ route('contact') }}">Kontak</a>
                </li>
            </ul>
        </nav>

        <div class="mil-menu-buttons">
            <a href="{{ route('calon-rektor') }}" class="mil-btn mil-sm">Daftar Calon</a>
            <div class="mil-menu-btn">
                <span></span>
            </div>
        </div>
    </div>
</div>
