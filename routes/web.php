<?php

use App\Http\Controllers\DungeonController;
use Illuminate\Support\Facades\Route;

// Toon de "room"
Route::get('/dungeon', [DungeonController::class, 'index'])->name('dungeon.play');
// Zorg dat er bewogen kan worden
Route::post('/dungeon/move', [DungeonController::class, 'move'])->name('dungeon.move');