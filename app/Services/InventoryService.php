<?php

namespace App\Services;

use App\Models\Food;
use App\Models\InventoryItem;
use App\Models\Item;

class InventoryService
{
    public function use(string $item)
    {
        $getItem = Food::where("food_name", $item)->first();
        // dd($getItem);
        if (!$getItem)
        {
            $message = "The item does not exists!";
            $messageID = session("message_id", 0) + 1;

            session([
                "message" => $message,
                "message_id" => $messageID
            ]);

            return redirect()->route("dungeon.play");
        }

        $hasItem = InventoryItem::where("item_id", $getItem->item_id)->exists();

        if (!$hasItem)
        {
            $message = "The item " . $item . " is not in your inventory!";
            $messageID = session("message_id", 0) + 1;

            session([
                "message" => $message,
                "message_id" => $messageID
            ]);
        }
        else
        {
            // Wel in inventory
        }

        // dd($hasItem);
    }

    private function useItem()
    {

    }
}
