@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    用户管理
    <small>共{{ $countAllNum }}行</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
    <li class="active">用户列表</li>
  </ol>
</section>
<section class="content">
  @include('public/message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">搜索栏</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <form action={{ url("/admin/users") }}>
              <div class="col-lg-2">
                <input name="name" value="{{ isset($inputs['name']) ? $inputs['name'] : '' }}" title="name" type="text" class="form-control" placeholder="用户名" />
              </div>
              <div class="col-lg-2">
                <input name="mobile" value="{{ isset($inputs['mobile']) ? $inputs['mobile'] : '' }}" type="text" class="form-control" placeholder="手机号" />
              </div>
              <div class="col-lg-2">
                <input name="email" value="{{ isset($inputs['email']) ? $inputs['email'] : '' }}" type="text" class="form-control" placeholder="邮箱" />
              </div>
              <div class="col-lg-2">
                <input name="nickname" value="{{ isset($inputs['nickname']) ? $inputs['nickname'] : '' }}" type="text" class="form-control" placeholder="昵称" />
              </div>
              <div class="col-lg-2">
                <select name="sex" class="form-control">
                  <option value>请选择性别</option>
                  <option value="0" {{ isset($inputs['sex']) && $inputs['sex'] == 0 ? "selected" : "" }}>未知</option>
                  <option value="1" {{ isset($inputs['sex']) && $inputs['sex'] == 1 ? "selected" : "" }}>男</option>
                  <option value="2" {{ isset($inputs['sex']) && $inputs['sex'] == 2 ? "selected" : "" }}>女</option>
                </select>
              </div>
              <div class="col-lg-2">
                <button type="submit" class="btn btn-default col-md-6">搜索</button>
                <button type="button" class="btn btn-default col-md-6" onclick="location.href='{{ url('/admin/users') }}'">重置</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">用户列表</h3>
          <span class="pull-right">
            <a href="{{ url('/admin/users/create') }}" class="btn btn-success">添加</a>
          </span>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>角色</th>
                <th>头像</th>
                <th>昵称</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>手机号</th>
                <th>性别</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>@foreach($user->roles() as $role)
                    {{ $role->name }}
                    @endforeach
                  </td>
                  <td><img src="{{ $user->avatar }}" width="30" /></td>
                  <td>{{ $user->nickname }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->mobile }}</td>
                  <td>{{ $user->sex == 0 ? "未知" : (($user->sex == 1) ? "男" : "女") }}</td>
                  <td><a href="{{ url('admin/users', ['id'=>$user->id]).'/edit' }}">编辑</a> <a href="javascript:del_item({{ $user->id }})">删除</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
</section>
<form action="url('admin/users')" id="delete_form" method="post">
  {{ method_field('DELETE') }}
  {{ csrf_field() }}
</form>
@endsection
@section('js')
<script>

  function del_item(id) {
    bootbox.confirm("是否确定删除？", function(result){
        if (result) {
            var action = '{{ url('admin/users') }}' + '/' + id;
            $("#delete_form").attr("action", action).submit();
        }
        
    });
  }
</script>
@endsection