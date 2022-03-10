<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyPayTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_pay_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booking_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('course_tbl_id')->default(0);
            $table->bigInteger('total_number_of_class')->default(0);
            $table->bigInteger('total_left_number_of_class')->default(0);
            $table->double('monthly_cost_package',12,2)->default(0);
            $table->integer('total_months')->default(0);
            $table->integer('left_months')->default(0);
            $table->double('total_payable_amount',12,2)->default(0);
            $table->double('paid_amount',12,2)->default(0);
            $table->double('pending_amount',12,2)->default(0);
            $table->date('booking_start_date')->default('0000-00-00');
            $table->date('booking_end_date')->default('0000-00-00');
            $table->date('notification_date')->default('0000-00-00');
            $table->enum('booking_state',['active','inactive'])->default('active');
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
        Schema::dropIfExists('monthly_pay_tbls');
    }
}
