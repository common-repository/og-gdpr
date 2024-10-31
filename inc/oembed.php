<?php
function og_gdpr_embed_filter( $html, $url, $args ) {
	$url = wp_parse_url( $url, PHP_URL_HOST );
	$url = str_replace( 'www.', '', $url );
	$cookie_name = 'og-gdpr-' . sanitize_title( $url );

	if ( ! isset( $_COOKIE[$cookie_name] ) || 'true' !== $_COOKIE[$cookie_name] ) {
		$oembed = '';
		$args = array(
			'service' => $url,
		);
		ob_start();
			og_gdpr_load_template( 'oembed.php', $args );
			$oembed = ob_get_contents();
		ob_end_clean();
		$html = $oembed;
	}

	return $html;
}
add_filter( 'embed_oembed_html', 'og_gdpr_embed_filter', 10, 3 );
