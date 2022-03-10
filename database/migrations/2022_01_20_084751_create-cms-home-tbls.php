<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsHomeTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_home_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('largest_collection_of_courses_name')->nullable();
            $table->longText('largest_collection_of_courses_paragraph_name')->nullable();
            $table->longText('largest_collection_of_courses_img')->nullable();
            $table->text('welcome_to_kanani_name')->nullable();
            $table->longText('welcome_to_kanani_paragraph_name')->nullable();
            $table->longText('welcome_to_kanani_image_name')->nullable();
            $table->text('lets_see_online_education_name')->nullable();
            $table->longText('lets_see_online_education_description_name')->nullable();
            $table->longText('lets_see_online_education_image')->nullable();
            $table->text('install_zoom_heading_name')->nullable();
            $table->longText('install_zoom_paragraph_name')->nullable();
            $table->text('join_a_trail_class_heading_name')->nullable();
            $table->longText('join_a_trail_class_paragraph_name')->nullable();
            $table->text('select_a_course_class_heading_name')->nullable();
            $table->longText('select_a_course_class_paragraph_name')->nullable();
            $table->text('start_your_journey_class_heading_name')->nullable();
            $table->longText('start_your_journey_class_paragraph_name')->nullable();
            $table->text('blog_class_heading_name')->nullable();
            $table->longText('blog_class_paragraph_name')->nullable();
            $table->text('our_courses_class_heading_name')->nullable();
            $table->longText('our_courses_class_paragraph_name')->nullable();
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
        Schema::dropIfExists('cms_home_tbls');
    }
}
