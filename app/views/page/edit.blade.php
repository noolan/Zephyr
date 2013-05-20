@extends('layout.bootstrap')

@section('styles')
<style>

.accordion-inner {
	padding: 15px 0 0 0;
}
#form-actions {
	text-align: right;
	margin-bottom: 15px;
}
#content {
	padding: 10px 15px;
	border-top: 1px solid #eee;
}
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
        <form class="form-inline" action="" method="post">
        	@if($firstRevision)
        	<div class="col col-lg-4">
						<input name="name" type="text" placeholder="page title" value="{{ $revision->name }}">
					</div>
					<div class="col col-lg-2 col-offset-2">
						<select name="language">
							@foreach($languages as $language)
							<option value="{{ $language->abbreviation }}">{{ ucwords($language->name) }}</option>
							@endforeach
						</select>
					</div>
					<div id="form-actions" class="col col-lg-4 pull-right">
						<button type="submit" class=" btn btn-success save-button">save changes</button>
						<button class="btn btn-warning cancel-button">cancel</button>
					</div>
					<div class="clearfix"></div>
					<textarea class="editor" name="content">{{ $revision->content }}</textarea>
					@else
					<div class="col col-lg-4">
						<input name="name" type="text" class="hide" placeholder="page title" value="{{ $revision->name }}">
						<h2 style="margin:0;">{{ $revision->name }}</h3>
					</div>
					<div id="form-actions" class="col col-lg-4 pull-right">
						<button type="submit" class=" btn btn-danger save-button">revert back to this version</button>
					</div>
					<div class="clearfix"></div>
					<textarea name="content" class="hide">{{ $revision->content }}</textarea>
					<div id="content">{{ $revision->content }}</div>
					@endif
					
				</form>
      </div>
    </div>
  </div>
  <?php $firstRevision = false; ?>
  @endforeach
</div>
@stop