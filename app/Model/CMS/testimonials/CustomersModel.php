<?php

namespace App\Model\CMS\testimonials;

use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    protected $table = "customers_testimonials_tbls";
    protected $fillable = [
        "customers_images", "customer_comment", "customer_name", "customer_post", "post_state", "created_at", "updated_at"
    ];
}