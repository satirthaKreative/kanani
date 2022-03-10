<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsBlogsTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_blog_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('blog_name')->nullable();
            $table->longText('blog_details')->nullable();
            $table->string('author_name')->nullable();
            $table->longText('author_quote')->nullable();
            $table->longText('blog_imgs')->nullable();
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
        Schema::dropIfExists('cms_blog_tbls');
    }
}
