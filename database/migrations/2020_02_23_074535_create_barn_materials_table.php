<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarnMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barn_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('polymeric_id')->index();
            $table->string('PhysicalInventory')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('barn_materials');
    }
}
