<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/Ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/iCheck/square/blue.css') }}" rel="stylesheet">
</head>
<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      {{ config('app.name') }}
    </div>
    <div class="register-box-body">
      <p class="login-box-msg">重设密码</p>
      <form action="{{ route('password.email') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback{{ $errors->has('email') ? 'has-error' : '' }}">
          <input type="text" class="form-control" placeholder="邮箱" value="{{ old('email') }}" required>
          @if ($errors->has('email'))
            <span class="help_block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">发送密码重设邮件</button>
        </div>
      </form>
    </div>
  </div>
  <!-- jQuery 3.2.1 -->
  <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
