<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat satu user admin untuk login
        User::create([
            'name' => 'Admin Gampong',
            'email' => 'admin@gampongudeung.test',
            'password' => Hash::make('password'),
        ]);

        // Panggil semua seeder yang telah dibuat
        $this->call([
            ArticleSeeder::class,
            GuideSeeder::class,
            EventSeeder::class,
            GallerySeeder::class,
            GovernmentStructureSeeder::class,
        ]);
    }
}