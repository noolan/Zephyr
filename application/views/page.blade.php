@layout('bootstrap')

@section('content')
	<h1>{{ $page->title }}</h1>
	<div id="content">
		{{ $page->text }}
	</div>
@endsection