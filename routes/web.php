<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/timeline', 'pages.timeline')->name('timeline');
Route::view('/calon-rektor', 'pages.calon-rektor')->name('calon-rektor');
Route::view('/berita', 'pages.berita')->name('berita');
Route::view('/publikasi', 'pages.publikasi')->name('publikasi');
Route::view('/kontak', 'pages.kontak')->name('kontak');
Route::view('/career', 'pages.career')->name('career');
Route::view('/calon-rektor/detail', 'pages.detail-calon-rektor')->name('calon-rektor.detail');
Route::view('/price', 'pages.price')->name('price');
Route::view('/register', 'pages.register')->name('register');
