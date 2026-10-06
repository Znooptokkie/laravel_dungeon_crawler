<?php

namespace Database\Seeders;

use App\Models\EnemiesRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Enemy;
use App\Models\Room;

class EnemySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    }

    public function createGoblin(Room $room)
    {
        $goblin = Enemy::create([
            "enemy_name"                => "Goblin",
            "combat_level"              => 1,
            "hitpoints"                 => 10,
            "armor"                     => 1,
            "attack"                    => 1,
            "is_boss"                   => false,
            "is_aggressive"             => false,
            "enemy_special_attack_id"   => null
        ]);

        EnemiesRoom::create([
            "enemy_id"                  => $goblin->enemy_id,
            "room_id"                   => $room->room_id
        ]);
    }
}
