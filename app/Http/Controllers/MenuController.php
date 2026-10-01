<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Player;

class MenuController extends Controller
{
    public function home()
    {
        return Inertia::render("Menu/HomeScreen", []);
    }

    public function newGame(Request $request)
    {
        $validated = $request->validate([
            "username"=>["required", "string", "max:255"]
        ]);

        $newPlayer = Player::create([
            "name"=>$validated["username"]
        ]);

        session([
            "player_id" => $newPlayer->player_id,
            "message" => "Welcome adventurer " . $newPlayer->name . ".",
            "message_id" => 1
        ]);

        return redirect("/dungeon");
    }

    public function continueGame()
    {
        $player = Player::latest()->first();

        $message = "Welcome back " . $player->name . "!";
        $messageID = session("message_id", 0) + 1;

        session([
            "player_id" => $player->player_id,
            "message" => $message,
            "message_id" => $messageID
        ]);

        return redirect()->route("dungeon.play");
    }
}
