@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ trans('admin.menu_list.permission') }}
      <small>{{ trans('page.total', ['total' => $total = $permissions->total()]) }}</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('public/message')
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">{{ trans('admin.menu_list.permission_list') }}</h3>
            <span class="pull-right"><button type="button" onclick="location='{{ url('admin/permissions/create') }}';" class="btn btn-success pull-right">{{ trans('common.add') }}</button></span>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>{{ trans('admin.permission.name') }}</th>
                <th>{{ trans('admin.permission.display_name') }}</th>
                <th>{{ trans('admin.permission.description') }}</th>
                <th>{{ trans('admin.created_at') }}</th>
                <th>{{ trans('admin.updated_at') }}</th>
                <th>#</th>
              </tr>
              @if ($permissions->total() > 0)
                @foreach($permissions as $permission)
                  <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->display_name }}</td>
                    <td>{{ str_limit($permission->description, 30) }}</td>
                    <td>{{ $permission->created_at }}</td>
                    <td>{{ $permission->updated_at }}</td>
                    <td>
                      <a href="{{ url('admin/permissions', [$permission->id]).'/edit' }}">{{ trans('common.manage') }}</a>
                      <a href="#" class="delete" onclick="del({{ $permission->id }})">{{ trans('common.delete') }}</a>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr><td style="text-align: center;" colspan="7">{{ trans('common.empty') }}</td></tr>
              @endif
            </table>
            {{ $permissions->links() }}
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
  </section>
  <form id="delete_form" action="" method="post">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
  </form>
@endsection
@section('js')
<script>
  function del(id)
  {
      bootbox.confirm('是否确定删除？', function (result) {
          if (result) {
              var template = '{{ url('/admin/permissions') }}' + '/' + id;
              $('#delete_form').attr('action', template).submit();
          }
      });
  }
</script>
@endsection