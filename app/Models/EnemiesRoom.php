<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Enemy;
use App\Models\Room;

class EnemiesRoom extends Model
{
    protected $primaryKey = "enemies_room_id";
    protected $keyType = "int";

    protected $fillable = [
        "enemy_id",
        "room_id"
    ];

    public function enemy()
    {
        return $this->belongsTo(Enemy::class, "enemy_id", "enemy_id");
    }

    public function room()
    {
        return $this->belongsTo(Room::class, "room_id", "room_id");
    }
}
