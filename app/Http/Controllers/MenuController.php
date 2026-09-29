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
            "player_id"=>$newPlayer->player_id
        ]);

        return redirect("/dungeon");
    }

    public function continueGame()
    {
        $player = Player::first();
        // $player = Player::find(session("player_id"));

        $message = "Welcome back " . $player->name . "!";
        $messageID = session("message_id", 0) + 1;

        session(["message" => $message]);
        session(["message_id" => $messageID]);

        return redirect()->route("dungeon.play");
    }
}
