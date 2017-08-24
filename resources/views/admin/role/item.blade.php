@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ trans('admin.menu_list.role') }}
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('public/message')
    <div class="box box-info">
      <div class="box-header with-border">
        @if ($create)
          <h3 class="box-title">{{ trans('admin.menu_list.role_add') }}</h3>
        @else
          <h3 class="box-title">{{ trans('admin.menu_list.role_edit') }}
            <small>Role Id: {{ $role->id }}</small>
          </h3>
        @endif
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{ $create == true ? url('admin/roles') : url('admin/roles', [$role->id]) }}" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('admin.role.name') }}</label>
            <div class="col-sm-10">
              @if (isset($role))
              <input type="text" class="form-control" id="name" value="{{ $role->name }}" readonly>
              @else
              <input type="text" class="form-control" id="name" name="role_name" value="{{ old('role_name') }}">
              @endif
            </div>  
          </div>
          <div class="form-group">
            <label for="display_name" class="col-sm-2 control-label">{{ trans('admin.role.display_name') }}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="display_name" name="role_display_name" value="{{ isset($role) ? $role->display_name : old('role_display_name') }}">
            </div>
          </div>
          <div class="form-group">
            <label for="description" class="col-sm-2 control-label">{{ trans('admin.role.description') }}</label>
            <div class="col-sm-10">
              <textarea id="description" title="description" name="role_description" class="form-control">{{ isset($role) ? $role->description : old('role_description') }}</textarea>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        {{ csrf_field() }}
        <button type="button" class="btn btn-cancel pull-left" onclick="location='{{ url('admin/roles') }}'">{{ trans('common.return') }}</button>
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