<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetSpider extends Model
{
    protected $fillable = ['name', 'allowed_domain', 'start_url', 'page_url',
                           'page_count_xpath', 'page_count_re', 'link_xpath', 'content_xpath', 'enable'];
}
