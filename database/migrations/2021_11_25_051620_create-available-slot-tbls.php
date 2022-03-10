<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableSlotTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_available_slot_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_available_time')->nullable();
            $table->integer('student_id')->default(0);
            $table->string('student_date')->nullable();
            $table->time('avail_from_time')->default('0:00');
            $table->time('avail_to_time')->default('0:00');
            $table->enum('students_avail',['active','inactive'])->default('active');
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
        Schema::dropIfExists('student_available_slot_tbls');
    }
}
