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
        Schema::create('enemy_special_attacks', function (Blueprint $table) {
            $table->id("enemy_special_attack_id");
            $table->string("special_attack_name");
            $table->string("attack_description");
            $table->integer("magic_drain");
            $table->integer("stamina_drain");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enemy_special_attacks');
    }
};
