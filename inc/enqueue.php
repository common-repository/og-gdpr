<?php
function og_gdpr_enqueue_admin_scripts() {
	wp_register_style( 'og-gdpr-admin', og_gdpr_get_plugin_url( '/assets/css/admin.css' ), false, '1.0.6' );
	wp_enqueue_style( 'og-gdpr-admin' );

	wp_register_script( 'og-gdpr-admin', og_gdpr_get_plugin_url( '/assets/js/admin.js' ), array( 'jquery' ), '1.0.6', true );
	wp_enqueue_script( 'og-gdpr-admin' );
}
add_action( 'admin_enqueue_scripts', 'og_gdpr_enqueue_admin_scripts' );

function og_gdpr_enqueue_scripts() {
	wp_register_style( 'og-gdpr', og_gdpr_get_plugin_url( '/assets/css/style.css' ), false, '1.0.6' );
	wp_enqueue_style( 'og-gdpr' );

	$custom_css = get_theme_mod( 'og_gdpr_css' );
	wp_add_inline_style( 'og-gdpr', $custom_css );

	wp_register_script( 'og-gdpr', og_gdpr_get_plugin_url( '/assets/js/main.js' ), array( 'jquery' ), '1.0.6', true );
	wp_enqueue_script( 'og-gdpr' );
}
add_action( 'wp_enqueue_scripts', 'og_gdpr_enqueue_scripts', 30 );

function og_gdpr_print_head_scripts() {
	if ( empty( $_COOKIE['og-gdpr-saved'] ) ) {
		return;
	}

	$settings = get_option( 'OG_GDPR' );
	$services = $settings['services'];

	foreach ( $services as $key => $service ) {
		if ( empty( $service['position'] ) ) {
			continue;
		}

		if ( $service['position'] != 1 ) {
			continue;
		}

		$force = ! empty( $service['service_force'] );
		$force = ! empty( $force ) && empty( $service['is_oembed'] ) ? false : $force;
		if ( $force ) {
			continue;
		}

		if ( ! empty( $service['code'] ) ) {
			$service_name = $service['name'];
			$service_cookie = $service_name;
			if ( ! empty( $service['is_oembed'] ) && $service['is_oembed'] == 'yes' ) {
				$service_cookie = $service['oembed'];
			}

			if ( og_gdpr_check_consent( $service_cookie ) !== 'true' ) {
				continue;
			}

			$code = '<!-- GDPR WP - ' . $service['name'] . ' -->';
			$code .= $service['code'];
			$code .= '<!--  /GDPR WP - ' . $service['name'] . ' -->';

			echo $code;
		}
	}
}
add_action( 'wp_print_scripts', 'og_gdpr_print_head_scripts' );

function og_gdpr_print_footer_scripts() {
	if ( empty( $_COOKIE['og-gdpr-saved'] ) ) {
		return;
	}

	$settings = get_option( 'OG_GDPR' );
	$services = $settings['services'];

	foreach ( $services as $key => $service ) {
		if ( empty( $service['position'] ) ) {
			continue;
		}

		if ( $service['position'] != 2 ) {
			continue;
		}

		$force = ! empty( $service['service_force'] );
		$force = ! empty( $force ) && empty( $service['is_oembed'] ) ? false : $force;
		if ( $force ) {
			continue;
		}

		if ( ! empty( $service['code'] ) ) {
			$service_name = $service['name'];
			$service_cookie = $service_name;
			if ( ! empty( $service['is_oembed'] ) && $service['is_oembed'] == 'yes' ) {
				$service_cookie = $service['oembed'];
			}

			if ( og_gdpr_check_consent( $service_cookie ) !== 'true' ) {
				continue;
			}

			$code = '<!-- GDPR WP - ' . $service['name'] . ' -->';
			$code .= $service['code'];
			$code .= '<!--  /GDPR WP - ' . $service['name'] . ' -->';

			echo $code;
		}
	}
}
add_action( 'wp_print_footer_scripts', 'og_gdpr_print_footer_scripts' );
