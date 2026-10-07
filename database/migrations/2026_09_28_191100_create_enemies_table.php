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
        Schema::create('enemies', function (Blueprint $table) {
            $table->id("enemy_id");
            $table->string("enemy_name");
            $table->string("combat_level")->default(1);
            $table->integer("hitpoints")->default(10);
            $table->integer("armor")->default(1);
            $table->integer("attack")->default(1);
            $table->boolean("is_boss")->default(false);
            $table->boolean("is_aggressive")->default(false);
            $table->string("icon_url")->default("");

            $table->unsignedBigInteger("enemy_special_attack_id")->nullable();
            $table->foreign("enemy_special_attack_id")->references("enemy_special_attack_id")->on("enemy_special_attacks")->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enemies');
    }
};
