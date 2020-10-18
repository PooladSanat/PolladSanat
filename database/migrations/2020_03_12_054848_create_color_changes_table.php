<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_changes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ofColor_id')->index();
            $table->unsignedBigInteger('toColor_id')->index();
            $table->string('time');
            $table->timestamps();

            $table->foreign('ofColor_id')->references('id')
                ->on('colors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('toColor_id')->references('id')
                ->on('colors')
                ->onDelete('cascade')
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
        Schema::dropIfExists('color_changes');
    }
}
