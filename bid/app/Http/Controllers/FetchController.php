<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GetSpider;
use App\PostSpider;

class FetchController extends Controller
{
    public function index()
    {
        $data = [
            'authority' =>  Auth::User()['authority'],
            'get_spiders' => GetSpider::all(),
            'post_spiders' => PostSpider::all()
        ];
        return view('fetch', $data);
    }

    public function start()
    {
        chdir('/usr/local/anhui_bid/BidSpider/');
        echo exec('python ./BidSpider/run.py');
    }
}
