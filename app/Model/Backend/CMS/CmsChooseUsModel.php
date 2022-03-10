<?php

namespace App\Model\Backend\CMS;

use Illuminate\Database\Eloquent\Model;

class CmsChooseUsModel extends Model
{
    protected $table = "choose_us_tbls";

    protected $fillable = [
        "heading1_name", "paragraph1_name", "heading2_name", "paragraph2_name", "heading3_name", "paragraph3_name", "section1_name", "section1_paragraph", "section2_name", "section2_paragraph", "section3_name", "section3_paragraph", "paragraph1_img", "paragraph2_img", "paragraph3_img", "section1_img", "section2_img", "section3_img", "created_at", "updated_at"
    ];
}