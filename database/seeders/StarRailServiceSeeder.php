<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StarRailServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Cari ID game Honkai Star Rail
        $game = Game::where('slug', 'honkai-star-rail')->first();

        if (!$game) {
            $this->command->error('Game Honkai Star Rail tidak ditemukan!');
            return;
        }

        $services = [
            // STORY & QUEST
            ['name' => 'Story 4.5', 'price' => 10000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => '1 Event Terbaru', 'price' => 12000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => 'Main Story - Stasiun Herta', 'price' => 10000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => 'Main Story - Jarilo-VI', 'price' => 20000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => 'Main Story - Luofu', 'price' => 30000, 'is_daily' => false, 'duration' => null, 'est' => '1-2 Hari'],
            ['name' => 'Main Story - Penacony', 'price' => 60000, 'is_daily' => false, 'duration' => null, 'est' => '2-3 Hari'],
            ['name' => 'Main Story - Amphoreus', 'price' => 80000, 'is_daily' => false, 'duration' => null, 'est' => '3-4 Hari'],
            ['name' => 'Main Story - Planacardia', 'price' => 35000, 'is_daily' => false, 'duration' => null, 'est' => '1-2 Hari'],
            
            ['name' => 'Side Quest - Biru Biasa', 'price' => 4000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => 'Side Quest - Ungu', 'price' => 6000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => 'Side Quest - Orange', 'price' => 10000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],

            // EXPLORE CHEST
            ['name' => 'Explore Chest - Stasiun Herta', 'price' => 10000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => 'Explore Chest - Jarilo-VI', 'price' => 20000, 'is_daily' => false, 'duration' => null, 'est' => '1 Hari'],
            ['name' => 'Explore Chest - Luofu', 'price' => 30000, 'is_daily' => false, 'duration' => null, 'est' => '1-2 Hari'],
            ['name' => 'Explore Chest - Penacony', 'price' => 60000, 'is_daily' => false, 'duration' => null, 'est' => '2-3 Hari'],
            ['name' => 'Explore Chest - Amphoreus', 'price' => 80000, 'is_daily' => false, 'duration' => null, 'est' => '3-4 Hari'],
            ['name' => 'Explore Chest - Planacardia', 'price' => 80000, 'is_daily' => false, 'duration' => null, 'est' => '3-4 Hari'],

            // RAWAT AKUN (HARIAN)
            ['name' => 'Rawat Akun - Perminggu', 'price' => 15000, 'is_daily' => true, 'duration' => 7, 'est' => '7 Hari'],
            ['name' => 'Rawat Akun - Perbulan', 'price' => 80000, 'is_daily' => true, 'duration' => 30, 'est' => '30 Hari'],
            ['name' => 'Rawat Akun - Per Patch', 'price' => 120000, 'is_daily' => true, 'duration' => 42, 'est' => '42 Hari'],

            // JOKI LAINNYA
            ['name' => 'Divergent Universe (Per Level)', 'price' => 1000, 'is_daily' => false, 'duration' => null, 'est' => 'Tergantung Level'],
            ['name' => 'Simulated Universe: Swarm', 'price' => 60000, 'is_daily' => false, 'duration' => null, 'est' => '2-3 Hari'],
            ['name' => 'Simulated Universe: Gold & Gears', 'price' => 80000, 'is_daily' => false, 'duration' => null, 'est' => '3-4 Hari'],
            ['name' => 'Ruang Rahasia Herta', 'price' => 60000, 'is_daily' => false, 'duration' => null, 'est' => '2-3 Hari'],
            ['name' => 'Event Nostalgia', 'price' => 10000, 'is_daily' => false, 'duration' => null, 'est' => '1-2 Hari'],
        ];

        foreach ($services as $srv) {
            Service::create([
                'game_id'        => $game->id,
                'name'           => $srv['name'],
                'slug'           => Str::slug($srv['name']),
                'description'    => 'Layanan joki ' . $srv['name'] . ' untuk Honkai Star Rail.',
                'price'          => $srv['price'],
                'is_daily'       => $srv['is_daily'],
                'duration_days'  => $srv['duration'],
                'estimated_days' => $srv['est'],
                'is_active'      => true,
                'sort_order'     => 0,
            ]);
        }

        $this->command->info('Berhasil menambahkan ' . count($services) . ' service Honkai Star Rail.');
    }
}