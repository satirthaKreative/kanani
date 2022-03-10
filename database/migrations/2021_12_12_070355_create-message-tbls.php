<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_tbls_id')->default(0);
            $table->string('course_name')->nullable();
            $table->string('topic_name')->nullable();
            $table->enum('user_type',['teacher','admin'])->default('teacher');
            $table->integer('teacher_id')->default(0);
            $table->integer('sender_id')->default(0);
            $table->integer('receiver_id')->default(0);
            $table->enum('sender_type',['teacher','admin','user'])->default('user');
            $table->enum('message_tbls_status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('message_tbls');
    }
}
