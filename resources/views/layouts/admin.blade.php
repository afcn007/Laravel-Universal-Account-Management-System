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
    <!-- Theme style -->
    <link href="{{ asset('vendor/adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/morris.js/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jvectormap/jquery-jvectormap.css') }}" rel="stylesheet">
    <!-- Daterange picker -->
    <link href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{ asset('vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper" id="app">
    <header class="main-header">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>U</b>C</span>
        <!-- logo for require state and mobile devices -->
        <span class="logo-lg">{{ config('app.name') }}</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->avatar }}" class="user-image" alt="用户头像">
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="用户头像">

                  <p>
                    {{ Auth::user()->name }}
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('user/profile') }}" class="btn btn-default btn-flat">个人信息</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                    退出
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side colun. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="用户头像">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
          </div>
          <!-- sidebar menu: style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">主导航</li>
            <li class="{{ folderLinksActive([url('/admin/setting')]) }} treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>站点配置</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ linkActive(url('/admin/setting')) }}">
                  <a href="{{ url('/admin/setting') }}">
                    <i class="fa fa-circle-o"></i> <span>站点配置</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="{{ folderLinksActive([url('/admin/users')]) }} treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>用户管理</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ linkActive(url('/admin/users')) }}">
                  <a href="{{ url('/admin/users') }}">
                    <i class="fa fa-circle-o"></i> <span>用户管理</span>
                  </a>
                </li>
                <li class="{{ linkActive(url('/admin/users/create')) }}">
                  <a href="{{ url('/admin/users/create') }}">
                    <i class="fa fa-circle-o"></i> <span>新增用户</span>
                  </a>
                </li>

              </ul>              
            </li>
            <li class="{{ folderLinksActive([url('/admin/roles'), url('/admin/permissions')]) }} treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>权限角色管理</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ linkActive(url('/admin/roles')) }}">
                  <a href="{{ url('/admin/roles') }}">
                    <i class="fa fa-circle-o"></i> <span>角色管理</span>
                  </a>
                </li>
                <li class="{{ linkActive(url('/admin/permissions')) }}">
                  <a href="{{ url('/admin/permissions') }}">
                    <i class="fa fa-circle-o"></i> <span>权限管理</span>
                  </a>
                </li>

              </ul>              
            </li>
            <li class="{{ folderLinksActive([url('/admin/clients')]) }} treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>OAuth接口管理</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ linkActive(url('/admin/clients')) }}">
                  <a href="{{ url('/admin/clients') }}">
                    <i class="fa fa-circle-o"></i> <span>OAuth客户端管理</span>
                  </a>
                </li>
              </ul>              
            </li>
          </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
