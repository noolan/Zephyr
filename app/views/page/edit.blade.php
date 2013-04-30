@extends('layout.bootstrap')

@section('styles')
<style>
	#title-row input, #title-row button, #title-row label {
		font-size:25px;
		margin:10px 0;
	}
	#title-row button { font-size:20px; margin-left: 10px;}
	#title-row label {
		font-weight:300;
		display: block;
		padding-top: 12px;
	}

	#title-row div:first-child {
		padding-right: 0;
	}
	#title-row:nth-child(odd) { text-align: right; }

</style>
@stop

@section('scripts')
<script>
	$(document).ready(function() {
		$('#editor').redactor({ fixed: true });
	});
</script>
@stop

@section('content')
@parent
<form id="page" action="" method="post">
	<div id="title-row" class="row">
		<div class="span1">
			<label for="title">Title:</label>
		</div>
		<div class="span4">
			<input name="title" type="text" placeholder="page title" value="{{ $page->name }}">
		</div>
		<div class="span4 pull-right">
			<button id="save" class="btn btn-large btn-success">save</button>
			<button id="save" class="btn btn-large btn-danger">cancel</button>
		</div>
	</div>
	<textarea id="editor" name="content">{{ $page->content }}</textarea>
</form>
@stop