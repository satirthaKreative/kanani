<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booking_id')->default(0);
            $table->longText('layer_id')->nullable();
            $table->longText('tokanId')->nullable();
            $table->longText('mfid')->nullable();
            $table->string('rcache')->nullable();
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
        Schema::dropIfExists('order_details_tbls');
    }
}
