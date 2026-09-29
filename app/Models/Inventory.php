<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $primaryKey = "inventory_id";
    protected $keyType = "int";

    protected $fillable = [
        "player_id"
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, "player_id", "player_id");
    }
}
