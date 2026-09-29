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
        Schema::create('chest_items', function (Blueprint $table) {
            $table->id("chest_item_id");
            $table->integer("quantity");

            $table->unsignedBigInteger("chest_id");
            $table->foreign("chest_id")->references("chest_id")->on("chests")->onDelete("cascade");

            $table->unsignedBigInteger("item_id");
            $table->foreign("item_id")->references("item_id")->on("items")->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chest_items');
    }
};
