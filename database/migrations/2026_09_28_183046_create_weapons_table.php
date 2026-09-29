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
        Schema::create('weapons', function (Blueprint $table) {
            $table->id("weapon_id");
            $table->string("armor_name");
            $table->integer("armor_added")->default(0);
            $table->string("armor_part");
            $table->integer("health_added");
            $table->integer("magic_added");
            $table->integer("stamina_added");

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
        Schema::dropIfExists('weapons');
    }
};
