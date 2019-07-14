<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Excel;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SpiderMethod;
use App\GetSpider;
use App\PostSpider;

class SpiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'get_spiders' => GetSpider::all(),
            'post_spiders' => PostSpider::all(),
            'page_title' => '爬虫管理',
            'authority' =>  Auth::User()['authority']
        ];
        return view('spider', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('spider_method') == 'GET')
        {
            $this->validate($request, [
                'name' => 'required|unique:get_spiders',
                'allowed_domain' => 'required',
                'start_url' => 'required',
                'page_url' => 'required',
                'page_count_xpath' => 'required',
                'page_count_re' => 'required',
                'link_xpath' => 'required',
                'content_xpath' => 'required',
                'enable' => 'required'
            ]);
            if (GetSpider::create($request->all()))
            {
                return redirect('/spider')->withSuccess("爬虫添加成功。");
            }
            else
            {
                return redirect('/spider')->withErrors("爬虫添加失败。");
            }
        }
        else
        {
            $this->validate($request, [
                'name' => 'required|unique:post_spiders',
                'allowed_domain' => 'required',
                'start_url' => 'required',
                'link_xpath' => 'required',
                'content_xpath' => 'required',
                'enable' => 'required'
            ]);
            if (PostSpider::create($request->all()))
            {
                return redirect('/spider')->withSuccess("爬虫添加成功。");
            }
            else
            {
                return redirect('/spider')->withErrors("爬虫添加失败。");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $spider_method, $id)
    {
        if ($spider_method == 'GET')
        {
            $this->validate($request, [
                'name' => 'required',
                'allowed_domain' => 'required',
                'start_url' => 'required',
                'page_url' => 'required',
                'page_count_xpath' => 'required',
                'page_count_re' => 'required',
                'link_xpath' => 'required',
                'content_xpath' => 'required',
                'enable' => 'required'
            ]);
            if (GetSpider::where('id', $id)->update($request->except(['_method', '_token'])))
            {
                return redirect('/spider')->withSuccess("爬虫修改成功。");
            }
            else
            {
                return redirect('/spider')->withErrors("爬虫修改失败。");
            }
        }
        else
        {
            $this->validate($request, [
                'name' => 'required',
                'allowed_domain' => 'required',
                'start_url' => 'required',
                'link_xpath' => 'required',
                'content_xpath' => 'required',
                'enable' => 'required'
            ]);
            if (PostSpider::where('id', $id)->update($request->except(['_method', '_token'])))
            {
                return redirect('/spider')->withSuccess("爬虫修改成功。");
            }
            else
            {
                return redirect('/spider')->withErrors("爬虫修改失败。");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($spider_method, $id)
    {
        if ($spider_method == 'GET')
        {
            $spider = GetSpider::find($id);
        }
        else
        {
            $spider = PostSpider::find($id);
        }
        $spider->delete();
        return redirect('/spider')->withSuccess("爬虫删除成功。");
    }
    
    public function import(Request $request)
    {
        if ($request->hasFile('spider_file'))
        {
            $spider_file = $request->file('spider_file');
            if ($spider_file->isValid())
            {
                if ($spider_file->getClientOriginalExtension() == 'xls')
                {
                    Excel::load($spider_file, function($reader) {
                        $reader->each(function($sheet)
                        {
                            if ($sheet->getTitle() == 'GET')
                            {
                                $sheet->each(function($row)
                                {
                                    GetSpider::create($row->all());
                                });
                            }
                            else if ($sheet->getTitle() == 'POST')
                            {
                                $sheet->each(function($row)
                                {
                                    PostSpider::create($row->all());
                                });
                            }
                            else
                            {
                                redirect('/spider')->withErrors('文件格式有误。');
                            }
                        });
                    });
                }
                else if ($spider_file->getClientOriginalName() == 'GET.csv')
                {
                    Excel::load($spider_file, function($reader) {
                        $reader->each(function($row) {
                            GetSpider::create($row->toArray());
                        });
                    });
                }
                else if ($spider_file->getClientOriginalName() == 'POST.csv')
                {
                    Excel::load($spider_file, function($reader) {
                        $reader->each(function($row) {
                            PostSpider::create($row->toArray());
                        });
                    });
                }
            }
            else
            {
                return redirect('/spider')->withErrors('文件上传失败，请重试。');
            }
        }
        else
        {
            return redirect('/spider')->withErrors('请选择需导入的文件。');
        }
        //return redirect('/spider')->withSuccess('文件导入成功。');
    }
}
