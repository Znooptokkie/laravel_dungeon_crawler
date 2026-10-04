<?php

namespace Database\Seeders;

use App\Models\Door;
use App\Models\DoorsRooms;
use App\Models\DungeonLevel;
use App\Models\Room;
use App\Models\RoomsDungeonLevel;
use Illuminate\Database\Seeder;

class DungeonLevelSeeder extends Seeder
{
    public function run(): void
    {
        $this->firstDungeonLevel();
        $this->secondDungeonLevel();
    }

    public function firstDungeonLevel()
    {
        $dungeonLevel = DungeonLevel::create([
            'rooms_count' => 4,
        ]);

        $levelId = $dungeonLevel->dungeon_level_id;

        $firstRoom = Room::create([
            "chest_id" => null
        ]);

        RoomsDungeonLevel::create([
            "room_id" => $firstRoom->room_id,
            "dungeon_level_id" => $levelId
        ]);

        $secondRoom = Room::create([
            "chest_id" => null
        ]);

        RoomsDungeonLevel::create([
            "room_id" => $secondRoom->room_id,
            "dungeon_level_id" => $levelId
        ]);

        $thirdRoom = Room::create([
            "chest_id" => null
        ]);

        RoomsDungeonLevel::create([
            "room_id" => $thirdRoom->room_id,
            "dungeon_level_id" => $levelId
        ]);

        $fourthRoom = Room::create([
            "chest_id" => null
        ]);

        RoomsDungeonLevel::create([
            "room_id" => $fourthRoom->room_id,
            "dungeon_level_id" => $levelId
        ]);

        $fifthRoom = Room::create([
            "chest_id" => null
        ]);

        RoomsDungeonLevel::create([
            "room_id" => $fifthRoom->room_id,
            "dungeon_level_id" => $levelId
        ]);

        $sixthRoom = Room::create([
            "chest_id" => null
        ]);

        RoomsDungeonLevel::create([
            "room_id" => $sixthRoom->room_id,
            "dungeon_level_id" => $levelId
        ]);

        $firstDoor = Door::create([
            "is_locked" => false,
            "key_id" => null
        ]);

        $secondDoor = Door::create([
            "is_locked" => false,
            "key_id" => null
        ]);

        $thirdDoor = Door::create([
            "is_locked" => false,
            "key_id" => null
        ]);

        $fourthDoor = Door::create([
            "is_locked" => false,
            "key_id" => null
        ]);

        $fifthDoor = Door::create([
            "is_locked" => false,
            "key_id" => null
        ]);

        // Room 1 > Room 2
        DoorsRooms::create([
            "door_id" => $firstDoor->door_id,
            "room_id" => $firstRoom->room_id,
            "door_side" => "right"
        ]);

        // Room 2 > Room 1
        DoorsRooms::create([
            "door_id" => $firstDoor->door_id,
            "room_id" => $secondRoom->room_id,
            "door_side" => "back"
        ]);

        // Room 2 > Room 3
        DoorsRooms::create([
            "door_id" => $secondDoor->door_id,
            "room_id" => $secondRoom->room_id,
            "door_side" => "left"
        ]);

        // Room 3 > Room 2
        DoorsRooms::create([
            "door_id" => $secondDoor->door_id,
            "room_id" => $thirdRoom->room_id,
            "door_side" => "back"
        ]);

        // Room 3 > Room 4
        DoorsRooms::create([
            "door_id" => $thirdDoor->door_id,
            "room_id" => $thirdRoom->room_id,
            "door_side" => "front"
        ]);

        // Room 4 > Room 3
        DoorsRooms::create([
            "door_id" => $thirdDoor->door_id,
            "room_id" => $fourthRoom->room_id,
            "door_side" => "back"
        ]);

        // Room 1 > Room 5
        DoorsRooms::create([
            "door_id" => $fourthDoor->door_id,
            "room_id" => $firstRoom->room_id,
            "door_side" => "front"
        ]);

        // Room 5 > Room 1
        DoorsRooms::create([
            "door_id" => $fourthDoor->door_id,
            "room_id" => $fifthRoom->room_id,
            "door_side" => "back"
        ]);

        // Room 5 > Room 6
        DoorsRooms::create([
            "door_id" => $fifthDoor->door_id,
            "room_id" => $fifthRoom->room_id,
            "door_side" => "left"
        ]);

        // Room 6 > Room 5
        DoorsRooms::create([
            "door_id" => $fifthDoor->door_id,
            "room_id" => $sixthRoom->room_id,
            "door_side" => "back"
        ]);
    }

    public function secondDungeonLevel()
    {
        $dungeonLevel = DungeonLevel::create([
            'rooms_count' => 4,
        ]);

        for ($i = 0; $i < 4; $i++)
        {
            $room = Room::create([
                'chest_id' => null,
            ]);

            RoomsDungeonLevel::create([
                'room_id' => $room->room_id,
                'dungeon_level_id' => $dungeonLevel->dungeon_level_id,
            ]);
        }
    }
}
