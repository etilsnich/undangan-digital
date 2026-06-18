<?php

// 1. Paksa server muntahin error PHP murni ke layar browser biar ketahuan pelakunya
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Paksa Laravel pakai folder /tmp bawaan Vercel
if (isset($_SERVER['VERCEL_URL'])) {
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

    putenv('APP_STORAGE=/tmp/storage');
    $_ENV['APP_STORAGE'] = '/tmp/storage';
}

$basePath = isset($_SERVER['VERCEL_URL']) ? '/var/task/user' : dirname(__DIR__);

// 3. Panggil Laravel
require __DIR__ . '/../public/index.php';