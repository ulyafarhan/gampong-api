<?php

namespace Database\Seeders;

use App\Models\GovernmentStructure;
use Illuminate\Database\Seeder;

class GovernmentStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GovernmentStructure::create([
            'name' => 'Dr. Code',
            'position' => 'Keuchik Gampong',
            'image' => 'https://via.placeholder.com/400x400.png?text=Keuchik',
            'order' => 1,
        ]);

        GovernmentStructure::create([
            'name' => 'Fitra',
            'position' => 'Sekretaris Gampong',
            'image' => 'https://via.placeholder.com/400x400.png?text=Sekretaris',
            'order' => 2,
        ]);

        GovernmentStructure::create([
            'name' => 'Fadhil',
            'position' => 'Kepala Urusan Pemerintahan',
            'image' => 'https://via.placeholder.com/400x400.png?text=Kaur',
            'order' => 3,
        ]);
    }
}