<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Inventory;
use App\Models\Item;

class InventoryItem extends Model
{
    protected $primaryKey = "inventory_item_id";
    protected $keyType = "int";

    protected $fillable = [
        "slot",
        "quantity",
        "inventory_id",
        "item_id"
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, "inventory_id", "inventory_id");
    }

    public function itemId()
    {
        return $this->belongsTo(Item::class, "item_id", "item_id");
    }
}
