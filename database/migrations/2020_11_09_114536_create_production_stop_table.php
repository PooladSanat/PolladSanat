<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionStopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_stop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('format_id');
            $table->string('date');
            $table->string('indate');
            $table->string('todate');
            $table->string('intime');
            $table->string('totime');
            $table->string('desstop');
            $table->string('description');
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
        Schema::dropIfExists('_production_stop');
    }
}
