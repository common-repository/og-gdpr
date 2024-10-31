<?php
/*
 * Plugin Name: GDPR WP
 * Plugin URI: https://wp-rodo.pl/
 * Description: Simple plugin to load tracking scripts based on user consent.
 * Version: 1.0.6
 * Author: OkiemGrafika
 * Author URI: https://okiemgrafika.pl/
 * Text Domain: og-gdpr
 * Domain Path: /languages
 */

if ( ! defined( 'OG_GDPR_PATH__FILE__' ) ) {
	define( 'OG_GDPR_PATH__FILE__', __FILE__ );
}

include_once( 'inc/helpers.php' );

function og_gdpr_activate() {
	update_option( 'OG_GDPR_VERSION', '1.0.6', false );

	$old_settings = get_option( 'OG_GDPR' );
	if ( empty( $old_settings ) ) {
		$settings = array(
			'services' => array(
				array(
					'name' => __( 'Strictly necessary cookies', 'og-gdpr' ),
					'description' => __( 'These cookies are essential to provide you with services available through our website and to enable you to use certain features of our website (for example, to remember your account login details). Without these cookies, we cannot provide you certain services on our website.', 'og-gdpr' ),
					'service_force' => true,
				),
				array(
					'name' => 'Google Analytics',
					'description' => __( "Enable if you do agree to the use of Google Analytics tracking scripts.<br><a href='https://policies.google.com/technologies/partner-sites'>How Google uses information from sites or apps that use our services</a>", 'og-gdpr' ),
				),
				array(
					'name' => __( 'Facebook Pixel', 'og-gdpr' ),
					'description' => __( 'We use the Facebook Pixel to target ads to you on Facebook. You can deactivate the Facebook Pixel and make it not work in your case.<br><a href="https://pixel.facebook.com/about/privacy/">Data Policy</a>', 'og-gdpr' ),
				),
				array(
					'name' => 'YouTube',
					'description' => __( 'Sometimes we embed YouTube video in post content. Enable if you want to load YouTube player.<br><a href="https://www.youtube.com/static?template=terms">YouTube Terms of Service</a>', 'og-gdpr' ),
					'is_oembed' => 'yes',
					'oembed' => 'youtube-com',
				),
			),
		);
		add_option( 'OG_GDPR', $settings );
	}
}
register_activation_hook( __FILE__, 'og_gdpr_activate' );

function og_gdpr_activated( $plugin ) {
	$redirect = get_option( 'OG_GDPR' ) ? false : true;
	$table = new WP_Plugins_List_Table;
	if ( $redirect === true && plugin_basename( __FILE__ ) === $plugin && 'activate' === $table->current_action() ) {
	   wp_safe_redirect( admin_url( 'options-general.php?page=og_gdpr_settings' ) ); exit;
	}
}
add_action( 'activated_plugin', 'og_gdpr_activated' );

function og_gdpr_init() {
	load_plugin_textdomain( 'og-gdpr', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	if ( ! class_exists( 'OG_GDPR' ) ) {
		include_once( 'inc/apf.php' );
		new OG_GDPR;
	}
}
add_action( 'init', 'og_gdpr_init' );

include_once(og_gdpr_get_plugin_path( '/inc/enqueue.php' ));

function og_gdpr_print_settings() {
	og_gdpr_load_template( 'settings.php' );
}
add_action( 'wp_footer', 'og_gdpr_print_settings' );

include_once(og_gdpr_get_plugin_path( '/inc/customizer.php' ));

include_once(og_gdpr_get_plugin_path( '/inc/oembed.php' ));

function og_gdpr_add_privacy_policy_content() {
	if ( ! function_exists( 'wp_add_privacy_policy_content' ) ) {
		return;
	}

	$content = __( 'GDPR WP stores cookies with the decision of each consent. It does not collect any data about the user. All cookies start with the prefix <code>og-rodo</code>.', 'og-gdpr' );

	wp_add_privacy_policy_content( __( 'GDPR WP', 'og-gdpr' ), wp_kses_post( wpautop( $content, false ) ) );
}
add_action( 'admin_init', 'og_gdpr_add_privacy_policy_content' );
