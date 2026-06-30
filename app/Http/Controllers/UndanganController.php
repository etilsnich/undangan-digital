<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; // Buat ngatur format waktu biar estetik

class UndanganController extends Controller
{
    // Fungsi untuk nampilin halaman web undangan beserta data ucapannya
    public function index()
    {
        $projectId = 'undangan-digital-1c125';
        $collection = 'ucapan';
        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}";

        // Tarik data dari Firestore pake cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $ucapans = [];
        if ($response) {
            $data = json_decode($response, true);
            // Cek apakah ada dokumen ucapan di Firestore
            if (isset($data['documents'])) {
                foreach ($data['documents'] as $doc) {
                    $fields = $doc['fields'];
                    $ucapans[] = [
                        'nama' => $fields['nama']['stringValue'] ?? 'Tamu',
                        'pesan' => $fields['pesan']['stringValue'] ?? '',
                        'konfirmasi' => $fields['konfirmasi']['stringValue'] ?? '',
                        'createdAt' => $fields['createdAt']['stringValue'] ?? date('c')
                    ];
                }
                
                // Urutin dari yang paling baru (descending)
                usort($ucapans, function($a, $b) {
                    return strtotime($b['createdAt']) - strtotime($a['createdAt']);
                });
            }
        }

        // Panggil view dan lempar data $ucapans ke depan
        $laravel = 'view';
        return $laravel('undangan', compact('ucapans'));
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
                    'konfirmasi' => ['stringValue' => $req('konfirmasi') ?? 'Hadir'], // Kasih default kalau kosong
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
            curl_close($ch);

            // Setelah sukses, lempar balik user ke halaman utama undangan dengan pesan sukses
            $redir = 'redirect';
            return $redir('/undangan')->with('sukses', 'Terima kasih! Ucapan Anda berhasil dikirim.');

        } catch (\Exception $e) {
            $resp = 'response';
            return $resp()->json(['error' => $e->getMessage()], 500);
        }
    }
}