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
        Schema::create('enemies_rooms', function (Blueprint $table) {
            $table->id("enemies_room_id");

            $table->unsignedBigInteger("enemy_id");
            $table->foreign("enemy_id")->references("enemy_id")->on("enemies")->onDelete("cascade");

            $table->unsignedBigInteger("room_id");
            $table->foreign("room_id")->references("room_id")->on("rooms")->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enemies_rooms');
    }
};
