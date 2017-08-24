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
      <p class="login-box-msg">注册一个新用户</p>

      <form action="{{ route('register') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback{{ $errors->has('name') ? 'has-error' : '' }}">
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="用户名">
          @if ($errors->has('name'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback{{ $errors->has('email') ? 'email' : '' }}">
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="邮箱">
          @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback{{ $errors->has('password') ? 'has-error' : '' }}">
          <input type="password" name="password" id="password" class="form-control" placeholder="密码">
          @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="再输一次密码">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">注册</button>
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
