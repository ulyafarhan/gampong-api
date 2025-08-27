<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title' => 'Gotong Royong Bersama',
            'slug' => Str::slug('Gotong Royong Bersama'),
            'description' => 'Kegiatan gotong royong membersihkan lingkungan Gampong Udeung.',
            'location' => 'Sepanjang Jalan Gampong Udeung',
            'start_time' => Carbon::now()->addDays(5)->setTime(8, 0, 0),
            'end_time' => Carbon::now()->addDays(5)->setTime(12, 0, 0),
            'image' => null,
        ]);

        Event::create([
            'title' => 'Pengajian Rutin Majelis Taklim',
            'slug' => Str::slug('Pengajian Rutin Majelis Taklim'),
            'description' => 'Pengajian bulanan Majelis Taklim Gampong Udeung.',
            'location' => 'Meunasah Gampong Udeung',
            'start_time' => Carbon::now()->addDays(10)->setTime(16, 0, 0),
            'end_time' => null,
            'image' => null,
        ]);
    }
}