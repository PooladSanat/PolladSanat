<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferBarnsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_barns_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transfer_barns_id');
            $table->string('type_barn');
            $table->string('product');
            $table->string('color');
            $table->string('number');
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
        Schema::dropIfExists('_transfer__barns__detail');
    }
}
