<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class Food extends Model
{
    protected $primaryKey = "food_id";
    protected $keyType = "int";

    protected $fillable = [
        "name",
        "health_added",
        "magic_added",
        "stamina_added",
        "icon_url",
        "item_id"
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, "item_id", "item_id");
    }
}
