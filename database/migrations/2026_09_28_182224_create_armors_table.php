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
        Schema::create('armors', function (Blueprint $table) {
            $table->id("armor_id");
            $table->string("name");
            $table->integer("armor_added")->default(0);
            $table->string("armor_part")->default("body");
            $table->integer("health_added")->default(0);
            $table->integer("magic_added")->default(0);
            $table->integer("stamina_added")->default(0);
            $table->string("icon_url")->default("");
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
        Schema::dropIfExists('armors');
    }
};
