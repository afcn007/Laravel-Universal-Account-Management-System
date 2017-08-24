@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ trans('admin.menu_list.permission') }}
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('public/message')
    <div class="box box-info">
      <div class="box-header with-border">
        @if ($create)
          <h3 class="box-title">{{ trans('admin.menu_list.permission_add') }}</h3>
        @else
          <h3 class="box-title">{{ trans('admin.menu_list.permission_edit') }}
            <small>Permission Id: {{ $permission->id }}</small>
          </h3>
        @endif
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{ $create == true ? url('admin/permissions') : url('admin/permissions', [$permission->id]) }}" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('admin.permission.name') }}</label>
            <div class="col-sm-10">
              @if (isset($permission))
              <input type="text" class="form-control" id="name" value="{{ $permission->name }}" readonly>
              @else
              <input type="text" class="form-control" id="name" name="permission_name" value="{{ old('permission_name') }}">
              @endif
            </div>  
          </div>
          <div class="form-group">
            <label for="display_name" class="col-sm-2 control-label">{{ trans('admin.permission.display_name') }}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="display_name" name="permission_display_name" value="{{ isset($permission) ? $permission->display_name : old('permission_display_name') }}">
            </div>
          </div>
          <div class="form-group">
            <label for="description" class="col-sm-2 control-label">{{ trans('admin.permission.description') }}</label>
            <div class="col-sm-10">
              <textarea id="description" title="description" name="permission_description" class="form-control">{{ isset($permission) ? $permission->description : old('permission_description') }}</textarea>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        {{ csrf_field() }}
        <button type="button" class="btn btn-cancel pull-left" onclick="location='{{ url('admin/permissions') }}'">{{ trans('common.return') }}</button>
        @if (!$create)
          {{ method_field('PUT') }}
          <button type="submit" class="btn btn-info pull-right">{{ trans('common.edit') }}</button>
        @else
          <button type="submit" class="btn btn-info pull-right">{{ trans('common.add') }}</button>
        @endif
        </div>
      </form>
    </div>
  </section>
@endsection
@section('js')

@endsection