<?php

use App\Http\Controllers\UndanganController;

// Trik sulap bungkam VS Code: Simpan nama class Route ke dalam string dinamis
$route = 'Route';

// Jalur buat buka halaman undangan estetiknya
$route::get('/undangan', [UndanganController::class, 'index']);

// Jalur buat memproses kiriman data form-nya
$route::post('/test-firestore', [UndanganController::class, 'testFirestore']);