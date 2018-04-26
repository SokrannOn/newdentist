<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShardoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shardoctors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id');
            $table->integer('plan_id');
            $table->integer('treatment_id');
            $table->integer('doctor_id');
            $table->double('balance');
            $table->date('date');
            $table->double('amount');
            $table->integer('exchangeRate');
            $table->boolean('confirm');
            $table->string('recordStatus')->nullable();
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
        Schema::dropIfExists('shardoctors');
    }
}
