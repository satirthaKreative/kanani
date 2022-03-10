<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsCourseAdultTeenChildTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_adult_teen_child_courses_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('main_img');
            $table->text('main_course_type')->nullable();
            $table->integer('total_chapters')->nullable();
            $table->integer('total_lessons')->nullable();
            $table->text('course_heading')->nullable();
            $table->longText('course_description')->nullable();
            $table->longText('get_started_heading')->nullable();
            $table->double('get_started_discount_price',12,2)->default(0);
            $table->double('get_started_total_price',12,2)->default(0);
            $table->integer('get_started_percentage_price')->default(0);
            $table->text('this_course_includes_heading')->nullable();
            $table->longText('this_course_includes_paragraph')->nullable();
            $table->text('lets_see_online_upper_heading')->nullable();
            $table->text('lets_see_online_main_heading')->nullable();
            $table->longText('lets_see_online_main_paragraph')->nullable();
            $table->string('course_user_type')->nullable(); // user type : adult, child, teen
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
        Schema::dropIfExists('cms_adult_teen_child_courses_tbls');
    }
}
