<?php

namespace App\Services;

use App\Support\ItemType;

class ConsumablesLootService
{
    public function defineWhichGrade()
    {
        $roomID = session(["room_id"]);
        // Voor elke 4 room levels gaat de grade 1 omhoog
        $consumableIndex = (int) floor($roomID / 4) + 1;

        return $consumableIndex;
    }

    public function getConsumable(string $whichConsumable)
    {
        $grade = $this->defineWhichGrade();

        if ($whichConsumable == "potion")
            $quantity = rand(1, 2);
        else
            $quantity = rand(1, 3);

        $getConsumable = ItemType::MODELS[$whichConsumable]::find($grade);

        $consumable = [
            "quantity"  => $quantity,
            "item"      => $getConsumable
        ];
        return $consumable;
    }
}
