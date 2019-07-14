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
                <h3 class="box-title">企业数据统计</h3>
                @include('partials.errors')
                @include('partials.success')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" name="company" class="form-control" id="inputCompany" placeholder="关键词">
                    </div>
                  <button type="button" class="btn btn-default" onclick="showCompany(inputCompany.value)">查询企业</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-xs-12" id="companyList">
    </div>
</div>

@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- iCheck -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
<script>
function showCompany(company) {
    htmlobj = $.ajax({url:"/company/"+company,async:false});
    $("#companyList").html(htmlobj.responseText);
}
</script>
@endsection
