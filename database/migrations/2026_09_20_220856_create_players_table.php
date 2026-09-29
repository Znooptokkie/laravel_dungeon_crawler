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
        Schema::create('players', function (Blueprint $table) {
            // $table->integer("player_id")->primary();
            $table->id("player_id");
            $table->string("name");
            $table->integer("combat_level")->default(1);
            $table->integer("hitpoints")->default(1);
            $table->integer("magic")->default(1);
            $table->integer("stamina")->default(1);
            $table->integer("attack")->default(1);
            $table->integer("defence")->default(1);
            $table->integer("lockpicking")->default(1);
            $table->integer("points_left")->default(0);
            $table->integer("at_dungeon_level")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
