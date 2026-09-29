<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Door;
use App\Models\Room;

class DoorsRooms extends Model
{
    protected $primaryKey = "doors_rooms_id";
    protected $keyType = "int";

    protected $fillable = [
        "door_id",
        "room_id"
    ];

    public function door()
    {
        return $this->belongsTo(Door::class, "door_id", "door_id");
    }

    public function room()
    {
        return $this->belongsTo(Room::class, "room_id", "room_id");
    }
}
