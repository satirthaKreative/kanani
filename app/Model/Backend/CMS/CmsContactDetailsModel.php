<?php

namespace App\Model\Backend\CMS;

use Illuminate\Database\Eloquent\Model;

class CmsContactDetailsModel extends Model
{
    protected $table = "cms_contact_details_tbls";
    protected $fillable = [
        "cms_phone_number", "cms_email_address", "cms_facebook", "cms_instagram", "cms_twitter", "cms_youtube", "cms_copyright", "cms_footer_heading", "cms_footer_content","created_at", "updated_at"
    ];
}