<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_photo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("game_id");
            $table->unsignedBigInteger("photo_id");
            $table->foreign("game_id")->references("id")->on("games")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("photo_id")->references("id")->on("photos")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_photo');
    }
};
