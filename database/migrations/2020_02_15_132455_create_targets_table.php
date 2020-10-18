<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('year')->nullable();
            $table->string('farvardin')->nullable();
            $table->string('may')->nullable();
            $table->string('June')->nullable();
            $table->string('Arrows')->nullable();
            $table->string('August')->nullable();
            $table->string('September')->nullable();
            $table->string('stamp')->nullable();
            $table->string('Aban')->nullable();
            $table->string('Fire')->nullable();
            $table->string('January')->nullable();
            $table->string('Avalanche')->nullable();
            $table->string('March')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targets');
    }
}
