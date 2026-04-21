<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Admin\KostController;
use App\Http\Controllers\Admin\ProfilController;
use Illuminate\Support\Facades\Route;

/* ── PUBLIC ROUTES ── */
Route::get('/',        [PageController::class, 'home'])   ->name('home');
Route::get('/about',   [PageController::class, 'about'])  ->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact',[ContactController::class, 'store'])->name('contact.store');

/* ── ADMIN ROUTES ── */
Route::prefix('admin')->name('admin.')->group(function () {

    // Login & Logout
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])    ->name('login.post');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard & CRUD (Hanya untuk yang sudah login)
    Route::middleware(['auth'])->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users',    UserController::class);
        Route::resource('profiles', ProfilController::class)->except(['show']);
        Route::resource('kategori', KategoriController::class)->except(['show']);
        Route::resource('wilayah',  WilayahController::class)->except(['show']);
        Route::resource('kost',     KostController::class)->except(['show']);
        
        Route::delete('/kost/foto/{id}', [KostController::class, 'destroyFoto'])->name('kost.foto.destroy');
        Route::get('/profil',  [ProfilController::class, 'adminProfil'])->name('profil');
        Route::put('/profil',  [ProfilController::class, 'updateProfil'])->name('profil.update');
    });
});