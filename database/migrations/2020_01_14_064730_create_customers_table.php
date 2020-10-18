<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('code')->index()->unique();
            $table->string('name');
            $table->string('state');
            $table->longText('method');
            $table->string('date');
            $table->string('expert');
            $table->string('type');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('customer_company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->bigInteger('code_company')->index()->nullable();
            $table->string('Established_company')->nullable();
            $table->bigInteger('tel_company');
            $table->bigInteger('fax_company')->nullable();
            $table->bigInteger('phone_company')->nullable();
            $table->longText('adders_company')->nullable();
            $table->longText('home')->nullable();
            $table->string('post_company')->nullable();
            $table->string('email_company')->nullable();
            $table->string('national_company')->nullable();
            $table->string('date_birth')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::create('customer_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->string('name_work_company')->nullable();
            $table->string('date_work_company')->nullable();
            $table->string('tel_work_company')->nullable();
            $table->string('fax_work_company')->nullable();
            $table->string('panel_work_company')->nullable();
            $table->string('dimensions_work_company')->nullable();
            $table->string('post_work_company')->nullable();
            $table->string('telstore_work_company')->nullable();
            $table->string('status_work_company')->nullable();
            $table->string('type_work_company')->nullable();
            $table->string('owner_work_company')->nullable();
            $table->string('dec_work_company')->nullable();
            $table->string('license_work_company')->nullable();
            $table->string('numlicense_work_company')->nullable();
            $table->string('credibilitylicense_work_company')->nullable();
            $table->string('store_work_company')->nullable();
            $table->string('dimensionsstore_work_company')->nullable();
            $table->longText('activity_work_company')->nullable();
            $table->longText('oactivity_work_company')->nullable();
            $table->longText('addersstore_work_company')->nullable();

            $table->timestamps();
            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::create('customer_bank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->string('name_bank_company')->nullable();
            $table->string('branch_bank_company')->nullable();
            $table->string('account_bank_company')->nullable();
            $table->string('date_bank_company')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::create('customer_securing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->string('name_securing_company')->nullable();
            $table->string('date_securing_company')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::create('customer_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->string('certificate_documents_company')->nullable();
            $table->string('cart_documents_company')->nullable();
            $table->string('activity_documents_company')->nullable();
            $table->string('store_documents_company')->nullable();
            $table->string('ownership_documents_company')->nullable();
            $table->string('established_documents_company')->nullable();
            $table->string('sstore_documents_company')->nullable();
            $table->string('pstore_documents_company')->nullable();
            $table->string('final_documents_company')->nullable();

            $table->timestamps();
            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::create('company_personal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->string('per_side_company')->nullable();
            $table->string('per_sex_company')->nullable();
            $table->string('per_title_company')->nullable();
            $table->string('per_name_company')->nullable();
            $table->string('per_phone_company')->nullable();
            $table->string('per_inside_company')->nullable();
            $table->longText('per_email_company')->nullable();
            $table->longText('per_tel_company_company')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::create('customer_personal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index();
            $table->integer('sex');
            $table->string('date_personel')->nullable();
            $table->string('codemeli_personel')->nullable();
            $table->string('fax_personel')->nullable();
            $table->string('tel_personel')->nullable();
            $table->string('phone_personel');
            $table->string('email_personel')->nullable();
            $table->longText('adders_personel')->nullable();
            $table->longText('text_personel')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')
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
        Schema::dropIfExists('customers');
    }
}
