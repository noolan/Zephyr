@layout('bootstrap')

@section('content')
	<h1>{{ $page->title }}</h1>
	<div id="content">
		{{ $page->content }}
	</div>
@endsection