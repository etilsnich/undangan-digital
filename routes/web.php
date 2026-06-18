<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UndanganController;

// Jalur buat buka halaman undangan
Route::get('/undangan', [UndanganController::class, 'index']);

// Jalur buat memproses kiriman data form Firestore
Route::post('/test-firestore', [UndanganController::class, 'testFirestore']);

// Jalur pembersih cache standar Laravel
Route::get('/clear', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Cache cleared successfully!";
});