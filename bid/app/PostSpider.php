<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSpider extends Model
{
    protected $fillable = ['name', 'allowed_domain', 'start_url', 'csrftoken_xpath', 'viewstate_xpath',
                           'page_count_xpath', 'eventtarget_content', 'viewstateencrypted_content',
                           'link_xpath', 'content_xpath', 'enable'];
}
