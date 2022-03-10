<?php

namespace App\Model\Frontend\Others;

use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    protected $table = "contact_tbls";

    protected $fillable = [
        'quote_name', 'short_description', 'contact_number', 'contact_email', 'created_at', 'updated_at'
    ];
}