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
        Schema::create('potions', function (Blueprint $table) {
            $table->id("potion_id");
            $table->string("potion_name");
            $table->integer("health_restored")->default(0);
            $table->integer("magic_restored")->default(0);
            $table->integer("stamina_restored")->default(0);

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
        Schema::dropIfExists('potions');
    }
};
