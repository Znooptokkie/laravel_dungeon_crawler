<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Chest;
use App\Models\Item;

class ChestItem extends Model
{
    protected $primaryKey = "chest_item_id";
    protected $keyType = "int";

    protected $fillable = [
        "quantity",
        "chest_id",
        "item_id"
    ];

    public function chest()
    {
        return $this->belongsTo(Chest::class, "chest_id", "chest_id");
    }

    public function item()
    {
        return $this->belongsTo(Item::class, "item_id", "item_id");
    }
}
