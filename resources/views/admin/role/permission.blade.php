@extends('layouts.admin')

@section('content')
<section class="content-header">
  <h1>{{ trans('admin.menu_list.role_edit') }}</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-md-12">
    <form id="save-perms-form">
      {{ csrf_field() }}
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">
            {{ $role->display_name }}
            <small>{{ $role->name }}</small>
          </h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php $i = 1; ?>
            @foreach($permissions as $permission)
              <div class="form-group col-sm-3">
                <label class="data-toggle=tooltip" data-placement="bottom" title="{{ $permission->description }}">
                <input @foreach($role->perms as $perm) @if($perm->id == $permission->id) checked 
                      @endif
                      @endforeach type="checkbox" class="minimal" name="perms[]" value="{{ $permission->id }}">
                      &nbsp;
                      {{ $permission->name }} 
                </label>  
              </div>
            @if ($i % 4 == 0)
            </div>
            <div class="row">
            @endif
            <?php $i++; ?>
            @endforeach

          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="hidden" name="id" value="{{ $role->id }}" />
          <button type="button" id="save-perms-btn" class="btn btn-info pull-right">{{
          trans('common.save')
          }}</button>
        </div>
      </div>
    </form>
    <!-- /.box -->
  </div>
  <!-- /.col (right) -->
</div>
<!-- /. row -->
</section>
@endsection

@section('js')
<script>
  $(function(){
    $('#save-perms-btn').click(function() {
      $.post('{{ url('admin/roles/permission') }}' + '/' + {{ $role->id }}, $('#save-perms-form').serialize(), function(response) {
        alert(response.msg);
      });
    });
  });

</script>
@endsection
