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
            'name' => 'Dungeon Master',
            'combat_level' => 99,
            'hitpoints' => 10,
            'magic' => 1,
            'stamina' => 20,
            'attack' => 1,
            'defence' => 1,
            'lockpicking' => 1,
            'points_left' => 0,
            'at_dungeon_level' => 1,
        ]);
    }
}
