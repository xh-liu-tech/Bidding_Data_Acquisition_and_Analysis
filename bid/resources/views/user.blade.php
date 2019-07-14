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
                <h3 class="box-title">用户列表</h3>
                @include('partials.errors')
                @include('partials.success')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="tablebox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o" title="全选/反全选"></i></button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-trash-o" title="删除"></i></button>
                    <a class="btn btn-default btn-sm" href="/spider"><i class="fa fa-refresh" title="刷新"></i></a>
                </div>
                <br>
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>选择</th>
                            <th>姓名(name)</th>
                            <th>电子邮箱(email)</th>
                            <th>权限(authority)</th>
                            <th>创建时间(created_at)</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tr>
                        <td class="table-operation"><input type="checkbox" value="{{ $user->id }}" name="checkbox[]"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->authority == 0)
                                管理员 - 0
                            @elseif ($user->authority == 1)
                                统计分析员 - 1
                            @else
                                普通用户 - 2
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">修改信息</button>
                            <form action="/user/{{ $user->id }}" method="POST" style="display: inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">删除用户</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <th>选择</th>
                            <th>姓名(name)</th>
                            <th>电子邮箱(email)</th>
                            <th>权限(authority)</th>
                            <th>创建时间(created_at)</th>
                            <th>操作</th>
                        </tr>
                    </tfoot>
                </table>
                @foreach ($users as $user)
                <div id="editUserModal{{ $user->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">详细信息</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="/user/{{ $user->id }}" id="editUserForm{{ $user->id }}">
                                    <div class="box-body">
                                        <input name="_method" type="hidden" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">姓名<br>(name)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" name="name" placeholder="姓名" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">电子邮箱<br>(email)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEmail" name="email" placeholder="电子邮箱" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-2 control-label">密码<br>(留空不修改)</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputEmail" name="password" placeholder="密码">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPasswordConfirmation" class="col-sm-2 control-label">确认密码<br>(留空不修改)</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" placeholder="确认密码">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAuthority" class="col-sm-2 control-label">权限<br>(authority)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputAuthority" name="authority" placeholder="权限" value="{{ $user->authority }}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning" data-dismiss="modal" onclick="submitForm(editUserForm{{ $user->id }})">修改</button>
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
$(function () {
    $("#userTable").DataTable();
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
