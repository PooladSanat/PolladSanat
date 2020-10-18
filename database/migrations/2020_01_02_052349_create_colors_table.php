<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('code')->unique()->index();
            $table->string('name');
            $table->string('manufacturer');
            $table->string('combination');
            $table->bigInteger('masterbatch');
            $table->string('price');
            $table->string('time');
            $table->string('minimum');
            $table->string('maximum');

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
        Schema::dropIfExists('colors');
    }
}
