<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stop_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('format_id')->index();
            $table->unsignedBigInteger('reasons_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('reasons');
            $table->string('date');
            $table->string('todate');
            $table->longText('description');
            $table->timestamps();

            $table->foreign('format_id')->references('id')->on('formats')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('reasons_id')->references('id')->on('reasons_to_stops')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stop_devices');
    }
}
