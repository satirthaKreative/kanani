<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableIntervalTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_available_interval_slot_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('config_time_hrs_interval')->default(0);
            $table->integer('config_time_mins_interval')->default(0);
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
        Schema::dropIfExists('student_available_interval_slot_tbls');
    }
}
