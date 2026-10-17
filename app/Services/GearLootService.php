<?php

namespace App\Services;

use App\Support\ItemType;

class GearLootService
{
    public function gearRarityDepensOnRoom()
    {
        // NOTE!:MOETEN DUNGEON LEVELS ZIJN, GEEN ROOM!@#$

        // Een random nummer onder de 73 is voor common items only
        // Dus eerste 5 rooms kunnen alleen maar common items droppen
        // Daarna kan alles gerolled worden
        $roomID = session(["room_id"]);
        $canOnlyGetRarity = 0;

        if ($roomID <= 5)
            $canOnlyGetRarity = 73;
        else
            $canOnlyGetRarity = 100;

        return $canOnlyGetRarity;
    }

    public function defineGearRarity()
    {
        $getRarityWhicheverRoom = $this->gearRarityDepensOnRoom();
        $roll = rand(1, $getRarityWhicheverRoom);

        if ($roll > 98)
        {
            return "legendary";
        }
        else if ($roll > 88)
        {
            return "epic";
        }
        else if ($roll > 73)
        {
            return "rare";
        }
        else
        {
            return "common";
        }
    }

    public function getGear()
    {
        $rollWhichItem = rand(1, 4);
        $rarity = $this->defineGearRarity();
        $whichItemPiece = null;
        $whichID = "";
        $itemArray = [];

        if ($rollWhichItem == 1)
        {
            $whichItemPiece = ItemType::MODELS["weapon"];
            $whichID = "weapon_id";
        }
        else
        {
            $whichItemPiece = ItemType::MODELS["armor"];
            $whichID = "armor_id";
        }

        $allItems = $whichItemPiece::select($whichID)->where("rarity", $rarity)->get();

        foreach ($allItems as $item)
        {
            $itemArray[] = $item;
        }

        $itemArrayLength = count($itemArray);
        $randomItemIndex = rand(0, ($itemArrayLength - 1));

        $itemID = $itemArray[$randomItemIndex];
        $item = $whichItemPiece::find($itemID)->first();
        $gear = [
            "quantity"  => 1,
            "item"      => $item
        ];

        return $gear;
    }
}
