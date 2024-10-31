jQuery(document).ready(function($) {
	$('.og-sanitized-name').hide();
	$('.og-sanitized-name input').attr('readonly', true);
	$('.og-sanitized-name input').each(function(index, el) {
		if ($(el).val()) {
			$(el).parents('.og-sanitized-name').show();
		}
	});
	$('.og-sanitized-name .description code span').each(function(index, el) {
		$this = $(this);
		$parent = $this.parents('.og-sanitized-name');

		$sanitized_name = $parent.find('input').val();
		$sanitized_name = $sanitized_name.replace('og-gdpr-', '');
		$this.text($sanitized_name);
	});

	$('.og-force-enable input:checked').each(function(index, el) {
		const $this = $(el);
		const $parent = $this.parents('.og-gdpr-section-table');

		if ( $this.val() == true ) {
			$parent.find('.og-script-field, .og-sanitized-name, .og-is-oembed').hide();
		} else {
			$parent.find('.og-script-field, .og-sanitized-name, .og-is-oembed').show();
		}
	});

	$(document).on('change', '.og-force-enable input', function(event) {
		const $this = $(this);
		const $parent = $this.parents('.og-gdpr-section-table');

		if ( this.checked ) {
			$parent.find('.og-script-field, .og-sanitized-name, .og-is-oembed').hide();
		} else {
			$parent.find('.og-script-field, .og-sanitized-name, .og-is-oembed').show();
		}


		event.preventDefault();
	});

	$('.og-is-oembed input:checked').each(function(index, el) {
		const $this = $(el);
		const $parent = $this.parents('.og-gdpr-section-table');

		if ( $this.val() == 'yes' ) {
			$parent.find('.og-oembed-select').show();
			$parent.find('.og-force-enable').hide();
		} else {
			$parent.find('.og-oembed-select').hide();
			$parent.find('.og-force-enable').show();
		}
	});

	$(document).on('change', '.og-is-oembed input', function(event) {
		const $this = $(this);
		const $parent = $this.parents('.og-gdpr-section-table');

		if ( this.value == 'yes' ) {
			if (!$parent.find('.og-service-name input').val()) {
				$oembed_name = $parent.find('.oembed').text();
				$parent.find('.og-service-name input').val($oembed_name);
			}

			$parent.find('.og-oembed-select').show();
			$parent.find('.og-force-enable').hide();
		} else {
			$parent.find('.og-oembed-select').hide();
			$parent.find('.og-force-enable').show();
		}

		event.preventDefault();
	});

	$(document).on('change', '.og-oembed-select select', function(event) {
		const $this = $(this);
		const $parent = $this.parents('.og-gdpr-section-table');

		if (!$parent.find('.og-service-name input').val()) {
			const selected = $this.children('option:selected').text();
			$parent.find('.og-service-name input').val(selected);
		}

		event.preventDefault();
	});
});
