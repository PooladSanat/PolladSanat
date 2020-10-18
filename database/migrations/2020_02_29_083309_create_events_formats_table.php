<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_formats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('format_id')->index();
            $table->string('time');
            $table->string('date');
            $table->string('shift');
            $table->longText('cause');
            $table->timestamps();
            $table->foreign('format_id')
                ->references('id')
                ->on('formats')
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
        Schema::dropIfExists('events_formats');
    }
}
