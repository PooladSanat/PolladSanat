<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductionPolyeric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_polyeric', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('production_id')->index();
            $table->unsignedBigInteger('polymeric_id')->index();
            $table->string('percentage');


            $table->timestamps();

            $table->foreign('production_id')
                ->references('id')
                ->on('production_orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('polymeric_id')
                ->references('id')
                ->on('polymerics')
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
        //
    }
}
