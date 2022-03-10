<?php

namespace App\Model\Backend\CMS;

use Illuminate\Database\Eloquent\Model;

class CmsBlogModel extends Model
{
    protected $table = "cms_blog_tbls";
    protected $fillable = [
        "blog_name", "blog_details", "author_name", "author_quote", "blog_imgs", "author_img", "fb_link", "insta_link", "tw_link", "yt_link", "created_at", "updated_at"
    ];
}
