<?php

namespace App\Model\Frontend\Student;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayModel extends Model
{
    //
    protected $table = "monthly_pay_tbls";
    protected $fillable = [
        'booking_id', 'user_id', 'total_number_of_class', 'total_left_number_of_class', 'monthly_cost_package', 'total_months', 'left_months', 'total_payable_amount', 'paid_amount', 'pending_amount', 'booking_start_date', 'booking_end_date', 'notification_date', 'booking_state', 'created_at', 'updated_at'
    ];
}
