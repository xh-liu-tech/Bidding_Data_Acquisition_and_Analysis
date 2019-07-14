@extends('template')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css") }}">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">爬虫列表</h3>
                @include('partials.errors')
                @include('partials.success')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="tablebox-controls">
                    <!-- Check all button -->
                    @if ($authority == 0)
                        <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o" title="全选/反全选"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o" title="删除"></i></button>
                    @endif
                    <a class="btn btn-default btn-sm" href="/spider"><i class="fa fa-refresh" title="刷新"></i></a>
                    @if ($authority == 0)
                        <button type="button" class="btn btn-success btn-md pull-right" data-toggle="modal" data-target="#addSpiderModal">
                            <i class="fa fa-plus-circle"></i> 添加
                        </button>
                        <div class="btn-group">
                            <a class="btn btn-info btn-md" href="/download/spider_template.xls">
                                <i class="fa fa-table"></i> Excel模板
                            </a>
                            <a class="btn btn-info btn-md" href="/download/GET.csv">
                                <i class="fa fa-file-text"></i> Csv模板(GET)
                            </a>
                            <a class="btn btn-info btn-md" href="/download/POST.csv">
                                <i class="fa fa-file-text"></i> Csv模板(POST)
                            </a>
                        </div>
                        <form method="POST" role="form" class="form-inline pull-right" enctype="multipart/form-data" action="/spider/import">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="file" name="spider_file">
                            </div>
                            <button type="submit" class="btn btn-success btn-md">
                            <i class="fa fa-upload"></i> 文件导入
                                </button>
                        </form>
                    @endif
                </div>
                <br>
                <div id="addSpiderModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">添加爬虫</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="/spider" id="addGetSpiderForm">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">爬取方式</label>
                                            <div class="col-sm-10">
                                                <label>
                                                    <input type="radio" name="spider_method" value="GET" checked>
                                                    GET
                                                </label>
                                                <label>
                                                    <input type="radio" name="spider_method" value="POST">
                                                    POST
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSpiderName" class="col-sm-2 control-label">爬虫名<br>(name)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSpiderName" name="name" placeholder="爬虫名">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAllowedDomain" class="col-sm-2 control-label">允许域名<br>(allowed_domain)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputAllowedDomain" name="allowed_domain" placeholder="允许域名">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStartUrl" class="col-sm-2 control-label">初始链接<br>(start_url)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputStartUrl" name="start_url" placeholder="初始链接">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageUrl" class="col-sm-2 control-label">页面链接<br>(page_url)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageUrl" name="page_url" placeholder="页面链接">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageCountXpath" class="col-sm-2 control-label">总页数xpath<br>(page_count_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageCountXpath" name="page_count_xpath" placeholder="总页数xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageCountRe" class="col-sm-2 control-label">总页数正则表达式<br>(page_count_re)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageCountRe" name="page_count_re" placeholder="总页数正则表达式">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLinkXpath" class="col-sm-2 control-label">内容链接xpath<br>(link_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputLinkXpath" name="link_xpath" placeholder="内容链接xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputContentXpath" class="col-sm-2 control-label">内容xpath<br>(content_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputContentXpath" name="content_xpath" placeholder="内容xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEnable" class="col-sm-2 control-label">已启用<br>(enable)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEnable" name="enable" placeholder="已启用">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form class="form-horizontal" method="POST" action="/spider" id="addPostSpiderForm" hidden=true>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">爬取方式</label>
                                            <div class="col-sm-10">
                                                <label>
                                                    <input type="radio" name="spider_method" value="GET">
                                                    GET
                                                </label>
                                                <label>
                                                    <input type="radio" name="spider_method" value="POST" checked>
                                                    POST
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSpiderName" class="col-sm-2 control-label">爬虫名<br>(name)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSpiderName" name="name" placeholder="爬虫名">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAllowedDomain" class="col-sm-2 control-label">允许域名<br>(allowed_domain)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputAllowedDomain" name="allowed_domain" placeholder="允许域名">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStartUrl" class="col-sm-2 control-label">初始链接<br>(start_url)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputStartUrl" name="start_url" placeholder="初始链接">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageCountXpath" class="col-sm-2 control-label">总页数xpath<br>(page_count_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageCountXpath" name="page_count_xpath" placeholder="总页数xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputCsrftokenXpath" class="col-sm-2 control-label">csrftoken_xpath</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputCsrftokenXpath" name="csrftoken_xpath" placeholder="csrftoken_xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputViewstateXpath" class="col-sm-2 control-label">viewstate_xpath</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputViewstateXpath" name="viewstate_xpath" placeholder="viewstate_xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEventtargetContent" class="col-sm-2 control-label">eventtarget_content</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEventtargetContent" name="eventtarget_content" placeholder="eventtarget_content">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputViewstateencryptedContent" class="col-sm-2 control-label">viewstateencrypted_content</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputViewstateencryptedContent" name="viewstateencrypted_content" placeholder="viewstateencrypted_content">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLinkXpath" class="col-sm-2 control-label">内容链接xpath<br>(link_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputLinkXpath" name="link_xpath" placeholder="内容链接xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputContentXpath" class="col-sm-2 control-label">内容xpath<br>(content_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputContentXpath" name="content_xpath" placeholder="内容xpath">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEnable" class="col-sm-2 control-label">已启用<br>(enable)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEnable" name="enable" placeholder="已启用">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="submitForm(addSpiderForm)">添加</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="spiderTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>选择</th>
                            <th>爬虫名(name)</th>
                            <th>爬取方式</th>
                            <th>允许域名(allowed_domain)</th>
                            <th>已启用(enable)</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    @foreach ($get_spiders as $get_spider)
                    <tr>
                        <td class="table-operation"><input type="checkbox" value="{{ $get_spider->id }}" name="checkbox[]"></td>
                        <td>{{ $get_spider->name }}</td>
                        <td>GET</td>
                        <td>{{ $get_spider->allowed_domain }}</td>
                        <td>{{ $get_spider->enable }}</td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#getSpiderModal{{ $get_spider->id }}">详情</button>
                            @if ($authority == 0)
                                <form action="/spider/GET/{{ $get_spider->id }}" method="POST" style="display: inline;">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger">删除</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($post_spiders as $post_spider)
                    <tr>
                        <td class="table-operation"><input type="checkbox" value="{{ $post_spider->id }}" name="checkbox[]"></td>
                        <td>{{ $post_spider->name }}</td>
                        <td>POST</td>
                        <td>{{ $post_spider->allowed_domain }}</td>
                        <td>{{ $post_spider->enable }}</td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#postSpiderModal{{ $post_spider->id }}">详情</button>
                            @if ($authority == 0)
                                <form action="/spider/POST/{{ $post_spider->id }}" method="POST" style="display: inline;">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger">删除</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <th>选择</th>
                            <th>爬虫名(name)</th>
                            <th>爬取方式</th>
                            <th>允许域名(allowed_domain)</th>
                            <th>已启用(enable)</th>
                            <th>操作</th>
                        </tr>
                    </tfoot>
                </table>
                @foreach ($get_spiders as $get_spider)
                <div id="getSpiderModal{{ $get_spider->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">详细信息</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="/spider/GET/{{ $get_spider->id }}" id="editGetSpiderForm{{ $get_spider->id }}">
                                    <div class="box-body">
                                        <input name="_method" type="hidden" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="inputSpiderName" class="col-sm-2 control-label">爬虫名<br>(name)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSpiderName" name="name" placeholder="爬虫名" value="{{ $get_spider->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAllowedDomain" class="col-sm-2 control-label">允许域名<br>(allowed_domain)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputAllowedDomain" name="allowed_domain" placeholder="允许域名" value="{{ $get_spider->allowed_domain }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStartUrl" class="col-sm-2 control-label">初始链接<br>(start_url)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputStartUrl" name="start_url" placeholder="初始链接" value="{{ $get_spider->start_url }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageUrl" class="col-sm-2 control-label">页面链接<br>(page_url)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageUrl" name="page_url" placeholder="页面链接" value="{{ $get_spider->page_url }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageCountXpath" class="col-sm-2 control-label">总页数xpath<br>(page_count_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageCountXpath" name="page_count_xpath" placeholder="总页数xpath" value="{{ $get_spider->page_count_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageCountRe" class="col-sm-2 control-label">总页数正则表达式<br>(page_count_re)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageCountRe" name="page_count_re" placeholder="总页数正则表达式" value="{{ $get_spider->page_count_re }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLinkXpath" class="col-sm-2 control-label">内容链接xpath<br>(link_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputLinkXpath" name="link_xpath" placeholder="内容链接xpath" value="{{ $get_spider->link_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputContentXpath" class="col-sm-2 control-label">内容xpath<br>(content_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputContentXpath" name="content_xpath" placeholder="内容xpath" value="{{ $get_spider->content_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEnable" class="col-sm-2 control-label">已启用<br>(enable)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEnable" name="enable" placeholder="已启用" value="{{ $get_spider->enable }}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                @if ($authority == 0)
                                    <button type="submit" class="btn btn-warning" data-dismiss="modal" onclick="submitForm(editGetSpiderForm{{ $get_spider->id }})">修改</button>
                                @endif
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach ($post_spiders as $post_spider)
                <div id="postSpiderModal{{ $post_spider->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">详细信息</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="/spider/POST/{{ $post_spider->id }}" id="editPostSpiderForm{{ $post_spider->id }}">
                                    <div class="box-body">
                                        <input name="_method" type="hidden" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="inputSpiderName" class="col-sm-2 control-label">爬虫名<br>(name)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSpiderName" name="name" placeholder="爬虫名" value="{{ $post_spider->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAllowedDomain" class="col-sm-2 control-label">允许域名<br>(allowed_domain)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputAllowedDomain" name="allowed_domain" placeholder="允许域名" value="{{ $post_spider->allowed_domain }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStartUrl" class="col-sm-2 control-label">初始链接<br>(start_url)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputStartUrl" name="start_url" placeholder="初始链接" value="{{ $post_spider->start_url }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPageCountXpath" class="col-sm-2 control-label">总页数xpath<br>(page_count_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputPageCountXpath" name="page_count_xpath" placeholder="总页数xpath" value="{{ $post_spider->page_count_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputCsrftokenXpath" class="col-sm-2 control-label">csrftoken_xpath</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputCsrftokenXpath" name="csrftoken_xpath" placeholder="csrftoken_xpath" value="{{ $post_spider->csrftoken_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputViewstateXpath" class="col-sm-2 control-label">viewstate_xpath</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputViewstateXpath" name="viewstate_xpath" placeholder="viewstate_xpath" value="{{ $post_spider->viewstate_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEventtargetContent" class="col-sm-2 control-label">eventtarget_content</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEventtargetContent" name="eventtarget_content" placeholder="eventtarget_content" value="{{ $post_spider->eventtarget_content }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputViewstateencryptedContent" class="col-sm-2 control-label">viewstateencrypted_content</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputViewstateencryptedContent" name="viewstateencrypted_content" placeholder="viewstateencrypted_content" value="{{ $post_spider->viewstateencrypted_content }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLinkXpath" class="col-sm-2 control-label">内容链接xpath<br>(link_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputLinkXpath" name="link_xpath" placeholder="内容链接xpath" value="{{ $post_spider->link_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputContentXpath" class="col-sm-2 control-label">内容xpath<br>(content_xpath)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputContentXpath" name="content_xpath" placeholder="内容xpath" value="{{ $post_spider->content_xpath }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEnable" class="col-sm-2 control-label">已启用<br>(enable)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEnable" name="enable" placeholder="已启用" value="{{ $post_spider->enable }}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                @if ($authority == 0)
                                    <button type="submit" class="btn btn-warning" data-dismiss="modal" onclick="submitForm(editPostSpiderForm{{ $post_spider->id }})">修改</button>
                                @endif
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- iCheck -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
<script type="text/javascript">
var addSpiderForm = addGetSpiderForm;
$(function () {
    $("#spiderTable").DataTable();
});
function submitForm(id) {
    $(id).submit();
}
<!--启用iCheck响应checkbox与radio表单控件-->
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.table-operation input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
    $(document).ready(function(){
      $('input[type=radio][name=spider_method]').iCheck({
        radioClass: 'iradio_square-green',
        increaseArea: '20%' // optional
      });
    });
    $('input[type=radio][name=spider_method]').on('ifClicked', function(event) {
      if (this.value == 'GET') {
          $('input[type=radio][name=spider_method][value=GET]').iCheck('check');
          $('input[type=radio][name=spider_method][value=POST]').iCheck('uncheck');
          addGetSpiderForm.hidden = false;
          addPostSpiderForm.hidden = true;
          addSpiderForm = addGetSpiderForm;
      }
      else {
          $('input[type=radio][name=spider_method][value=GET]').iCheck('uncheck');
          $('input[type=radio][name=spider_method][value=POST]').iCheck('check');
          addGetSpiderForm.hidden = true;
          addPostSpiderForm.hidden = false;
          addSpiderForm = addPostSpiderForm;
      }
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
        var clicks = $(this).data('clicks');
        if (clicks) {
        //Uncheck all checkboxes
        $(".table-operation input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
    } else {
        //Check all checkboxes
        $(".table-operation input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
    }
    $(this).data("clicks", !clicks);
});
</script>
@endsection
