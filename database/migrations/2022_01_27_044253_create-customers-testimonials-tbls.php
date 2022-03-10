<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTestimonialsTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_testimonials_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('customers_images')->nullable();
            $table->longText('customer_comment')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_post')->nullable();
            $table->enum('post_state',['active','inactive'])->default('active');
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
        Schema::dropIfExists('customers_testimonials_tbls');
    }
}
