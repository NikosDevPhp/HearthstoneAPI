<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cardId');
            $table->mediumInteger('dbfId');
            $table->string('name');
            $table->string('cardSet');
            $table->string('type');
            $table->string('rarity');
            $table->integer('cost');
            $table->integer('attack');
            $table->integer('health');
            $table->string('text');
            $table->string('flavor');
            $table->string('artist');
            $table->boolean('collectible');
            $table->string('playerClass');
            $table->string('multiClassGroup');
            $table->string('img');
            $table->string('imgGold');
            $table->string('locale');
            $table->string('race');
            $table->json('mechanics');
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
        Schema::dropIfExists('cards');
    }
}
