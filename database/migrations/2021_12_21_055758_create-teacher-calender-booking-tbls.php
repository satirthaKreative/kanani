<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherCalenderBookingTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_calender_booking_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('teacher_id')->default(0);
            $table->integer('booking_days_id')->default(0);
            $table->date('booking_actual_date')->nullable();
            $table->string('booking_old_date')->default('notModified');
            $table->string('booking_days_name')->nullable();
            $table->date('booking_teacher_start_date_name')->nullable();
            $table->date('booking_teacher_end_date_name')->nullable();
            $table->date('booking_teacher_notifying_date_name')->nullable();
            $table->time('booking_teacher_available_start_time')->nullable('H:i');
            $table->time('booking_teacher_available_end_time')->nullable('H:i');
            $table->date('updated_booking_on');
            $table->enum('calender_active_status',['active','deactive'])->default('active');
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
        Schema::dropIfExists('teacher_calender_booking_tbls');
    }
}
