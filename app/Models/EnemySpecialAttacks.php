<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnemySpecialAttacks extends Model
{
    protected $primaryKey = "enemy_special_attack_id";
    protected $keyType = "int";

    protected $fillable = [
        "special_attack_name",
        "attack_description",
        "magic_drain",
        "stamina_drain",
    ];
}
