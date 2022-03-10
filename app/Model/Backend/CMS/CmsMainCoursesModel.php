<?php

namespace App\Model\Backend\CMS;

use Illuminate\Database\Eloquent\Model;

class CmsMainCoursesModel extends Model
{
    protected $table = "cms_courses_tbls";
    protected $fillable = [
        "headline", "main_description", "kids_english_course", "kids_price", "teen_english_course", "teen_price", "adult_english_course", "adult_price", "lets_see_online_education", "lets_see_online_education_description", "created_at", "updated_at"
    ];
}
