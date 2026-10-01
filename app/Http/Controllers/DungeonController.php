<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Player;
use App\Models\Room;
use App\Models\RoomsDungeonLevel;

class DungeonController extends Controller
{
    public function index()
    {
        $player = Player::find(session("player_id"));

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
            "room" => $room,
            "doors" => $room->doors
        ];

        $inputProperties = [
            "lastInput" => session("last_input", ""),
            "message" => session("message", ""),
            "messageID" => session("message_id", 0)
        ];

        return Inertia::render("Dungeon/Play", array_merge(
            $playerProperties,
            $inputProperties
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

        if (
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

        $message = "You go through the door.";
        $messageID = $this->incrementMessageID();

        session([
            "room" => $nextRoom->room_id,
            "last_input" => $input,
            "message" => $message,
            "message_id" => $messageID
        ]);

        return redirect()->route("dungeon.play");
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
        ]);

        session([
            "message" => $message,
            "message_id" => $messageID
        ]);

        return redirect()->route("dungeon.play");
    }
}
