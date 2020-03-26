<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('seller');
            $table->string('language');
            $table->float('price');
            $table->integer('quantity');
            $table->string('condition');
            $table->longText('comment');
            $table->boolean('fullArt');
            $table->boolean('foil');
            $table->boolean('signed');
            $table->boolean('uber');
            $table->boolean('playset');
            $table->string('src');
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
        Schema::dropIfExists('lcards');
    }
}
