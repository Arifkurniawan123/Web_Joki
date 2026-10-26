<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ZenlessZoneZeroServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Cari ID game Zenless Zone Zero
        $game = Game::where('slug', 'zenless-zone-zero')->first();

        if (!$game) {
            $this->command->error('Game Zenless Zone Zero tidak ditemukan!');
            return;
        }

        $services = [
            [
                'name' => 'Polycrome / Bahan Gacha (1600 Poly)', 
                'price' => 18000, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => '1 Hari',
                'desc' => 'Note: Starter, Midgame, Endgame akun.'
            ],
            [
                'name' => 'Joki Main Quest Story (Per Chapter)', 
                'price' => 15000, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => '1-2 Hari',
                'desc' => 'Note: Per chapter.'
            ],
            [
                'name' => 'Main Quest Tambahan (Jane Do, Yanagi, Astra Yao)', 
                'price' => 10000, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => '1 Hari',
                'desc' => 'Note: Untuk chapter Jane Do, Yanagi, dan Astra Yao saja.'
            ],
            [
                'name' => 'Joki Event Terdahulu', 
                'price' => 15000, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => '1-2 Hari',
                'desc' => 'Note: Untuk semua jenis event terdahulu dan all klaim poly saja.'
            ],
            [
                'name' => 'Joki Hollow Zero (Per Level)', 
                'price' => 1500, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => 'Tergantung Level',
                'desc' => 'Note: Harga per level.'
            ],
            [
                'name' => 'Build Char + W-engine', 
                'price' => 25000, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => '2-3 Hari',
                'desc' => 'Note: Tergantung sisa baterai + sudah include disk nya.'
            ],
            [
                'name' => 'Shiyu Defense', 
                'price' => 20000, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => '1-2 Hari',
                'desc' => 'Note: Tergantung char saat ini.'
            ],
            [
                'name' => 'Deadly Assault', 
                'price' => 20000, 
                'is_daily' => false, 
                'duration' => null, 
                'est' => '1-2 Hari',
                'desc' => 'Note: Tergantung char saat ini dan all klaim poly saja.'
            ],
        ];

        foreach ($services as $srv) {
            Service::create([
                'game_id'        => $game->id,
                'name'           => $srv['name'],
                'slug'           => Str::slug($srv['name']),
                'description'    => $srv['desc'], // Deskripsi diambil dari catatan
                'price'          => $srv['price'],
                'is_daily'       => $srv['is_daily'],
                'duration_days'  => $srv['duration'],
                'estimated_days' => $srv['est'],
                'is_active'      => true,
                'sort_order'     => 0,
            ]);
        }

        $this->command->info('Berhasil menambahkan ' . count($services) . ' service Zenless Zone Zero.');
    }
}