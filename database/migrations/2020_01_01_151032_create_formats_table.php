<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('code')->unique()->index();
            $table->string('name');
            $table->unsignedBigInteger('model_id')->index();
            $table->bigInteger('quetta');
            $table->timestamps();

            $table->foreign('model_id')->references('id')
                ->on('models')
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
        Schema::dropIfExists('formats');
    }
}
