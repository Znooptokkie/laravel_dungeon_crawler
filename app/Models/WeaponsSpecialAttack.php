<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Weapon;
use App\Models\WeaponSpecialAttack;

class WeaponsSpecialAttack extends Model
{
    protected $primaryKey = "weapons_special_attacks";
    protected $keyType = "int";

    protected $fillable = [
        "weapon_id",
        "weapon_special_attack_id"
    ];

    public function weapon()
    {
        return $this->belongsTo(Weapon::class, "weapon_id", "weapon_id");
    }

    public function weaponSpecialAttack()
    {
        return $this->belongsTo(WeaponSpecialAttack::class, "weapon_special_attack_id", "weapon_special_attack_id");
    }
}
