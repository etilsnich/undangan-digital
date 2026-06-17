<?php

use App\Http\Controllers\UndanganController;

// Trik sulap bungkam VS Code buat Route dan Artisan
$route = 'Route';
$artisan = 'Artisan';

// Jalur buat buka halaman undangan estetiknya
$route::get('/undangan', [UndanganController::class, 'index']);

// Jalur buat memproses kiriman data form-nya
$route::post('/test-firestore', [UndanganController::class, 'testFirestore']);

// Jalur pembersih cache dengan gaya trik dinamis yang sama
$route::get('/clear', function() use ($artisan) {
    $artisan::call('config:clear');
    $artisan::call('cache:clear');
    $artisan::call('view:clear');
    return "Cache cleared successfully!";
});