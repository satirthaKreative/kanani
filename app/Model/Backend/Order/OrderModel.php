<?php

namespace App\Model\Backend\Order;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = "order_details_tbls";
    protected $fillable = [
        'booking_id', 'layer_id', 'tokanId', 'mfid', 'rcache', 'created_at', 'updated_at'
    ];
}
