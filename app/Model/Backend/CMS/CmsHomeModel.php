<?php

namespace App\Model\Backend\CMS;

use Illuminate\Database\Eloquent\Model;

class CmsHomeModel extends Model
{
    protected $table = "cms_home_tbls";
    protected $fillable = [
        "largest_collection_of_courses_name", "largest_collection_of_courses_paragraph_name", "largest_collection_of_courses_img", "welcome_to_kanani_name", "welcome_to_kanani_paragraph_name", "welcome_to_kanani_image_name", "lets_see_online_education_name", "lets_see_online_education_description_name", "lets_see_online_education_image", "install_zoom_heading_name", "install_zoom_paragraph_name", "join_a_trail_class_heading_name", "join_a_trail_class_paragraph_name", "select_a_course_class_heading_name", "select_a_course_class_paragraph_name", "start_your_journey_class_heading_name", "start_your_journey_class_paragraph_name", "blog_class_heading_name", "blog_class_paragraph_name", "our_courses_class_heading_name", "our_courses_class_paragraph_name", "created_at", "updated_at"
    ];
}
