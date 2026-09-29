<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class Armor extends Model
{
    protected $primaryKey = "armor_id";
    protected $keyType = "int";

    protected $fillable = [
        "armor_name",
        "armor_added",
        "armor_part",
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
