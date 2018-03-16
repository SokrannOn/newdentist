<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlanTreatment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_treatment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id');
            $table->integer('treatment_id');
            $table->tinyInteger('teeNo')->nullable();
            $table->tinyInteger('qty');
            $table->float('price');
            $table->integer('appointment_id');
            $table->double('amount');
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
        Schema::dropIfExists('plan_treatment');
    }
}
