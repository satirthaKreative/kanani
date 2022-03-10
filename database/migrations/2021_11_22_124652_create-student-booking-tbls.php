<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentBookingTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_booking_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(0);
            $table->integer('paypal_package_name')->default(0);
            $table->enum('paypal_package_radio_name',['0','1'])->default(0);
            $table->bigInteger('paypal_package_price_name')->default(0);
            $table->time('course_class_start_time_name')->default('0:00');
            $table->time('course_class_end_time_name')->default('0:00');
            $table->longText('course_comment_name')->nullable();
            $table->enum('student_booking_status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('student_booking_tbls');
    }
}
