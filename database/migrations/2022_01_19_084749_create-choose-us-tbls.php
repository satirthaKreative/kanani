<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChooseUsTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choose_us_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heading1_name')->nullable();
            $table->longText('paragraph1_name')->nullable();
            $table->string('heading2_name')->nullable();
            $table->longText('paragraph2_name')->nullable();
            $table->string('heading3_name')->nullable();
            $table->longText('paragraph3_name')->nullable();
            $table->string('section1_name')->nullable();
            $table->longText('section1_paragraph')->nullable();
            $table->string('section2_name')->nullable();
            $table->longText('section2_paragraph')->nullable();
            $table->string('section3_name')->nullable();
            $table->longText('section3_paragraph')->nullable();
            $table->longText('paragraph1_img')->nullable();
            $table->longText('paragraph2_img')->nullable();
            $table->longText('paragraph3_img')->nullable();
            $table->longText('section1_img')->nullable();
            $table->longText('section2_img')->nullable();
            $table->longText('section3_img')->nullable();
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
        Schema::dropIfExists('choose_us_tbls');
    }
}
