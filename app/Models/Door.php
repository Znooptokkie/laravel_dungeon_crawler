<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Key;

class Door extends Model
{
    protected $primaryKey = "door_id";
    protected $keyType = "int";

    protected $fillable = [
        "is_locked",
        "key_id"
    ];

    public function key()
    {
        return $this->belongsTo(Key::class, "key_id", "key_id");
    }

    public function rooms()
    {
        return $this->belongsToMany(
            Room::class,
            "doors_rooms",
            "door_id",
            "room_id"
        );
    }
}
