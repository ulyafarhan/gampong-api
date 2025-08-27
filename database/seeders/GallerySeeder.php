<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::create([
            'title' => 'Foto Kegiatan Maulid Nabi 1445 H',
            'description' => 'Dokumentasi kegiatan peringatan Maulid Nabi di Gampong Udeung.',
            'type' => 'image',
            'url' => 'https://via.placeholder.com/800x600.png?text=Maulid+Nabi',
        ]);

        Gallery::create([
            'title' => 'Video Acara Perpisahan Siswa',
            'description' => 'Video dokumentasi acara perpisahan siswa SD Negeri Gampong Udeung.',
            'type' => 'video',
            'url' => 'https://www.youtube.com/embed/YOUR_VIDEO_ID', // Ganti dengan ID video YouTube
        ]);
        
        Gallery::create([
            'title' => 'Foto Gotong Royong 2025',
            'description' => 'Dokumentasi kegiatan kerja bakti dan gotong royong.',
            'type' => 'image',
            'url' => 'https://via.placeholder.com/800x600.png?text=Gotong+Royong',
        ]);
    }
}