<?php

// 1. Paksa Laravel pakai folder /tmp bawaan Vercel yang punya izin Write/Tulis
if (isset($_SERVER['VERCEL_URL'])) {
    // Buat folder internal yang dibutuhkan Laravel di memory serverless
    $storageFolders = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/bootstrap/cache'
    ];
    foreach ($storageFolders as $folder) {
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
    }

    // Bind atau set environment variable storage path secara dinamis sebelum Laravel di-load
    putenv('APP_STORAGE=/tmp/storage');
    $_ENV['APP_STORAGE'] = '/tmp/storage';
}

// 2. Oper traffic ke index utama Laravel seperti biasa
require __DIR__ . '/../public/index.php';