@extends('layout.bootstrap')

@section('content')
	@parent
	<form action="{{ $asset->exists ? URL::to('asset/'.$asset->id) : URL::to('asset') }}" method="post" class="form form-horizontal">
		<fieldset>
			<legend>{{ $title }}</legend>
			<input type="hidden" name="id" value="{{ $asset->id }}" />
			
			<div class="control-group">
				<label class="control-label" for="type_id">Type</label>
				<div class="controls">
					<div class="radio">
						<label>
							<input type="radio" name="type_id" id="purchase_type" value="{{ Asset::PURCHASE }}" {{ $asset->exists ? (($asset->type_id == Asset::PURCHASE) ? 'checked' : '') : 'checked' }}>
							Purchase
						</label><br>
						<label>
							<input type="radio" name="type_id" id="license_type" value="{{ Asset::LICENSE }}" {{ $asset->exists ? (($asset->type_id == Asset::LICENSE) ? 'checked' : '') : '' }}>
							License
						</label>
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="category">Category</label>
				<div class="controls">
					<select name="category">
						@foreach($categories as $category)
						<option value="{{ $category }}">{{ $category }}</option>
						@endforeach
					</select>
					<span class="help-block"></span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
					<input type="text" name="name" value="{{ $asset->name }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="manufacturer">Manufacturer</label>
				<div class="controls">
					<input type="text" name="manufacturer" value="{{ $asset->manufacturer }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="model">Model</label>
				<div class="controls">
					<input type="text" name="model" value="{{ $asset->model }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="fiscal_year">Fiscal Year</label>
				<div class="controls">
					<input type="text" name="fiscal_year" value="{{ $asset->fiscal_year }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="cost">Cost</label>
				<div class="controls">
					<input type="text" name="cost" value="{{ $asset->cost }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="replace_year">Replacement Year</label>
				<div class="controls">
					<input type="text" name="replace_year" value="{{ $asset->replace_year }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="replace_cost">Replacement Cost</label>
				<div class="controls">
					<input type="text" name="replace_cost" value="{{ $asset->replace_cost }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div id="renew" class="control-group" {{ ($asset->type_id == Asset::LICENSE) ? 'style="display: none;"' : '' }}>
				<label class="control-label" for="renew_until">Renew Until</label>
				<div class="controls">
					<input type="text" name="renew_until" value="{{ $asset->renew_until }}" />
					<span class="help-block"></span>
				</div>
			</div>

			<div class="form-actions">
			  <button type="submit" class="btn {{ $asset->exists ? 'btn-warning' : 'btn-primary' }}">{{ $asset->exists ? 'Update' : 'Create' }} asset</button>
			  <button type="button" class="btn">Cancel</button>
			</div>

		</fieldset>
	</form>
@stop

@section('scripts')
<script>
	$(document).ready(function() {
		$('#lease_type').click(function() {
			console.log($('input[name="type_id"]:checked').val());
			if ($('input[name="type_id"]:checked').val() == {{ Asset::LICENSE }})
				$('#renew').slideDown();
			else
				$('#renew').slideUp();
		});
	});
</script>
@stop