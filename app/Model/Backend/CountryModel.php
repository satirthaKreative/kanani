<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = "countries";

    protected $fillable = [
        "country_code", "country_name"
    ]; 
}
