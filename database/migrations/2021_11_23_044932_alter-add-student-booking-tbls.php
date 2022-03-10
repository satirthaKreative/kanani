<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddStudentBookingTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_booking_tbls', function (Blueprint $table) {
            $table->enum('admin_shown_status',['seen','unseen'])->default('unseen')->after('student_booking_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_booking_tbls', function (Blueprint $table) {
            //
        });
    }
}
