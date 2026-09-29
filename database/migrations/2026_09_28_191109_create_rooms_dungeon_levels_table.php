<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms_dungeon_levels', function (Blueprint $table) {
            $table->id("rooms_dungeon_levels_id");

            $table->unsignedBigInteger("room_id");
            $table->foreign("room_id")->references("room_id")->on("rooms")->onDelete("cascade");

            $table->unsignedBigInteger("dungeon_level_id");
            $table->foreign("dungeon_level_id")->references("dungeon_level_id")->on("dungeon_levels")->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_dungeon_levels');
    }
};
