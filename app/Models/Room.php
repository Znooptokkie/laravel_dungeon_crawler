<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Chest;

class Room extends Model
{
    protected $primaryKey = "room_id";
    protected $keyType = "int";

    protected $fillable = [
        "chest_id"
    ];

    public function chest()
    {
        return $this->belongsTo(Chest::class, "chest_id", "chest_id");
    }

    public function doors()
    {
        return $this->belongsToMany(
            Door::class,
            "doors_rooms",
            "room_id",
            "door_id"
        )->withPivot("door_side");
    }
}
