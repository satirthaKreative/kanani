<?php

namespace App\Model\Backend\CountryTimezone;

use Illuminate\Database\Eloquent\Model;

class TimezoneModel extends Model
{
    //
    protected $table = "calendar_timezone_tbl";

    protected $fillable = [
        "CountryCode", "Coordinates", "TimeZone", "Comments", "UTCoffset", "UTC DST offset", "Notes"
    ];
}
