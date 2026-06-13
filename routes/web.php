<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengunjungController;

// Public routes
Route::get('/', [PengunjungController::class, 'beranda'])->name('beranda');
Route::get('/artikel/{id}', [PengunjungController::class, 'detail'])->name('artikel.detail');


// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('penulis', PenulisController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::resource('kategori-artikel', KategoriArtikelController::class);

    // Partial view routes for AJAX sidebar navigation
    Route::get('/partial/dashboard', [DashboardController::class, 'partial'])->name('partial.dashboard');
    Route::get('/partial/penulis', [PenulisController::class, 'partial'])->name('partial.penulis');
    Route::get('/partial/artikel', [ArtikelController::class, 'partial'])->name('partial.artikel');
    Route::get('/partial/kategori', [KategoriArtikelController::class, 'partial'])->name('partial.kategori');
    Route::get('/partial/profil', [\App\Http\Controllers\ProfilController::class, 'partial'])->name('partial.profil');
    
    Route::post('/profil', [\App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');
});
