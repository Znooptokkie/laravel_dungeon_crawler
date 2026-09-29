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
        Schema::create('weapon_special_attacks', function (Blueprint $table) {
            $table->id("weapon_special_attack_id");
            $table->string("special_attack_name_id");
            $table->string("attack_description");
            $table->integer("magic_cost")->default(0);
            $table->integer("stamina_cost")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapon_special_attacks');
    }
};
