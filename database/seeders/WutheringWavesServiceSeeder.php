<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WutheringWavesServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Cari ID game Wuthering Waves (sesuaikan slug-nya dengan yang ada di database kamu)
        $game = Game::where('slug', 'wuthering-waves')->first();

        if (!$game) {
            $this->command->error('Game Wuthering Waves tidak ditemukan! Pastikan slug-nya "wuthering-waves".');
            return;
        }

        $services = [
            // EXPLORASI
            ['name' => 'Explorasi - Huanlong', 'price' => 170000, 'desc' => 'Eksplorasi penuh area Huanlong.'],
            ['name' => 'Explorasi - Black Shores', 'price' => 50000, 'desc' => 'Eksplorasi penuh area Black Shores.'],
            ['name' => 'Explorasi - Rinacita', 'price' => 160000, 'desc' => 'Eksplorasi penuh area Rinacita.'],
            ['name' => 'Explorasi - Septimont', 'price' => 80000, 'desc' => 'Eksplorasi penuh area Septimont.'],
            ['name' => 'Explorasi - Lahai-roi', 'price' => 160000, 'desc' => 'Eksplorasi penuh area Lahai-roi.'],
            ['name' => 'Explorasi - Frostland Surface', 'price' => 75000, 'desc' => 'Eksplorasi penuh area Frostland Surface.'],
            ['name' => 'Explorasi - Dimmrs Plain', 'price' => 80000, 'desc' => 'Eksplorasi penuh area Dimmrs Plain.'],

            // STORY
            ['name' => 'Main Story (Per Chapter)', 'price' => 10000, 'desc' => 'Note: Harga per chapter.'],
            ['name' => 'Companion Story', 'price' => 7000, 'desc' => 'Pengerjaan Companion Story.'],
            ['name' => 'Side Quest', 'price' => 5000, 'desc' => 'Pengerjaan Side Quest (harga menyesuaikan kesulitan, mulai dari Rp 5.000).'], // Harga estimasi

            // EVENT
            ['name' => 'Event Permanent', 'price' => 15000, 'desc' => 'Note: Harga menyesuaikan event (Rp 15.000 - Rp 30.000). Silakan konfirmasi ke admin.'],
        ];

        foreach ($services as $srv) {
            Service::create([
                'game_id'        => $game->id,
                'name'           => $srv['name'],
                'slug'           => Str::slug($srv['name']),
                'description'    => $srv['desc'],
                'price'          => $srv['price'],
                'is_daily'       => false,
                'duration_days'  => null,
                'estimated_days' => 'Tergantung tingkat kesulitan',
                'is_active'      => true,
                'sort_order'     => 0,
            ]);
        }

        $this->command->info('Berhasil menambahkan ' . count($services) . ' service Wuthering Waves.');
    }
}