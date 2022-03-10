<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class LanguageModel extends Model
{
    protected $table = "languages";

    protected $fillable = [
        "language_name", "language_state"
    ];
}
