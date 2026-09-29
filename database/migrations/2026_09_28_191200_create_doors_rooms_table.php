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
        Schema::create('doors_rooms', function (Blueprint $table) {
            $table->id("doors_rooms_id");

            $table->unsignedBigInteger("door_id");
            $table->foreign("door_id")->references("door_id")->on("doors")->onDelete("cascade");

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
        Schema::dropIfExists('doors_rooms');
    }
};
