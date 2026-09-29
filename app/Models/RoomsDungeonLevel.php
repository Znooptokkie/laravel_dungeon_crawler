<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Room;
use App\Models\DungeonLevel;

class RoomsDungeonLevel extends Model
{
    protected $primaryKey = "rooms_dungeon_levels_id";
    protected $keyType = "int";

    protected $fillable = [
        "room_id",
        "dungeon_level_id"
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, "room_id", "room_id");
    }

    public function dungeon()
    {
        return $this->belongsTo(DungeonLevel::class, "dungeon_level_id", "dungeon_level_id");
    }
}
