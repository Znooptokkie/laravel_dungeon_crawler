<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chest extends Model
{
    protected $primaryKey = "chest_id";
    protected $keyType = "int";

    protected $fillable = [
        "lockpicking_level_req"
    ];
}
