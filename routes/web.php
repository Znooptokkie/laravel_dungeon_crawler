<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\DungeonController;
use Illuminate\Support\Facades\Route;

// Menu page
Route::get("/", [MenuController::class, "home"])->name("menu.home");
// The page where the game is played
Route::get('/dungeon', [DungeonController::class, 'index'])->name('dungeon.play');
// Process the player input
Route::post("/dungeon/input", [DungeonController::class, "input"])->name("dungeon.input");

// Create new player only with an username
Route::post("/newPlayer", [MenuController::class, "newGame"])->name("menu.newGame");
// Continue game with last known user
Route::get("/continueGame", [MenuController::class, "continueGame"])->name("menu.continueGame");
