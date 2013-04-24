@extends('layout.bootstrap')

@section('content')
	@parent
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Assets</th>
			</tr>
		</thead>
		<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{ $category->id }}</td>
				<td><a href="{{ URL::to('assets/'.Str::plural($category->name)) }}">{{ $category->name }}</a></td>
				<td>{{ count($category->assets) }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop