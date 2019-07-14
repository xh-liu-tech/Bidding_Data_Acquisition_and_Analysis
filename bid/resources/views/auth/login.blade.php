<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>登录</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.css") }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/iCheck/square/blue.css") }}">

  <link rel="stylesheet" href="{{ asset("anhui_bid.css") }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>Anhui</b>Bid</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">登录开始您的会话</p>

      <form action="{{ url('/login') }}" method="POST">
        {!! csrf_field() !!}
        <div class="form-group has-feedback form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input type="email" name="email" class="form-control" placeholder="电子邮箱" value="{{ old('email') }}">
		  @if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		  @endif
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <input type="password" name="password" class="form-control" placeholder="密码">
		  @if ($errors->has('password'))
			<span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
		  @endif
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="remember"> 记住我
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ url('/password/reset') }}">忘记密码</a><br>
      <a href="{{ url('/register') }}" class="text-center">新用户注册</a>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 2.1.4 -->
  <script src="{{ asset("/bower_components/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{ asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
  <!-- iCheck -->
  <script src="{{ asset("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
  <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  </script>
</body>
</html>
