<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = "item_id";
    protected $keyType = "int";

    protected $fillable = [
        "type"
    ];
}
