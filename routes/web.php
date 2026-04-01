<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;

// Pastikan ada ->name('about') di baris ini
Route::get('/about', [PageController::class, 'about'])->name('about');

// Lakukan hal yang sama untuk home dan contact agar tidak error lagi
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');