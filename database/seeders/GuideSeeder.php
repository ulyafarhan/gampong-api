<?php

namespace Database\Seeders;

use App\Models\Guide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guide::create([
            'title' => 'Cara Mengurus Surat Keterangan Usaha (SKU)',
            'slug' => Str::slug('Cara Mengurus Surat Keterangan Usaha (SKU)'),
            'description' => 'Panduan lengkap untuk mengurus Surat Keterangan Usaha (SKU) di Gampong Udeung.',
            'requirements' => json_encode(['Fotokopi KTP', 'Fotokopi Kartu Keluarga', 'Surat Permohonan']),
            'steps' => '1. Datang ke Kantor Gampong dengan membawa semua persyaratan.\n2. Mengisi formulir permohonan.\n3. Petugas akan memproses surat dan memberikannya kepada Anda.\n4. Membayar biaya administrasi (jika ada).',
            'estimated_time' => '1 hari kerja',
            'estimated_cost' => 0.00,
            'tips' => 'Pastikan semua dokumen asli dan fotokopi sudah disiapkan sebelum datang.'
        ]);

        Guide::create([
            'title' => 'Prosedur Pembuatan Akta Kelahiran',
            'slug' => Str::slug('Prosedur Pembuatan Akta Kelahiran'),
            'description' => 'Langkah-langkah yang harus diikuti untuk membuat Akta Kelahiran bagi anak baru lahir.',
            'requirements' => json_encode(['Surat Keterangan Lahir dari Bidan/RS', 'Fotokopi KTP Orang Tua', 'Fotokopi Buku Nikah', 'Fotokopi Kartu Keluarga']),
            'steps' => '1. Minta Surat Keterangan Lahir dari bidan/rumah sakit.\n2. Datang ke Kantor Gampong untuk mendapatkan Surat Pengantar.\n3. Datang ke Kantor Catatan Sipil dengan semua dokumen yang diperlukan.',
            'estimated_time' => '3-7 hari kerja',
            'estimated_cost' => 50000.00,
            'tips' => 'Hubungi Disdukcapil Pidie Jaya untuk informasi biaya dan jadwal terbaru.'
        ]);
    }
}