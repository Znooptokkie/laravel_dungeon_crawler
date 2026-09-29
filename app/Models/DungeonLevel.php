<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DungeonLevel extends Model
{
    protected $primaryKey = "dungeon_level_id";
    protected $keyType = "int";

    protected $fillable = [
        "rooms_count"
    ];
}
