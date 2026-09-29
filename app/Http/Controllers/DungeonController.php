<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Player;

class DungeonController extends Controller
{
    public function index()
    {
        $player = Player::find(session("player_id"));

        return Inertia::render('Dungeon/Play', [
            "playerName" => $player->name,
            'room' => session('room', 1),
            'lastInput' => session('last_input', ''),
            'message' => session('message', 'Welcome adventurer ' . $player->name . '.'),
            "messageID" => session("message_id", 0)
        ]);
    }

    public function incrementMessageID()
    {
        return session("message_id", 0) + 1;
    }

    public function input(Request $request)
    {
        $validated = $request->validate(['input' => 'required|string|max:100']);
        $input = strtolower($validated['input']);

        if (str_contains($input, 'left') || str_contains($input, 'right'))
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

            session(["message" => $message]);
            session(["message_id" => $messageID]);
        }

        return redirect()->route('dungeon.play');
    }

    public function move(String $input)
    {
        $room = session('room', 1);
        $room++;

        $message = "You go to the next room.";
        $messageID = $this->incrementMessageID();

        session(['room' => $room]);
        session(["last_input" => $input]);
        session(['message' => $message]);
        session(["message_id" => $messageID]);

        return redirect()->route('dungeon.play');
    }

    public function reset()
    {
        $message = "You reset the game. Let's hope it was the correct decision!";
        $messageID = $this->incrementMessageID();

        session()->forget([
            'room',
            'last_input',
            'message',
            'message_id',
        ]);

        session(["message" => $message]);
        session(["message_id" => $messageID]);

        return redirect()->route('dungeon.play');
    }
}
