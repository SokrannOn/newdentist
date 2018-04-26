<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctorpayments', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('paiddate');
            $table->integer('doctor_id');
            $table->integer('branch_id');
            $table->integer('currency_id');
            $table->double('paidAmount');
            $table->integer('exchangeRate');
            $table->integer('user_id');
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
        Schema::dropIfExists('doctorpayments');
    }
}
