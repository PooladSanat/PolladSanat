<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('return_id');
            $table->string('statusone');
            $table->string('statustwo');
            $table->string('descriptionone');
            $table->string('descriptiontwo');
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
        Schema::dropIfExists('return_admin');
    }
}
