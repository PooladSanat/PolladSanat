<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolymericsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polymerics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('code')->unique()->index();
            $table->string('type');
            $table->string('grid');
            $table->string('name');
            $table->string('price');
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('polymerics');
    }
}
