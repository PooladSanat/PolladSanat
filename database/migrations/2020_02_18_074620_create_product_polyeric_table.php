<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPolyericTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_polyeric', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('productTitle_id')->index();
            $table->unsignedBigInteger('polymeric_id')->index();
            $table->string('percentage');

            $table->foreign('productTitle_id')
                ->references('id')
                ->on('product_titles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('polymeric_id')
                ->references('id')
                ->on('polymerics')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('product_polyeric');
    }
}
