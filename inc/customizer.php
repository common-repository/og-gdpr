<?php
function og_gdpr_customizerfunction( $wp_customize ) {
	/*$wp_customize->add_panel( 'og_gdpr', array(
	  'title' => __( 'GDPR' ),
	) );*/

	$wp_customize->add_section( 'og_gdpr_styles', array(
		'title' => __( 'GDPR', 'og-gdpr' ),
		// 'panel' => 'og_gdpr',
	) );

	$wp_customize->add_setting( 'og_gdpr_position', array(
		'capability' => 'edit_theme_options',
		'default' => 'left',
	));

	$wp_customize->add_control( 'og_gdpr_position', array(
		'label'   => __( 'Position', 'og-gdpr' ),
		'section' => 'og_gdpr_styles',
		'type'    => 'select',
		'choices' => array(
			'top' => __( 'Above the header', 'og-gdpr' ),
			'left' => __( 'Left side', 'og-gdpr' ),
			'right' => __( 'Right side', 'og-gdpr' ),
			'full-width' => __( 'Full width', 'og-gdpr' ),
		),
	));

	$wp_customize->add_setting( 'og_gdpr_theme', array(
		'capability' => 'edit_theme_options',
		'default' => 'light',
	));

	$wp_customize->add_control( 'og_gdpr_theme', array(
		'label'   => __( 'Theme', 'og-gdpr' ),
		'section' => 'og_gdpr_styles',
		'type'    => 'select',
		'choices' => array(
			'light' => __( 'Light', 'og-gdpr' ),
			'dark' => __( 'Dark', 'og-gdpr' ),
		),
	));

	$wp_customize->add_setting( 'og_gdpr_css', array(
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Code_Editor_Control(
		$wp_customize,
		'og_gdpr_css',
		array(
			'label'       => __( 'CSS code' ),
			'section'     => 'og_gdpr_styles',
			'code_type'   => 'text/css',
			'input_attrs' => array(
				'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4',
			),
		)
	) );
}
add_action( 'customize_register', 'og_gdpr_customizerfunction' );
