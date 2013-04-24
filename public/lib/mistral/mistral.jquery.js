// Mistral 0.1.0 | Nolan Neustaeter | April 2013


(function($) {

	var methods = {
		init: function(options) {
			var settings = $.extend({}, options);
			return this.each(function() {

				if ($(this).is('form')) {
					$(this).submit(function() {
						methods.clearErrors;
						$.ajax({
							type: this.attr('method'),
							url:  this.attr('action'),
							dataType: 'json',
							data: this.serializeArray()
						}).done(function(results) {
							if (results.success) {
								methods.update(results.data);
								console.log('weeee', results);
							} else {
								methods.showErrors(results.errors);
							}
							return false;
						});

					});
				}

			});
		},
		showErrors: function(errors) {
			$.each(errors, function(key, value) {
				var element = this.find('[name="'+key+'"]');

				element.addClass('input-with-feedback');
				element.parent('div.control-group').addClass('has-error');
				element.sibling('span.[class*="help"]').html(value);
				element.bind('change.mistral', function() {
					this.removeClass('input-with-feedback');
					this.parent('div.control-group').removeClass('has-error');
					this.sibling('span.help-block').html('');
					this.unbind('change.mistral');
				});
			});
		},
		clearErrors: function() {
			this.find('.input-with-feedback').removeClass('.input-with-feedback');
			this.find('div.control-group').removeClass('has-error');
			this.find('span.help-block').html('');
		},
		update: function(values) {
			$.each(values, function(key, value) {
				this.find('#'+key).val(value);
			});
		}
	};

	$.fn.mistral = function(method) {
		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist' );
		}
	
	};
		
})( jQuery );