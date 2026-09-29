<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class Potion extends Model
{
    protected $primaryKey = "potion_id";
    protected $keyType = "int";

    protected $fillable = [
        "potion_name",
        "health_restored",
        "magic_restored",
        "stamina_restored",
        "item_id",
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, "item_id", "item_id");
    }
}
