<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::create([
            'name' => 'Admin',
            'combat_level' => 1,
            'hitpoints' => 1,
            'magic' => 1,
            'stamina' => 1,
            'attack' => 1,
            'defence' => 1,
            'lockpicking' => 1,
            'points_left' => 0,
            'at_dungeon_level' => 1,
        ]);
    }
}
