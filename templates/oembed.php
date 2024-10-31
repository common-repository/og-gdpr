<?php
	$args = wp_parse_args( $args, array(
		'service' => 'oEmbed',
	) );

	$theme = get_theme_mod( 'og_gdpr_theme' );
	$theme_class = "og-gdpr-oembed-wrapper og-gdpr-oembed-wrapper--$theme";
?>

<aside class="<?php echo $theme_class; ?>">
	<p class="og-gdpr-oembed-header">
		<?php printf( __( "Privacy settings - %s", "og-gdpr" ), $args['service'] ); ?>
	</p>

	<p>
		<?php printf( __( 'Change <a href="%s">settings</a>', "og-gdpr" ), "#og-rodo" ); ?>
	</p>
</aside>
