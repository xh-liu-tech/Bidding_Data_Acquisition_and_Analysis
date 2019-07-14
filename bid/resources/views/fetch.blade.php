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
                    <a href="/fetch/start" class="btn btn-success btn-md pull-right">
                        <i class="fa fa-plus-circle"></i> 开始爬取
                    </a>
                </div>
                <br>
                <table id="spiderTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>爬虫名</th>
                            <th>爬取方式</th>
                            <th>已启用</th>
                        </tr>
                    </thead>
                    @foreach ($get_spiders as $get_spider)
                    <tr>
                        <td>{{ $get_spider->name }}</td>
                        <td>GET</td>
                        <td>
                            @if ($get_spider->enable == 0)
                                否
                            @else
                                是
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($post_spiders as $post_spider)
                    <tr>
                        <td>{{ $post_spider->name }}</td>
                        <td>POST</td>
                        <td>
                            @if ($post_spider->enable == 0)
                                否
                            @else
                                是
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <th>爬虫名</th>
                            <th>爬取方式</th>
                            <th>已启用</th>
                        </tr>
                    </tfoot>
                </table>
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
@endsection
