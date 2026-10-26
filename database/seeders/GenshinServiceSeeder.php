<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenshinServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Cari ID game Genshin Impact
        $game = Game::where('slug', 'genshin-impact')->first();

        if (!$game) {
            $this->command->error('Game Genshin Impact tidak ditemukan!');
            return;
        }

        $services = [
            // EVENT
            ['name' => 'Event Summer', 'price' => 30000, 'desc' => 'Pengerjaan event summer lengkap.'],
            ['name' => 'Event Dangdut', 'price' => 10000, 'desc' => 'Pengerjaan event dangdut.'],

            // QUEST
            ['name' => 'Archon Quest (Per Act)', 'price' => 12000, 'desc' => 'Note: Harga per act.'],
            ['name' => 'World Quest', 'price' => 5000, 'desc' => 'Note: Harga menyesuaikan tingkat kesulitan (Rp 5.000 - Rp 40.000). Silakan konfirmasi ke admin via WA.'],
            ['name' => 'Story Quest (Per Bag)', 'price' => 7000, 'desc' => 'Note: Harga per bag.'],
            ['name' => 'Hangout Quest (Per Char)', 'price' => 10000, 'desc' => 'Note: Harga per karakter.'],

            // EXPLORASI
            ['name' => 'Explorasi - Mondstadt', 'price' => 80000, 'desc' => 'Eksplorasi penuh area Mondstadt.'],
            ['name' => 'Explorasi - Liyue', 'price' => 160000, 'desc' => 'Eksplorasi penuh area Liyue.'],
            ['name' => 'Explorasi - Inazuma', 'price' => 180000, 'desc' => 'Eksplorasi penuh area Inazuma.'],
            ['name' => 'Explorasi - Sumeru Forest', 'price' => 330000, 'desc' => 'Eksplorasi penuh area Sumeru Forest.'],
            ['name' => 'Explorasi - Sumeru Desert', 'price' => 400000, 'desc' => 'Eksplorasi penuh area Sumeru Desert.'],
            ['name' => 'Explorasi - Fontaine', 'price' => 330000, 'desc' => 'Eksplorasi penuh area Fontaine.'],
            ['name' => 'Explorasi - Natlan', 'price' => 400000, 'desc' => 'Eksplorasi penuh area Natlan.'],
            ['name' => 'Explorasi - Nodkrai 6.0', 'price' => 80000, 'desc' => 'Eksplorasi area Nodkrai 6.0.'],
            ['name' => 'Explorasi - Nodkrai 6.3', 'price' => 80000, 'desc' => 'Eksplorasi area Nodkrai 6.3.'],
            ['name' => 'Explorasi - Nodkrai 6.4', 'price' => 80000, 'desc' => 'Eksplorasi area Nodkrai 6.4.'],
            ['name' => 'Explorasi - Temple of Space', 'price' => 80000, 'desc' => 'Eksplorasi area Temple of Space.'],

            // AREA TERPISAH
            ['name' => 'Area - Dragonspine', 'price' => 60000, 'desc' => 'Eksplorasi penuh area Dragonspine.'],
            ['name' => 'Area - The Chasm', 'price' => 80000, 'desc' => 'Eksplorasi penuh area The Chasm.'],
            ['name' => 'Area - Enkanomiya', 'price' => 80000, 'desc' => 'Eksplorasi penuh area Enkanomiya.'],
            ['name' => 'Area - Chenyu Vale', 'price' => 120000, 'desc' => 'Eksplorasi penuh area Chenyu Vale.'],
            ['name' => 'Area - Sea of Bygone', 'price' => 80000, 'desc' => 'Eksplorasi penuh area Sea of Bygone.'],
            ['name' => 'Area - Ancient Secret Mountain', 'price' => 80000, 'desc' => 'Eksplorasi penuh area Ancient Secret Mountain.'],
            ['name' => 'Area - Eazybreeze Holiday Resort', 'price' => 80000, 'desc' => 'Eksplorasi penuh area Eazybreeze Holiday Resort.'],
        ];

        foreach ($services as $srv) {
            Service::create([
                'game_id'        => $game->id,
                'name'           => $srv['name'],
                'slug'           => Str::slug($srv['name']),
                'description'    => $srv['desc'],
                'price'          => $srv['price'],
                'is_daily'       => false, // Genshin di list ini tidak ada rawat akun harian
                'duration_days'  => null,
                'estimated_days' => 'Tergantung tingkat kesulitan',
                'is_active'      => true,
                'sort_order'     => 0,
            ]);
        }

        $this->command->info('Berhasil menambahkan ' . count($services) . ' service Genshin Impact.');
    }
}