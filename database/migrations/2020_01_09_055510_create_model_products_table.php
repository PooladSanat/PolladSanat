<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('format_id')->index();
            $table->unsignedBigInteger('insert_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->string('size');
            $table->string('cycletime');
            $table->timestamps();

            $table->foreign('format_id')
                ->references('id')
                ->on('formats')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('insert_id')
                ->references('id')
                ->on('inserts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('model_products');
    }
}
