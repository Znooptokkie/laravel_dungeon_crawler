<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\DungeonController;
use Illuminate\Support\Facades\Route;

Route::get("/", [MenuController::class, "home"])->name("menu.home");
Route::get('/dungeon', [DungeonController::class, 'index'])->name('dungeon.play');
// Zorg dat er bewogen kan worden
// Route::post('/dungeon/move', [DungeonController::class, 'move'])->name('dungeon.move');
// Route::post("/dungeon/reset", [DungeonController::class, "reset"])->name("dungeon.reset");
Route::post("/dungeon/input", [DungeonController::class, "input"])->name("dungeon.input");