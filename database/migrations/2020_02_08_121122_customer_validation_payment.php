<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerValidationPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_validation_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('Creditceiling')->nullable();
            $table->string('Openceiling')->nullable();
            $table->string('Yearcount')->nullable();
            $table->string('yearAgoCount')->nullable();
            $table->string('Yearturnover')->nullable();
            $table->string('lastYearturnover')->nullable();
            $table->string('Checkback')->nullable();
            $table->string('Checkbackintheflow')->nullable();
            $table->string('accountbalance')->nullable();
            $table->string('Averagetimedelay')->nullable();
            $table->string('Futurefactors')->nullable();
            $table->string('Receiveddocuments')->nullable();
            $table->string('Openaccountbalance')->nullable();
            $table->string('paymentmethod')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
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
