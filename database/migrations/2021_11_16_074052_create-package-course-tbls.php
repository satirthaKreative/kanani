<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageCourseTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_package_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->default(0);
            $table->integer('no_of_lessons_per_month')->default(0);
            $table->double('price_per_month',12,2)->default(0);
            $table->enum('package_status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('course_package_tbls');
    }
}
