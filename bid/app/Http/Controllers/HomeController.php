<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home', ['authority' => Auth::User()['authority']]);
    }

    public function getDownload($file_name)
    {
        $file = public_path(). '/download/'. $file_name;
        return response()->download($file);
    }
}
