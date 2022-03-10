<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmscontactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contact_details_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('cms_phone_number')->nullable();
            $table->longText('cms_email_address')->nullable();
            $table->longText('cms_facebook')->nullable();
            $table->longText('cms_instagram')->nullable();
            $table->longText('cms_twitter')->nullable();
            $table->longText('cms_youtube')->nullable();
            $table->longText('cms_copyright')->nullable();
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
        Schema::dropIfExists('cms_contact_details_tbls');
    }
}
