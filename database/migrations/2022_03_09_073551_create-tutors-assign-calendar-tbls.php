<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorsAssignCalendarTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors_assign_calendar_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tutor_id')->default(0)->nullable();
            $table->integer('student_id')->default(0)->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('student_name')->nullable();
            $table->enum('admin_action',['yes','no'])->default('yes');
            $table->date('assign_teacher_date')->nullable();
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
        Schema::dropIfExists('tutors_assign_calendar_tbls');
    }
}
