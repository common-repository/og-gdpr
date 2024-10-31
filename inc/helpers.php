<?php
function og_gdpr_get_plugin_path( $file = '' ) {
	return plugin_dir_path( OG_GDPR_PATH__FILE__ ) . $file;
}

function og_gdpr_get_plugin_url( $file = '' ) {
	return plugins_url( $file, OG_GDPR_PATH__FILE__ );
}

function og_gdpr_load_template( $template_name, $args = array() ) {
	$template = og_gdpr_get_plugin_path( "templates/$template_name" );
	$theme_template = locate_template( "templates/og-gdpr/$template_name" );

	if ( $theme_template ) {
		$template = $theme_template;
	}

	load_template( $template, true, $args );
}

function og_gdpr_get_cookie_name( $cookie ) {
	if ( empty( $cookie ) ) {
		return;
	}

	$cookie = sanitize_title( $cookie );

	return "og-gdpr-$cookie";
}

function og_gdpr_check_cookie( $service_name ) {
	_deprecated_function( __FUNCTION__, '1.0.4', 'og_gdpr_check_consent()' );

	return og_gdpr_check_consent( $service_name );
}

function og_gdpr_check_consent( $service_name ) {
	$cookie_name = og_gdpr_get_cookie_name( $service_name );
	if ( ! isset( $_COOKIE[$cookie_name] ) ) {
		return false;
	}

	return sanitize_text_field( $_COOKIE[$cookie_name] );
}

function og_gdpr_check_gpc() {
	return ! empty( $_SERVER['HTTP_SEC_GPC'] );
}
