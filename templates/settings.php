<?php
	$settings = get_option( 'OG_GDPR' );
	if ( empty( $settings['popup']['text'] ) ) {
		return;
	}

	$theme = get_theme_mod( 'og_gdpr_theme' );
	$theme_class = "og-gdpr-wrapper og-gdpr-wrapper--$theme";

	$popup_position = get_theme_mod( 'og_gdpr_position' );
	$popup_position = ! empty( $popup_position ) ? $popup_position : 'left';
	if ( 'full-width' == $popup_position ) {
		$popup_position .= ' left right';
	}
?>

<aside class="<?php echo $theme_class; ?>">
    <div id="og-rodo" class="og-gdpr-settings-overlay" style="display: none;">
		<form class="og-gdpr-settings-form og-gdpr-settings-content">
			<button type="button" class="og-gdpr-button--close og-gdpr-close-button" aria-label="<?php _e( 'Close popup', 'og-gdpr' ); ?>">
				&times;
			</button>

			<h2 class="og-gdpr-settings-header"><?php echo $settings['general']['header'] ?></h2>
			<?php echo $settings['general']['desc'] ?>

			<table class="og-gdpr-settings-table">
				<thead>
					<tr>
						<th>
							<?php _e( 'Service', 'og-gdpr' ); ?>
						</th>

						<th>
							<?php _e( 'Intended use', 'og-gdpr' ); ?>
						</th>

						<th>
							<?php _e( 'Status', 'og-gdpr' ); ?>
						</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach ( $settings['services'] as $key => $service ): ?>
					<?php
						$service_name = $service['name'];
						$service_cookie = $service_name;
						if ( ! empty( $service['is_oembed'] ) && $service['is_oembed'] == 'yes' ) {
							$service_cookie = $service['oembed'];
						}
						$service_cookie_name = og_gdpr_get_cookie_name( $service_cookie );
					?>
					<?php $force = ! empty( $service['service_force'] ) ? 'disabled' : ''; ?>
					<?php $force = ! empty( $force ) && empty( $service['is_oembed'] ) ? '' : $force; ?>
					<tr>
						<td>
							<?php echo $service_name ?>
						</td>
						<td>
							<?php echo $service['description'] ?>
						</td>
						<td>
							<select name="<?php echo $service_cookie_name; ?>" <?php echo $force; ?>>
								<?php
									$service_consent = og_gdpr_check_consent( $service_cookie );

									$selected = 'selected';
									$selected_yes = $selected_no = false;
									if ( ! empty( $force ) ) {
										$selected_yes = $selected;
									} else if ( empty( $service_consent ) ) {
										$selected_no = $selected;
									} else if ( ! empty( $service_consent ) && $service_consent == 'true' ) {
										$selected_yes = $selected;
									} else {
										$selected_no = $selected;
									}
								?>

								<option value="true" <?php echo $selected_yes; ?>>
									<?php _e( 'Enabled', 'og-gdpr' ); ?>
								</option>

								<option value="false" <?php echo $selected_no; ?>>
									<?php _e( 'Disabled', 'og-gdpr' ); ?>
								</option>
							</select>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>

			<button type="submit" class="og-gdpr-button og-gdpr-button--primary og-gdpr-button--save-settings">
				<?php _e( 'Save your settings', 'og-gdpr' ); ?>
			</button>
		</form>
	</div>

	<?php
		$show_pupup = false;
		if ( empty( og_gdpr_check_cookie( 'saved' ) ) ) {
			$show_pupup = true;

			if ( og_gdpr_check_gpc() ) {
				$show_pupup = false;
			}
		}
	?>
	<?php if ( is_customize_preview() || $show_pupup ) : ?>
		<?php $class = 'og-gdpr-popup';
			$class .= " og-gdpr-popup-$popup_position"; ?>

		<div class="<?php echo $class; ?>">
			<button type="button" class="og-gdpr-button--close og-gdpr-close-button" aria-label="<?php _e( 'Close popup', 'og-gdpr' ); ?>">
				&times;
			</button>

        	<?php echo $settings['popup']['text']; ?>

	        <div class="og-gdpr-popup-buttons">
				<a href="#og-rodo" type="button" class="og-gdpr-button og-gdpr-button--primary og-gdpr-button--open-settings">
					<?php _e( 'Settings', 'og-gdpr' ); ?>
				</a>

				<button type="button" class="og-gdpr-button og-gdpr-button--hide-all og-gdpr-button--accept-all">
					<?php _e( 'Accept all', 'og-gdpr' ); ?>
				</button>

				<button type="button" class="og-gdpr-button og-gdpr-button--hide-all og-gdpr-button--reject-all">
					<?php _e( 'Reject all', 'og-gdpr' ); ?>
				</button>
			</div>
	    </div>
	<?php endif; ?>
</aside>
