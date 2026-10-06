<?php

namespace App\Http\Controllers;

use App\Models\Armor;
use App\Models\DoorsRooms;
use App\Models\DungeonLevel;
use App\Models\EnemiesRoom;
use App\Models\Enemy;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Item;
use App\Models\Key;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Player;
use App\Models\Potion;
use App\Models\Room;
use App\Models\RoomsDungeonLevel;
use App\Models\Weapon;
use App\Models\Food;
use App\Services\InventoryService;

class DungeonController extends Controller
{
    public function __construct(
        private InventoryService $inventoryService
    ) {}

    public function index()
    {
        $player = $this->getPlayer();

        $dungeonLevelNumber = $player->at_dungeon_level;

        $roomId = session("room");

        if ($roomId === null)
        {
            $roomId = RoomsDungeonLevel::where(
                "dungeon_level_id",
                $dungeonLevelNumber
            )->value("room_id");

            session(["room" => $roomId]);
        }

        $room = Room::find($roomId);

        $playerProperties = [
            "playerName" => $player->name,
            "dungeonLevel" => $dungeonLevelNumber,
            "doors" => $room->doors
        ];

        $inputProperties = [
            "lastInput" => session("last_input", ""),
            "message" => session("message", ""),
            "messageID" => session("message_id", 0)
        ];

        $statsProperties = [
            "combatLevel" => $player->combat_level,
            "hitpoints" => $player->hitpoints,
            "magic" => $player->magic,
            "stamina" => $player->stamina,
            "attack" => $player->attack,
            "defence" => $player->defence,
            "lockpicking" => $player->lockpicking,
            "pointsLeft" => $player->points_left
        ];

        $miniMapProperties = [
            "roomInfo" => $this->defineRoomsForMap(),
            "direction" => session("direction"),
            "room" => $room,
        ];

        $inventoryItems = $this->getInventoryItems();

        $inventoryProperties = [
            "inventoryItems" => $inventoryItems,
        ];

        return Inertia::render("Dungeon/Play", array_merge(
            $playerProperties,
            $inputProperties,
            $statsProperties,
            $miniMapProperties,
            $inventoryProperties
        ));
    }

    public function incrementMessageID()
    {
        return session("message_id", 0) + 1;
    }

    public function input(Request $request)
    {
        $validated = $request->validate([
            "input" => "required|string|max:100"
        ]);

        $input = strtolower($validated["input"]);

        // Teken de minimap
        $this->defineMapDirection($input);

        if
        (
            $input === "left" ||
            $input === "right" ||
            $input === "front" ||
            $input === "back"
        )
        {
            return $this->move($input);
        }
        else if (str_contains($input, "reset"))
        {
            return $this->reset();
        }
        if (str_starts_with($input, "use "))
        {
            $item = substr($input, 4);

            return $this->inventoryService->use($item);
        }
        else
        {
            $message = 'Invalid command! Try "help".';
            $messageID = $this->incrementMessageID();

            session([
                "message" => $message,
                "message_id" => $messageID
            ]);
        }

        return redirect()->route("dungeon.play");
    }

    public function move(String $input)
    {
        $currentRoomId = session("room");
        $currentRoom = Room::find($currentRoomId);

        $door = $currentRoom->doors()
            ->wherePivot("door_side", $input)
            ->first();

        if ($door === null)
        {
            $message = "There is no door on that side.";
            $messageID = $this->incrementMessageID();

            session([
                "message" => $message,
                "message_id" => $messageID
            ]);

            return redirect()->route("dungeon.play");
        }

        if ($door->is_locked)
        {
            $message = "The door is locked.";
            $messageID = $this->incrementMessageID();

            session([
                "message" => $message,
                "message_id" => $messageID
            ]);

            return redirect()->route("dungeon.play");
        }

        $nextRoom = $door->rooms()
            ->where("rooms.room_id", "!=", $currentRoomId)
            ->first();

        if ($nextRoom === null)
        {
            $message = "This door does not lead anywhere.";
            $messageID = $this->incrementMessageID();

            session([
                "message" => $message,
                "message_id" => $messageID
            ]);

            return redirect()->route("dungeon.play");
        }

        // Geeft aan wat er allemaal in de kamer zit
        $message = $this->theMessages($nextRoom);

        $messageID = $this->incrementMessageID();

        session([
            "room" => $nextRoom->room_id,
            "last_input" => $input,
            "message" => $message,
            "message_id" => $messageID,
        ]);

        return redirect()->route("dungeon.play");
    }

