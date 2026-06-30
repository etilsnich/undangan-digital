<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UndanganController;

// Jalur UTAMA (/) langsung nampilin halaman undangan
Route::get('/', [UndanganController::class, 'index']);

// Jalur cadangan kalau mau diakses lewat /undangan juga bisa
Route::get('/undangan', [UndanganController::class, 'index']);

// TAMBAHIN RUTE INI CUY BUAT UCAPAN:
Route::post('/kirim-ucapan', [UndanganController::class, 'kirimUcapan'])->name('kirim.ucapan');

// Jalur buat memproses kiriman data form Firestore
Route::post('/test-firestore', [UndanganController::class, 'testFirestore']);

// Jalur pembersih cache standar Laravel
Route::get('/clear', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Cache cleared successfully!";
});

