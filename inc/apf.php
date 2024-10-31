<?php
include_once( og_gdpr_get_plugin_path( 'vendor/admin-page-framework/admin-page-framework.php' ) );

class OG_GDPR extends OG_GDPR_AdminPageFramework {
	public function setUp() {
		$this->setRootMenuPage( 'Settings' );

		$this->addSubMenuItems(
			array(
				'title'     => __( 'GDPR Consent Manager', 'og-gdpr'),
				'menu_title'     => __( 'GDPR', 'og-gdpr'),
				'page_slug' => 'og_gdpr_settings'
			)
		);
	}

	public function load_og_gdpr_settings() {
		$this->addSettingSections(
			'og_gdpr_settings',
			array(
				'section_id' => 'popup',
				'title' => __( 'Popup', 'og-gdpr' ),
			),
			array(
				'section_id' => 'general',
				'title' => __( 'General settings', 'og-gdpr' ),
			),
			array(
				'section_id' => 'services',
				'title' => __( 'Services', 'og-gdpr' ),
				'repeatable' => true,
				'sortable' => true,
			),
			array(
				'section_id' => 'save_changes',
			),
		);

		$privacy_policy_link = get_privacy_policy_url();
		$main_desc_default_text = __( '<p><a href="%s">Cookies</a> are very small text files that are stored on your computer when you visit a website. We use cookies for a variety of purposes and to enhance your online experience on our website related to service performance, social media and advertising content.</p><p>You can change your preferences and accept certain types of cookies and scripts to load while browsing our website.</p><p>For more details, please see our <a href="%s">privacy policy</a>.', 'og-gdpr' );
		$main_desc_default = sprintf( $main_desc_default_text, __( 'https://en.wikipedia.org/wiki/Cookie', 'og-gdpr' ), $privacy_policy_link );
		$this->addSettingFields(
			'general',
			array(
				'field_id'      => 'header',
				'type'          => 'text',
				'title'         => __( 'Header', 'og-gdpr' ),
				'default' 		=> __( 'Privacy settings', 'og-gdpr' ),
			),
			array(
				'field_id'      => 'desc',
				'type'          => 'textarea',
				'title'         => __( 'Description', 'og-gdpr' ),
				'default' 		=> $main_desc_default,
				'rich' => array(
					'media_buttons' => false,
					'tinymce'       => true,
					'wpautop'       => false,
				),
			),
		);

		$this->addSettingFields(
			'popup',
			array(
				'field_id'      => 'text',
				'type'          => 'textarea',
				'title'         => __( 'Text', 'og-gdpr' ),
				'default' 		=> sprintf( __( "We use cookies and other tracking technologies to improve your browsing experience on our website, to show you targeted ads, to analyze our website traffic, and to understand where our visitors are coming from. You can manage your cookie settings by clicking on the \"<a href='%s'>Settings</a>\" button.", 'og-gdpr' ), '#og-rodo' ),
				'rich' => array(
					'media_buttons' => false,
					'tinymce'       => true,
					'wpautop'       => false,
				),
			),
		);

		$oembed = new WP_oEmbed();
		$providers = array();
		foreach ( $oembed->providers as $key => $service ) {
			$url = $service[0];
			$domain = wp_parse_url( $url,  PHP_URL_HOST );
			$domain = str_replace( 'www.' , '', $domain);
			$providers[sanitize_title($domain)] = $domain;
		}
		$providers = array_unique($providers);
		asort( $providers, SORT_STRING );
		$this->addSettingFields(
			'services',
			array(
				'field_id'      => 'name',
				'type'          => 'text',
				'title'         => __( 'Service name', 'og-gdpr' ),
				'attributes' => array(
					'fieldrow' => array(
						'class' => 'og-service-name',
					)
				),
			),
			array(
				'field_id'      => 'sanitized_name',
				'type'          => 'text',
				'disabled'		=> true,
				'title'         => __( 'Cookie name', 'og-gdpr' ),
				'tip'         => __( 'Name of cookie with consent value', 'og-gdpr' ),
				'description' => sprintf( __( "Use this with PHP function:<br>%s", 'og-gdpr' ), "<code>og_gdpr_check_consent( '<span></span>' )</code>" ),
				'attributes' => array(
					'fieldrow' => array(
						'class' => 'og-sanitized-name',
					)
				),
			),
			array(
				'field_id'      => 'service_force',
				'type'          => 'checkbox',
				'title'         => __( 'Functional Cookies', 'og-gdpr' ),
				'tip'         => __( 'Cookies that are necessary for the website to function properly.', 'og-gdpr' ),
				'default'       => false,
				'attributes' => array(
					'fieldrow' => array(
						'class' => 'og-force-enable',
					)
				),
			),
			array(
				'field_id'      => 'is_oembed',
				'type'          => 'radio',
				'title'         => __( 'oEmbed', 'og-gdpr' ),
				'help'			=> '<a href="https://wordpress.org/support/article/embeds/">WordPress.org</a>',
				'label' => array(
					'yes' => __( 'Yes', 'og-gdpr' ),
					'no' => __( 'No', 'og-gdpr' ),
				),
				'default' => 'no',
				'attributes' => array(
					'fieldrow' => array(
						'class' => 'og-is-oembed',
					)
				),
			),
			array(
				'field_id'      => 'oembed',
				'type'          => 'select',
				'title'         => __( 'Service', 'og-gdpr' ),
				'label' => $providers,
				'default' => 'no',
				'hidden' => true,
				'attributes' => array(
					'fieldrow' => array(
						'class' => 'og-oembed-select',
					)
				),
			),
			array(
				'field_id'      => 'description',
				'type'          => 'textarea',
				'title'         => __( 'Service description', 'og-gdpr' ),
				'rich' => array(
					'media_buttons' => false,
					'tinymce'       => true,
					'wpautop'       => false,
				),
			),
			array(
				'field_id'      => 'code',
				'type'          => 'textarea',
				'title'         => __( 'JS code', 'og-gdpr' ),
				'attributes' => array(
					'fieldrow' => array(
						'class' => 'og-field-monospace og-script-field',
					)
				),
			),
			array(
				'field_id'      => 'position',
				'type'          => 'select',
				'title'         => __( 'Position', 'og-gdpr' ),
				'label'		    => array(
					1 => sprintf( __( 'Before %s', 'og-gdpr' ), esc_html( '</head>' ) ),
					2 => sprintf( __( 'Before %s', 'og-gdpr' ), esc_html( '</body>' ) ),
				),
				'default' 		=> 2,
				'attributes' => array(
					'fieldrow' => array(
						'class' => 'og-script-field',
					)
				),
			),
		);

		$this->addSettingFields(
			'save_changes',
			array(
				'field_id'      => 'submit',
				'type'          => 'submit',
				'value'			=> __( 'Save changes', 'og-gdpr' ),
			),
		);
	}

