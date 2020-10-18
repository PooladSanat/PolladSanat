<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('characteristics_id')->index();
            $table->unsignedBigInteger('commodity_id')->index();
            $table->bigInteger('code')->unique()->index();
            $table->string('name');
            $table->string('label');
            $table->integer('manufacturing');
            $table->timestamps();


            $table->foreign('characteristics_id')
                ->references('id')
                ->on('product_characteristics')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('commodity_id')
                ->references('id')
                ->on('commodities')
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
        Schema::dropIfExists('products');
    }
}
