<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quote_name')->nullable();
            $table->longText('short_description')->nullable();
            $table->bigInteger('contact_number')->default(0);
            $table->string('contact_email')->default('info@kanani.com');
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
        Schema::dropIfExists('contact_tbls');
    }
}
