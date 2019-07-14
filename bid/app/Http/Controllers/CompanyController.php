<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BidArticle;

class CompanyController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => '企业数据统计',
            'authority' =>  Auth::User()['authority'],
        ];
        return view('company', $data);
    }

    public function query($company)
    {
        $bid_articles = BidArticle::where('company', 'like', '%'. $company. '%')->select('company')->get();
        echo '<ul class="list-group">';
        foreach ($bid_articles as $bid_article)
        {
            echo '<li class="list-group-item"><a href="/company/show/'. $bid_article->company. '">'. $bid_article->company. '</a></li>';
        }
        echo '</ul>';
    }

    public function show($company)
    {
        $bid_articles = BidArticle::where('company', '=', $company)->where('date', '<>', '0000-00-00')->select('date', 'price')->orderBy('date', 'asc')->get();
        $date = array();
        $price = array();
        foreach ($bid_articles as $bid_article)
        {
            array_push($date, $bid_article->date);
            array_push($price, $bid_article->price);
        }
        $data = [
            'page_title' => $company,
            'authority' => Auth::User()['authority'],
            'labels' => json_encode($date),
            'data' => json_encode($price)
        ];
        return view('chart', $data);
    }
}
