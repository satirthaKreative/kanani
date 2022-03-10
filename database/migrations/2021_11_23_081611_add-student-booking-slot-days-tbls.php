<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentBookingSlotDaysTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_booking_timeslot_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_booking_id')->default(0);
            $table->date('student_booking_date')->default('0000-00-00');
            $table->time('course_class_start_time_name')->default('0:00');
            $table->time('course_class_end_time_name')->default('0:00');
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
        Schema::dropIfExists('student_booking_timeslot_tbls');
    }
}
