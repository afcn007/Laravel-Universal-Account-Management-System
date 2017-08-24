@extends('layouts.front')
@section('content')
<section class="content-header">
	<h1>欢迎您来到{{ config('app.name') }}</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3>登录日志</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered">
				<thead>
					<th>#</th>
					<th>APP名称</th>
					<th>登陆时间</th>
				</thead>
				<tbody>
					@if (count($records) == 0)
					<tr>
						<td colspan="3" style="text-align:center;">您还没有任何登陆日志</td>
					</tr>
					@else 
					<?php $i = 1; ?>
					@foreach ($records as $record)

					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $record->name }}</td>
						<td>{{ $record->created_at }}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection