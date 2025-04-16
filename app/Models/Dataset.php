<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\VarDumper\VarDumper;

class Dataset
{
    protected static $filePath = 'dataset/dataset.csv';

    protected static $apiUrl = 'http://localhost:5000/get_data';

    public static function all()
    {
        try {
            // Melakukan request GET ke API
            $response = Http::get(self::$apiUrl);

            // Jika status code adalah 200 (sukses)
            if ($response->successful()) {
                // Ambil data JSON dari response API
                $data = $response->json();
                // Konversi data menjadi array of object
                return collect($data)->map(function ($item) {
                    return (object) $item;
                });
            }

            return [];
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan array kosong
            return [];
        }
    }

    // Mengambil data dengan pagination
    public static function paginate($perPage = 10, $page = 1)
    {
        try {
            // Mengambil seluruh data dari API Flask tanpa paginasi
            $response = Http::get(self::$apiUrl);

            // Jika status code adalah 200 (sukses)
            if ($response->successful()) {
                $result = $response->json()['data']; // Ambil data JSON dari API

                // Hitung jumlah data yang akan ditampilkan sesuai halaman
                $total = count($result); // Total data yang diterima
                $offset = ($page - 1) * $perPage; // Hitung offset berdasarkan halaman
                $data = array_slice($result, $offset, $perPage); // Ambil data berdasarkan offset dan perPage

                // Hitung halaman terakhir
                $lastPage = ceil($total / $perPage);

                // Struktur data untuk pagination di Laravel
                return [
                    'data' => $data, // Data yang diterima berdasarkan paginasi
                    'total' => $total, // Total data yang diterima
                    'last_page' => $lastPage, // Halaman terakhir
                    'current_page' => $page // Halaman yang sedang diakses
                ];
            }

            // Jika API gagal
            return [
                'data' => [],
                'total' => 0,
                'last_page' => 1,
                'current_page' => 1
            ];
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return [
                'data' => [],
                'total' => 0,
                'last_page' => 1,
                'current_page' => 1
            ];
        }
    }
}
