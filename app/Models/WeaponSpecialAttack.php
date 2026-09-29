<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaponSpecialAttack extends Model
{
    protected $primaryKey = "weapon_special_attack_id";
    protected $keyType = "int";

    protected $fillable = [
        "special_attack_name",
        "attack_description",
        "magic_cost",
        "stamina_cost",
    ];
}
