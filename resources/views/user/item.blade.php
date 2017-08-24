@extends('layouts.admin')

@section('content')
<section class="content-header">
  <h1>{{ trans('admin.menu_list.user') }}</h1>
</section>
<section class="content">
  @include('public/message')
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">
        {{ $create == true ? trans('admin.menu_list.user_add') : trans('admin.menu_list.user_edit')  }}
        <small>{{ $create == false ? "User Id:" . $user->id : "" }}</small>
      </h3>
    </div>
    <form class="form-horizontal" action="{{ $create == true ? url('/admin/users') : url('/admin/users/' . $user->id) }}" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">{{ trans('common.username') }}</label>
          <div class="col-sm-10">
            @if($create)
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
            @else
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly />
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">{{ trans('common.email') }}</label>
          <div class="col-sm-10">
            @if ($create)
            <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" />
            @else
            <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly />
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="role" class="col-sm-2 control-label">{{ trans('common.role') }}</label>
          <div class="col-sm-10">
            <select class="form-control" multiple name="roles[]" title="role" id="role-select">
              @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $create == false && $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">{{ trans('common.mobile') }}</label>
          <div class="col-sm-10">
            @if($create)
            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" />
            @else
            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" />
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-2 control-label">{{ trans('common.nickname') }}</label>
          <div class="col-sm-10">
            @if($create)
            <input type="text" id="nickname" class="form-control" name="nickname" value="{{ old('nickname') }}" />
            @else
            <input type="text" id="nickname" class="form-control" name="nickname" value="{{ $user->nickname }}" />
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="sex" class="col-sm-2 control-label">{{ trans('common.sex') }}</label>
          <div class="col-sm-10">
            <select name="sex" class="form-control">
              <option value="0">{{ trans('common.sex_select') }}</option>
              <option value="0" {{ $create == false && $user->sex == 0 ? "selected" : "" }}>{{ trans('common.sex_0') }}</option>
              <option value="1" {{ $create == false && $user->sex == 1 ? "selected" : "" }}>{{ trans('common.sex_1') }}</option>
              <option value="2" {{ $create == false && $user->sex == 2 ? "selected" : "" }}>{{ trans('common.sex_2') }}</option>
            </select>
          </div>
        </div>
        @if(!$create)
        <div class="form-group">
          <label for="avatar" class="col-sm-2 control-label">{{ trans('common.avatar') }}</label>
          <div class="col-sm-10">
            <label>
              <img id="avatar-img" style="cusor: pointer" class="profile-user-img img-responsive img-circle pull-left" src="{{ $user->avatar }}" alt="User profile picture">
              <input id="avatar-input" type="hidden" name="avatar" value="{{ $user->avatar }}" />
              <input style="display: none" type="file" name="avatar-file" data-url="{{ url('/user/avatar', ['id' => $user->id]) }}" id="avatar" />
            </label>
          </div>
        </div>
        @endif

        <div class="form-group">
          <label for="province" class="col-sm-2 control-label">{{ trans('common.province') }}</label>
          <div class="col-sm-10">
            <select class="form-control" name="province" id="province">
              @foreach ($provinces as $province)
                <option {{ $create == false && $user->province == $province['id'] ? 'selected' : '' }} value="{{ $province['id'] }}">{{ $province['name'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-sm-2 control-label">{{ trans('common.city') }}</label>
          <div class="col-sm-10">
            <select class="form-control" name="city" id="city">
              <option value="0">请选择城市</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="area" class="col-sm-2 control-label">{{ trans('common.area') }}</label>
          <div class="col-sm-10">
            <select name="area" class="form-control" id="area">
              <option value="0">请选择区/县</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-2 control-label">{{ trans('common.description') }}</label>
          <div class="col-sm-10">
            <textarea id="description" name="description" title="description" class="form-control">{{ $create == true ? "" : $user->description }}</textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">
            {{ trans('common.password') }}
          </label>
          <div class="col-sm-10">
            <input type="password" id="password" name="password" class="form-control" value="" />
          </div>
        </div>
        <div class="form-group">
          <label for="password_confirmation" class="col-sm-2 control-label">{{ trans('common.password_confirmation') }}</label>
          <div class="col-sm-10">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" />
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{ csrf_field() }}
        <button type="button" class="btn btn-cancel pull-left" onclick="location='{{ url('admin/users') }}'">返回</button>
        @if(!$create)
          <button type="submit" class="btn btn-info pull-right">{{ trans('common.edit') }}</button>
          {{ method_field('PUT') }}
        @else
          <button type="submit" class="btn btn-success pull-right">{{ trans('common.add') }}</button>
        @endif
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
  <!-- /.box -->
</section>
@endsection

@section('js')
<script>
  $(function(){
    $('#avatar').AjaxFileUpload({
      action: $('#avatar').attr('data-url'),
      onComplete: function(filename, response) {
        if (response.status == 'success') {
          $('#avatar-img').attr('src', '/' + response.path + '?t=' + Math.random());
          $('#avatar-input').val(response.path);
        } else {
          alert(response.msg);
        }
      },
      onSubmit: function() {
        return {'_token': '{{ csrf_token() }}'};
      }
    });
    $('#province').change(function(){
        var $option = $(this).find("option:selected");
        getRegion('city',$option.val(),1,0);
    });

    $('#city').change(function() {
        var $option = $(this).find("option:selected");
        getRegion('area',$option.val(),2,0);
    });

    var provinceDefaultId = $('#province').find("option:selected").val();
    var cityDefaultId = {{ isset($user) ? (int)$user->city : 0 }};
    var areaDefaultId = {{ isset($user) ? (int)$user->area : 0}};
    if (provinceDefaultId > 0) {
        getRegion('city', provinceDefaultId, 1, cityDefaultId);
        if (cityDefaultId > 0) {
            getRegion('area', cityDefaultId, 2, areaDefaultId);
        }
    }
  });

  function getRegion(_nextId, _pid, _type, _defalutId) {
      var $region = $('#'+_nextId);
      $region.html('<option value="0" selected>{{ trans('common.select') }}</option>');
      $.get('/user/region?type='+_type+'&pid='+_pid,function(data){
          if (data.status == 0) {
              var _list = data.list;
              if ($(_list).first().length != 0) {
                  $region.show();
                  $.each(_list, function(i,val){
                      $region.append('<option '+( val.id == _defalutId ? 'selected' : '' )+' value="'+val.id+'">'+val.name+'</option>');
                  });
                  $region.trigger('change');
              } else {
                  $region.hide();
              }
          }
      });
  }
</script>
@endsection
