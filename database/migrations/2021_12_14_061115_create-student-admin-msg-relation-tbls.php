<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAdminMsgRelationTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentAdminMsgRelationTbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('message_tbls')->default(0);
            $table->longText('messages')->nullable();
            $table->bigInteger('user_ids')->nullable();
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
        Schema::dropIfExists('studentAdminMsgRelationTbls');
    }
}
