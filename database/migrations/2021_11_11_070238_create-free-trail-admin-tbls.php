<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeTrailAdminTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_free_trail_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teachers_available_time')->nullable();
            $table->integer('teacher_id')->default(0);
            $table->string('teachers_date')->nullable();
            $table->string('teachers_time')->nullable();
            $table->enum('teachers_avail',['active','inactive'])->default('active');
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
        Schema::dropIfExists('admin_free_trail_tbls');
    }
}
