<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsMainCoursesTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_courses_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('headline')->nullable();
            $table->longText('Main Description')->nullable();
            $table->longText('kids_english_course')->nullable();
            $table->float('kids_price',12,2)->default(0);
            $table->longText('teen_english_course')->nullable();
            $table->float('teen_price',12,2)->default(0);
            $table->longText('adult_english_course')->nullable();
            $table->float('adult_price',12,2)->default(0);
            $table->String('lets_see_online_education')->nullable();
            $table->longText('lets_see_online_education_description')->nullable();
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
        Schema::dropIfExists('cms_courses_tbls');
    }
}
