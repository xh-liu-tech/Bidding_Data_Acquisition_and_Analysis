<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BidArticle;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'authority' => Auth::User()['authority'],
            'page_title' => '数据查询'
        ];
        return view('query', $data);
    }

    public function query(Request $request)
    {
        $bid_articles = new BidArticle();
        if ($request->has('name'))
        {
            $bid_articles = $bid_articles->where('name', 'like', '%'. $request->input('name'). '%');
        }
        if ($request->has('company'))
        {
            $bid_articles = $bid_articles->where('company', 'like', '%'. $request->input('company'). '%');
        }
        if ($request->has('priceFloor'))
        {
            $bid_articles = $bid_articles->where('price', '>=', $request->input('priceFloor'));
        }
        if ($request->has('priceCeiling'))
        {
            $bid_articles = $bid_articles->where('price', '<=', $request->input('priceCeiling'));
        }
        if ($request->has('date'))
        {
            $date_range = explode(' - ', $request->input('date'));
            $bid_articles = $bid_articles->whereBetween('date', $date_range);
        }
        return view('partials.query_table', ['bid_articles' => $bid_articles->get()]);
    }
}
