<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarnTemporariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barn_temporaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('device_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('color_id')->index();
            $table->string('date');
            $table->string('number');
            $table->timestamps();
            $table->foreign('device_id')->references('id')
                ->on('devices')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('color_id')->references('id')
                ->on('colors')->onDelete('cascade')
                ->onUpdate('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barn_temporaries');
    }
}
