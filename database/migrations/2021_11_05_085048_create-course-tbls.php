<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_name');
            $table->integer('user_role');
            $table->double('course_price',12,2)->default(0);
            $table->integer('main_course_id');
            $table->integer('age_id');
            $table->integer('no_of_units');
            $table->integer('no_of_lessons');
            $table->integer('times_in_minutes');
            $table->enum('course_status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('course_tbls');
    }
}
