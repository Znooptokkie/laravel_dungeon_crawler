<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class Weapon extends Model
{
    protected $primaryKey = "weapon_id";
    protected $keyType = "int";

    protected $fillable = [
        "weapon_name",
        "health_added",
        "magic_added",
        "stamina_added",
        "item_id"
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, "item_id", "item_id");
    }
}
