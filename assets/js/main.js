jQuery(document).ready(function($) {
	const COOKIE_GENERAL = 'og-gdpr-saved';

	$(document).on('click', '.og-gdpr-button--close', function(event) {
		hideBox();

		event.preventDefault();
	});

	$(document).on('click', '.og-gdpr-button--reject-all', function(event) {
		const COOKIE_REJECT = 'og-gdpr-reject-all';

		const $form = $('.og-gdpr-settings-form');
		const values = $form.find('select');

		$.each(values, function(index, select) {
			const selected = $(select).val();
			const select_name = $(select).attr('name');
			createCookie(select_name, false, 365);
		});

		createCookie(COOKIE_REJECT, true, 365);

		event.preventDefault();
	});

	$(document).on('click', '.og-gdpr-button--hide-all', function(event) {
		createCookie(COOKIE_GENERAL, true, 365);

		hideBox();

		event.preventDefault();
	});

	$(document).on('click', '.og-gdpr-button--accept-all', function(event) {
		const $form = $('.og-gdpr-settings-form');
		const values = $form.find('select');

		$.each(values, function(index, select) {
			const selected = $(select).val();
			const select_name = $(select).attr('name');
			createCookie(select_name, true, 365);
		});

		location.reload();

		event.preventDefault();
	});

	$('.og-gdpr-settings-form').submit(function(event) {
		const $form = $(this);
		const values = $form.find('select');

		$.each(values, function(index, select) {
			const selected = $(select).val();
			const select_name = $(select).attr('name');

			createCookie(select_name, selected, 365);
		});

		createCookie(COOKIE_GENERAL, true, 365);

		window.location.replace(location.pathname);

		event.preventDefault();
	});

	$(document).on('click', '.og-gdpr-settings-overlay', function(event) {
		$(this).fadeOut();
		history.pushState("", document.title, window.location.pathname + window.location.search);

		event.preventDefault();
	});

	$(document).on('click', '.og-gdpr-settings-content', function(event) {
		event.stopPropagation();
	});

	if (window.location.hash == '#og-rodo') {
	  	$('.og-gdpr-settings-overlay').fadeIn();
	}
	$('[href="#og-rodo"]').off();
	$(document).on('click', '[href="#og-rodo"]', function(event) {
		$('.og-gdpr-settings-overlay').fadeIn();
	});
	$(window).on('hashchange', function(e) {
	    if (window.location.hash == '#og-rodo') {
		  	$('.og-gdpr-settings-overlay').fadeIn();
		}
	});

	$(document).on('click', '.og-gdpr-button--open-settings', function(event) {
		$('.og-gdpr-settings-overlay').fadeIn();

		event.preventDefault();
	});

	function hideBox() {
		$('.og-gdpr-wrapper').fadeOut();
	}

	function createCookie(name, value, days) {
		if ($('body.customize-partial-edit-shortcuts-shown').length) {
			return;
		}

		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			var expires = "; expires=" + date.toGMTString();
		}
		else var expires = "";

		const sameSite = 'samesite=strict;';

		document.cookie = name + "=" + value + expires + ";" + sameSite + " secure; path=/";
	}

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name, "", -1);
	}

	if ($('.og-gdpr-popup-top').length) {
		$('.og-gdpr-wrapper').prependTo('body');
	}
});
