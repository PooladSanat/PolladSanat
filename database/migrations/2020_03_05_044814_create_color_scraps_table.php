<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorScrapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_scraps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('format_id')->index();
            $table->unsignedBigInteger('ofColor_id')->index();
            $table->unsignedBigInteger('toColor_id')->index();
            $table->string('usable');
            $table->string('unusable');
            $table->timestamps();
            $table->foreign('format_id')->references('id')
                ->on('formats')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('color_scraps');
    }
}
