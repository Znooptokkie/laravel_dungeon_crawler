<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\EnemySpecialAttacks;

class Enemy extends Model
{
    protected $primaryKey = "enemy_id";
    protected $keyType = "int";

    protected $fillable = [
        "enemy_name",
        "combat_level",
        "hitpoints",
        "armor",
        "attack",
        "is_boss",
        "is_aggressive",
        "enemy_special_attack"
    ];

    public function EnemySpecialAttack()
    {
        return $this->belongsTo(EnemySpecialAttacks::class, "enemy_special_attack_id", "enemy_special_attack_id");
    }
}