	public function content_og_gdpr_settings( $content ) {
		$plugin_path = og_gdpr_get_plugin_path( "templates/" );
		$theme_path = get_stylesheet_directory() . "/templates/og-gdpr/";
		if ( defined( 'ABSPATH' ) ) {
			$wordpress_path = ABSPATH;
			$plugin_path = str_replace( $wordpress_path, '', $plugin_path );
			$theme_path = str_replace( $wordpress_path, '', $theme_path );
		}

		$html = "
			<div class='og-gdpr-grid'>
				<div class='og-gdpr-grid-column'>
					$content
				</div>
				<div class='og-gdpr-grid-column og-gdpr-grid-column--smaller'>
					<div class='og-gdpr-postbox-wrapper'>
						<div class='postbox'>
							<h2>" . __( 'Tips', 'og-gdpr' ) . "</h2>
							<div class='inside'>
								<div class='main'>
									<ol>
										<li>
											<a href='" . admin_url( 'options-privacy.php' ) . "'>
												" . __( 'Privacy Settings' ) . "
											</a>
										</li>

										<li>
											<a href='" . admin_url( 'options-privacy.php?tab=policyguide' ) . "'>
												" . __( 'Privacy Policy Guide' ) . "
											</a>
										</li>

										<li>
											" . sprintf( __( 'Link to open settings: <code><a href="%s" target="_blank">#og-rodo</a></code><br>
											It should be linked on the site and in the privacy policy', 'og-gdpr' ), home_url( '#og-rodo' ) ) . "
										</li>

										<li>
											" . __( '<b>Cache</b>: Disable caching for cookies starting with <code>og-gdpr</code>, or at least for <code>og-gdpr-saved</code>.', 'og-gdpr' ) . "
										</li>

										<li>
											<a href='https://wpzen.pl/oembed-latwe-umieszczanie-we-wpisach-elementow-z-zewnetrznych-serwisow/'>
												" . __( 'oEmbed - easy insertion of elements from external services (PL)', 'og-gdpr' ) . "
											</a>
										</li>

										<li>
											<a href='https://panoptykon.org/10-grzechow-reklamy-internetowej'>
												" . __( '10 sins of online advertising (PL)', 'og-gdpr' ) . "
											</a>
										</li>


										<li>
											<a href='https://blogs.harvard.edu/doc/2021/05/14/poison/'>
												" . __( 'How the cookie poisoned the Web', 'og-gdpr' ) . "
											</a>
										</li>

										<li>
											Plugin wykrywa nagłówek <a href='https://globalprivacycontrol.org/'>GPC</a>:<br><a href='https://spidersweb.pl/2020/10/global-privacy-control.html'>Global Privacy Control może nas uchronić od klikania wszędzie ustawień ciasteczek. O ile twórcy stron zechcą współpracować</a>
										</li>
									</ol>
								</div>
							</div>
						</div>

						<div class='postbox'>
							<h2>" . __( 'Edit appearance', 'og-gdpr' ) . "</h2>
							<div class='inside'>
								<div class='main'>
									<p>
										<a href='" . admin_url( 'themes.php' ) . "'>" . __( 'Appearance' ) . "</a> -> <a href='" . admin_url( 'customize.php' ) . "'>" . __( 'Customize' ) . "</a> -> <a href='" . admin_url( 'customize.php?autofocus[section]=og_gdpr_styles' ) . "'>" . __( 'GDPR', 'og-gdpr' ) . "</a>
									</p>
								</div>
							</div>

							<h2>" . __( 'Overriding templates', 'og-gdpr' ) . "</h2>
							<div class='inside'>
								<div class='main'>
									<p>
										" . sprintf( __( 'Copy template from <code>%s</code> to <code>%s</code>', 'og-gdpr' ), $plugin_path, $theme_path ) . "
									</p>
								</div>
							</div>
						</div>

						<div class='postbox'>
							<h2>" . __( 'Support', 'og-gdpr' ) . "</h2>
							<div class='inside'>
								<div class='main'>
									<p>
										<a href='https://wp-gdpr.com'>WP-RODO.pl</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		";

		return $html;
	}

	public function validation_OG_GDPR( $new, $old, $factory, $submit ) {
		$services = $new['services'];
		unset( $new['services'] );

		$services_new = array();
		foreach ( $services as $service ) {
			$sanitized_name = 'og-gdpr-';
			if ( ! empty( $service['is_oembed'] ) && $service['is_oembed'] == 'yes' ) {
				$sanitized_name .= sanitize_title( $service['oembed'] );
			} else {
				$sanitized_name .= sanitize_title( $service['name'] );
			}
			$service['sanitized_name'] = $sanitized_name;
			$services_new[] = $service;
		}
		$new['services'] = $services_new;

		return $new;
	}
}
