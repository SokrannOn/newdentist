<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentproceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatmentprocedures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id');
            $table->integer('plan_id');
            $table->integer('treatment_id');
            $table->integer('doctor_id');
            $table->string('description')->nullable();
            $table->boolean('completed');
            $table->date('completeddate')->nullable();
            $table->integer('appointment_id');
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
        Schema::dropIfExists('treatmentprocedures');
    }
}
