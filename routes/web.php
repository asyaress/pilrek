<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/calon-rektor', 'pages.calon-rektor')->name('calon-rektor');
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('/publication', 'pages.publication')->name('publication');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/career', 'pages.career')->name('career');
Route::view('/career-details', 'pages.career-details')->name('career.details');
Route::view('/price', 'pages.price')->name('price');
Route::view('/register', 'pages.register')->name('register');
