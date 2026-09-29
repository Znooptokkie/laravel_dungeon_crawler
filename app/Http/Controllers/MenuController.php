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

    public function newGame()
    {
        
    }

    public function continueGame()
    {
        $player = Player::first();

        return Inertia::render("/Dungeon/Play", [
            "playerName" => $player->name,
        ]);
    }
}
