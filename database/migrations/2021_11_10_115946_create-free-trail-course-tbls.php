<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeTrailCourseTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_trail_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('age_number')->default(0);
            $table->integer('english_number')->default(0);
            $table->longText('leave_msg')->nullable();
            $table->integer('student_id')->default(0);
            $table->longText('teacher_email')->nullable();
            $table->longText('admin_email')->nullable();
            $table->enum('free_trail_status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('free_trail_tbls');
    }
}
