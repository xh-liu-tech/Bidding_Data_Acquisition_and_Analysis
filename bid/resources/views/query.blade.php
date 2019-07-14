@extends('template')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css") }}">
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css") }}">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">查询条件</h3>
                @include('partials.errors')
                @include('partials.success')
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="queryForm" class="form-horizontal" method="POST" action="/query">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="inputName" class="col-sm-3 control-label">项目名称</label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="项目名称">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="inputCompany" class="col-sm-3 control-label">中标单位</label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control" id="inputCompany" name="company" placeholder="中标单位">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="inputPriceFloor" class="col-sm-3 control-label">中标金额</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPriceFloor" name="priceFloor" placeholder="中标金额">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="inputPriceCeiling" class="col-sm-3 control-label">至</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPriceCeiling" name="priceCeiling" placeholder="中标金额">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-sm-3 control-label">时间范围</label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="date" id="reservation">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success col-sm-2 col-sm-offset-5">查询</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">中标信息</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped" id="bidTable">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js") }}"></script>
<!-- iCheck -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
<script type="text/javascript">
$(function () {
    $('#reservation').daterangepicker({
        format: 'YYYY-MM-DD'
    });
});
$("#queryForm").submit(function(event) {
  /* stop form from submitting normally */
  event.preventDefault();

  /* get some values from elements on the page: */
  var $form = $( this ),
  url = $form.attr( 'action' );

  /* Send the data using post */
  //alert($('#_token').val();
  var posting = $.post( url, {
      _token: $('#_token').val(),
      name: $('#inputName').val(),
      company: $('#inputCompany').val(),
      priceFloor: $('#inputPriceFloor').val(),
      priceCeiling: $('#inputPriceCeiling').val(),
      date: $('#reservation').val()
  });

  /* Alerts the results */
  posting.done(function( data ) {
    $('#bidTable').html(data);
    $("#bidTable").DataTable();
  });
});
</script>
@endsection
