<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'Pengumuman Jadwal Musyawarah Gampong',
            'slug' => Str::slug('Pengumuman Jadwal Musyawarah Gampong'),
            'content' => 'Dengan hormat, diberitahukan kepada seluruh warga Gampong Udeung bahwa akan diadakan musyawarah gampong pada hari Jumat, 29 Agustus 2025, pukul 09.00 WIB, bertempat di Meunasah. Agenda musyawarah adalah pembahasan tentang rencana pembangunan jalan desa.',
            'image' => null,
            'summary' => 'Musyawarah Gampong Udeung akan diadakan pada Jumat, 29 Agustus 2025 di Meunasah untuk membahas rencana pembangunan jalan.',
            'is_published' => true,
        ]);

        Article::create([
            'title' => 'Peringatan Maulid Nabi Muhammad SAW di Meunasah',
            'slug' => Str::slug('Peringatan Maulid Nabi Muhammad SAW di Meunasah'),
            'content' => 'Gampong Udeung akan mengadakan peringatan Maulid Nabi Muhammad SAW. Acara ini akan dimeriahkan dengan ceramah agama dan santunan anak yatim. Diharapkan partisipasi aktif dari seluruh warga.',
            'image' => null,
            'summary' => 'Peringatan Maulid Nabi di Gampong Udeung akan dimeriahkan dengan ceramah dan santunan anak yatim. Diharapkan partisipasi warga.',
            'is_published' => true,
        ]);
        
        Article::create([
            'title' => 'Kerja Bakti Rutin Lingkungan',
            'slug' => Str::slug('Kerja Bakti Rutin Lingkungan'),
            'content' => 'Kerja bakti rutin akan dilaksanakan pada hari Minggu, 31 Agustus 2025. Seluruh warga diminta untuk membersihkan lingkungan di sekitar rumah masing-masing.',
            'image' => null,
            'summary' => 'Kerja bakti rutin pada Minggu, 31 Agustus 2025. Warga diharapkan membersihkan lingkungan sekitar rumah.',
            'is_published' => false,
        ]);
    }
}