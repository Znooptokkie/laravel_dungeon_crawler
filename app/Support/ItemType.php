<?php

namespace App\Support;

use App\Models\Key;
use App\Models\Food;
use App\Models\Potion;
use App\Models\Weapon;
use App\Models\Armor;

class ItemType
{
    public const MODELS = [
        "key"    => Key::class,
        "food"   => Food::class,
        "potion" => Potion::class,
        "weapon" => Weapon::class,
        "armor"  => Armor::class,
    ];
}
