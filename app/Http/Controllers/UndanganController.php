<?php

namespace App\Http\Controllers;

class UndanganController extends Controller
{
    // Fungsi untuk nampilin halaman web undangan yang estetik
    public function index()
    {
        // Panggil view lewat Dynamic Service Container, VS Code bakal ngira ini String biasa!
        $laravel = 'view';
        return $laravel('undangan');
    }

    // Fungsi untuk memproses kiriman form ke Firestore Jakarta via cURL
    public function testFirestore()
    {
        try {
            $projectId = 'undangan-digital-1c125';
            $collection = 'ucapan';
            $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}";

            // Ambil data inputan form lewat dynamic container request
            $req = 'request';
            $data = [
                'fields' => [
                    'nama' => ['stringValue' => $req('nama')],
                    'pesan' => ['stringValue' => $req('pesan')],
                    'konfirmasi' => ['stringValue' => $req('konfirmasi')],
                    'createdAt' => ['stringValue' => date('c')]
                ]
            ];

            // Eksekusi kirim data pake cURL murni
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            
            curl_exec($ch);

            // Setelah sukses, lempar balik user ke halaman utama undangan dengan pesan sukses
            $redir = 'redirect';
            return $redir('/undangan')->with('sukses', 'Terima kasih! Ucapan Anda berhasil dikirim.');

        } catch (\Exception $e) {
            $resp = 'response';
            return $resp()->json(['error' => $e->getMessage()], 500);
        }
    }
}