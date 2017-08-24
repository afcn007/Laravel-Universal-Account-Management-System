@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    站点配置
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
    <li class="active">站点配置</li>
  </ol>
</section>
<section class="content">
@include('public/message')
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('admin.menu_list.setting') }}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" action="{{ url('admin/setting') }}" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="app_name" class="col-sm-2 control-label">{{ trans('admin.settings.app_name') }}</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="app_name" name="app_name" value="{{ array_get($settings, 'app_name', old('app_name')) }}" >
          </div>
        </div>
        <div class="form-group">
          <label for="cdn_url" class="col-sm-2 control-label">{{ trans('admin.settings.cdn_url') }}</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="cdn_url" name="cdn_url" value="{{ array_get($settings, 'cdn_url', old('cdn_url', '/')) }}" >
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success pull-right">{{ trans('common.save') }}</button>
      </div>
    </form>
  </div>
</section>

@endsection
