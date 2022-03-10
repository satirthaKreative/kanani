<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignTutorsTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_tutors_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('teacher_id')->default(0);
            $table->bigInteger('student_id')->default(0);
            $table->bigInteger('course_id')->default(0);
            $table->enum('assign_tutor',['active','inactive'])->default('active');
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
        Schema::dropIfExists('assign_tutors_tbls');
    }
}
