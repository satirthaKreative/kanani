<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsCourseStructureAdultTeenChildTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_course_structure_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_type')->nullable();
            $table->longText('course_details')->nullable();
            $table->string('course_lessons')->nullable();
            $table->string('course_units')->nullable();
            $table->string('course_duration')->nullable();
            $table->string('age_type')->nullable();
            $table->integer('course_user_type')->nullable(); // user type : adult, child, teen
            $table->bigInteger('cms_course_main_tbl_id')->default(0);
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
        Schema::dropIfExists('cms_course_structure_tbls');
    }
}
