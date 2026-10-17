<?php

namespace App\Services;

use App\Support\ItemType;

use App\Models\Room;
use App\Models\Item;
use App\Models\ChestItem;
use App\Models\Chest;
use App\Models\InventoryItem;
use App\Models\Player;
use App\Models\Inventory;

class ChestService
{
    public function __construct(
        private MessageService $messageService
    )
    {}


    public function getChestItems()
    {
        $chest = $this->getChest();

        if ($chest === null) {
            return [];
        }

        $chestItems = ChestItem::where("chest_id", $chest->chest_id)->get();
        $itemsValues = [];

        foreach ($chestItems as $chestItem)
        {
            $itemID = $chestItem->item_id;
            $getItemType = Item::where("item_id", $itemID)->pluck("type")->first();
            $getItem = ItemType::MODELS[$getItemType]::where("item_id", $itemID)->first();

            $itemsValues[] = [
                "quantity" => $chestItem->quantity,
                "item"     => $getItem
            ];
        }

        return $itemsValues;
    }

    public function getChestID()
    {
        $roomID = session("room");

        return Room::where("room_id", $roomID)->pluck("chest_id")->first();
    }

    public function checkIfChest()
    {
        $chestID = $this->getChestID();

        if ($chestID == null)
        {
            $messages = [];
            $messages[] = [
                [
                    "text" => "There is no chest in this room!"
                ]
            ];
            $messageID = session("message_id", 0) + 1;

            session([
                "messages"     => $messages,
                "message_id"    => $messageID
            ]);

            return redirect()->route("dungeon.play");
        }
        else
        {
            $this->checkChestState();
        }
    }

    public function checkChestState()
    {
        $chestID    = $this->getChestID();
        $getChest   = Chest::find($chestID);

        if ($getChest->is_empty)
        {
            $messages = [];
            $messages[] = [
                [
                    "text" => "The chest is already empty!"
                ]
            ];
            $messageID = session("message_id", 0) + 1;

            session([
                "messages"     => $messages,
                "message_id"    => $messageID
            ]);
        }
        else
        {
            $this->checkValidLockpickingLevel();
        }
    }

    public function checkValidLockpickingLevel()
    {
        $chestID = $this->getChestID();
        $playerLockpickingLevel = Player::where("player_id", session("player_id"))->pluck("lockpicking")->first();
        $chestLockpickingLevel  = Chest::where("chest_id", $chestID)->pluck("lockpicking_level_req")->first();

        if ($playerLockpickingLevel >= $chestLockpickingLevel)
        {
            $this->openChest();
        }
        else
        {
            $messages = [];
            $messages[] = [
                [
                    "text" => "Your Lockpicking is not high enough!"
                ]
            ];
            $messageID = session("message_id", 0) + 1;

            session([
                "messages"     => $messages,
                "message_id"    => $messageID
            ]);

            return redirect()->route("dungeon.play");
        }
    }

    public function openChest()
    {
        $chestID = $this->getChestID();
        $chest      = Chest::find($chestID);
        $chest->is_open = true;
        $chest->save();

        $messages = [];
        $messages[] = [
            [
                "text" => "You open the chest!"
            ]
        ];
        $messageID = session("message_id", 0) + 1;

        session([
            "messages"          => $messages,
            "message_id"        => $messageID,
            "showChestPopup"    => true
        ]);

        return redirect()->route("dungeon.play");
    }

    public function closeChest()
    {
        session(["showChestPopup" => false]);

        $messages = [
            [
                "text" => "You close the chest."
            ]
        ];

        session([
            "messages" => $messages,
            "message_id" => session("message_id", 0) + 1
        ]);

        return redirect()->route("dungeon.play");
    }

    public function getChest()
    {
        return Room::where("room_id", session("room"))->whereNotNull("chest_id")->first();
    }

    public function takeItem(string $item)
    {
        $playerID = session("player_id");

        $getItems = $this->getChestItems();

        $inventoryID = Inventory::where("player_id", $playerID)->value("inventory_id");

        $inventoryItemsCount = InventoryItem::where("inventory_id", $inventoryID)->max("slot") ?? 0;

        foreach ($getItems as $stuff)
        {
            if (strtolower($stuff["item"]->name) != strtolower($item))
            {
                $this->messageService->createMessage([
                    [
                        "text" => "This item does not exist in this chest"
                    ]
                ]);
                continue;
            }

            $itemID = $stuff["item"]->item_id;

            $itemType = Item::where("item_id", $itemID)->value("type");

            $checkIfInInventory = InventoryItem::where("inventory_id", $inventoryID)->where("item_id", $itemID)->first();

            if (
                $checkIfInInventory !== null &&
                $itemType !== "weapon" &&
                $itemType !== "armor"
            )
            {
                $checkIfInInventory->quantity += $stuff["quantity"];
                $checkIfInInventory->save();
            }
            else
            {
                InventoryItem::create([
                    "slot"          => ++$inventoryItemsCount,
                    "quantity"      => $stuff["quantity"],
                    "inventory_id"  => $inventoryID,
                    "item_id"       => $itemID
                ]);
            }

            $this->removeChestItem($itemID);

            return redirect()->route("dungeon.play");
        }

        return redirect()->route("dungeon.play");
    }

    public function removeChestItem(int $itemID)
    {
        $chestID = $this->getChestID();

        ChestItem::where("chest_id", $chestID)->where("item_id", $itemID)->delete();

        if (!ChestItem::where("chest_id", $chestID)->exists())
        {
            $chest = Chest::find($chestID);
            $chest->is_empty = true;
            $chest->save();

             session(["showChestPopup" => false]);

             $this->messageService->createMessage([
                [
                    "text" => "The chest is now "
                ],
                [
                    "text" => "empty",
                    "bold" => true
                ]
             ]);
        }
    }
}
