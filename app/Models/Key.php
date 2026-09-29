<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class Key extends Model
{
    protected $primaryKey = "key_id";
    protected $keyType = "int";

    protected $fillable = [
        "color",
        "item_id"
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, "item_id", "item_id");
    }
}
