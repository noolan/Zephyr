@extends('layout.bootstrap')

@section('styles')
<style>
	#revisions { margin-top: 20px; }
	.title-row input, .title-row button, .title-row label, .title-row select {
		font-size:25px;
		margin:10px 0 20px 0;
	}
	.title-row button { font-size:20px; margin-left: 10px; }
	.title-row label {
		font-weight:300;
		display: block;
		padding-top: 12px;
	}
	.title-row select { height:42px; padding: 5px 9px; }
	.title-row div:first-child {
		padding-right: 0;
	}
	.title-row:nth-child(odd) { text-align: right; }
</style>
@stop

@section('scripts')
<script>
	$(document).ready(function() {
		$('.editor').redactor({ fixed: true });
	});
</script>
@stop

@section('content')
@parent
<?php $firstRevision = true; ?>
<div class="accordion" id="revisions">
  @foreach($revisions as $revision)
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#revisions" href="#revision{{ $revision->id }}">
        {{ $firstRevision ? 'Current Revision' : $revision->created_at }}
      </a>
    </div>
    <div id="revision{{ $revision->id }}" class="accordion-body collapse{{ $firstRevision ? ' in' : '' }}">
      <div class="accordion-inner">
        <form action="" method="post">
					<div class="row title-row">
						<div class="span1">
							<label for="title">Title:</label>
						</div>
						<div class="span4">
							<input name="name" type="text" placeholder="page title" value="{{ $revision->name }}">
						</div>
						<div class="span2">
							<label for="language">Language:</label>
						</div>
						<div class="span2">
							<select name="language">
								@foreach($languages as $language)
								<option value="{{ $language->abbreviation }}">{{ ucwords($language->name) }}</option>
								@endforeach
							</select>
						</div>
						<div class="span3 pull-right">
							<button type="submit" class=" btn btn-large btn-success save-button">save</button>
							<button class="btn btn-large btn-danger cancel-button">cancel</button>
						</div>
					</div>
					<textarea class="editor" name="content">{{ $revision->content }}</textarea>
				</form>
      </div>
    </div>
  </div>
  <?php $firstRevision = false; ?>
  @endforeach
</div>
@stop