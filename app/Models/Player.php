<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Inventory;

class Player extends Model
{
    protected $primaryKey = "player_id";
    protected $keyType = "int";

    protected $fillable = [
        "name",
        "combat_level",
        "hitpoints",
        "magic",
        "stamina",
        "attack",
        "defence",
        "lockpicking",
        "points_left",
        "at_dungeon_level"
    ];

    public function inventory()
    {
        return $this->hasOne(Inventory::class, "player_id", "player_id");
    }
}
