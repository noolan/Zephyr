@extends('layout.bootstrap')

@section('content')
	@parent
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>
		@foreach($assets as $asset)
			<tr>
				<td>{{ $asset->id }}</td>
				<td>{{ $asset->name }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop