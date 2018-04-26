<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestpros', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('request_by');
            $table->integer('user_id');
            $table->tinyInteger('is_export');
            $table->string('description');
            $table->integer('auth_id')->nullable();
            $table->date('auth_date')->nullable();
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
        Schema::dropIfExists('requestpros');
    }
}