    public function theMessages(Room $nextRoom)
    {
        $availableDoors = $nextRoom->doors()->wherePivot("door_side", "!=",  "back")->get();
        $enemyIDs = EnemiesRoom::where("room_id", $nextRoom->room_id)->pluck("enemy_id");
        $availableEnemies = Enemy::whereIn("enemy_id", $enemyIDs)->get();
        // dd($availableEnemies);

        $message = "You go through the door. ";

        if ($availableDoors->isNotEmpty())
        {
            // $message = "Available doors: ";

            foreach ($availableDoors as $door)
            {
                $message .= "Available doors: " . $door->pivot->door_side . ", ";
            }
        }

        if ($availableEnemies->isNotEmpty())
        {
            foreach ($availableEnemies as $enemy)
            {
                $message .= "There is an enemy: " . $enemy->enemy_name;
            }
        }

        if ($availableDoors->isEmpty() && $availableEnemies->isEmpty())
        {
            $message = "You go through the door. There is nothing interesting in this room.";
        }

        return $message;
    }

    public function defineMapDirection(String $input)
    {
        // Logica voor de minimap om de driehoek te tekenen
        // welke richting de speler naartoe kijkt
        $currentDirection = session("direction");
        $directionHistory = session("direction_history", []);

        if ($currentDirection == null)
        {
            $currentDirection = 0;
        }

        $newDirection = $currentDirection;

        if ($input == "front")
        {
            $newDirection = $currentDirection;
            $directionHistory[] = $currentDirection;
        }
        else if ($input == "right")
        {
            $newDirection = ($currentDirection + 1) % 4;
            $directionHistory[] = $currentDirection;
        }
        else if ($input == "left")
        {
            $newDirection = ($currentDirection - 1 + 4) % 4;
            $directionHistory[] = $currentDirection;
        }
        else if ($input == "back")
        {
            if (!empty($directionHistory))
            {
                $newDirection = array_pop($directionHistory);
            }
        }

        session([
            "direction" => $newDirection,
            "direction_history" => $directionHistory,
        ]);
    }

    public function getInventoryItems()
    {
        $player = $this->getPlayer();
        $getInventoryID = Inventory::where("player_id", $player->player_id)->first();
        $inventoryItems = InventoryItem::where("inventory_id", $getInventoryID->inventory_id)->get();

        $allInventoryItems = [];
        $classValues = [
            "key" => Key::class,
            "potion" => Potion::class,
            "weapon" => Weapon::class,
            "armor" => Armor::class,
            "food" => Food::class,
        ];

        foreach ($inventoryItems as $item)
        {
            $itemID = $item->item_id;
            $getItemType = Item::find($itemID);
            $getItem = $classValues[$getItemType->type]::where("item_id", $itemID)->first();

            if ($getItemType->type == "food" || $getItemType->type == "potion")
            {
                $itemQuantity = $item->quantity;
            }
            else
            {
                $itemQuantity = 0;
            };

            $allInventoryItems[] = [
                "itemName" => $getItem->name,
                "slot" => $item->slot,
                "quantity" => $itemQuantity,
                "icon_url" => $getItem->icon_url,
            ];
        };

        return $allInventoryItems;
    }

    public function reset()
    {
        $message = "You reset the game. Let's hope it was the correct decision!";
        $messageID = $this->incrementMessageID();

        session()->forget([
            "room",
            "last_input",
            "message",
            "message_id",
            "direction",
            "direction_history"
        ]);

        session([
            "message" => $message,
            "message_id" => $messageID
        ]);

        return redirect()->route("dungeon.play");
    }

    public function getPlayer()
    {
        return Player::find(session("player_id"));
    }

    public function getRoomInfo()
    {
        return DoorsRooms::select([
            "door_id",
            "room_id",
            "door_side"
        ])->get();
    }

    public function defineRoomsForMap()
    {
        $player = $this->getPlayer();
        $dungeonLevel = $player->at_dungeon_level;

        $getRoomInfo = $this->getRoomInfo();

        return $getRoomInfo;
    }
}
