<?php
/**
 * Business Info settings screen.
 *
 * One place to change the phone number, address and hours. Every template, the
 * footer, the sticky call bar and the local SEO schema read from here, so a
 * phone number change is a single edit.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field groups for the settings screen.
 *
 * @return array<string,array<string,array<string,mixed>>>
 */
function ctp_settings_schema() {
	return array(
		__( 'Identity', 'ctp-core' )      => array(
			'name'       => array( 'label' => __( 'Business name', 'ctp-core' ), 'type' => 'text' ),
			'legal_name' => array( 'label' => __( 'Legal name', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Used in schema and the footer copyright. Same as above is fine.', 'ctp-core' ) ),
			'tagline'    => array( 'label' => __( 'Tagline', 'ctp-core' ), 'type' => 'text' ),
			'founded'    => array( 'label' => __( 'Year founded', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Drives the "X years in business" line. Leave blank to hide it.', 'ctp-core' ) ),
			'license'    => array( 'label' => __( 'License number', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Optional. Shown in the footer if filled in.', 'ctp-core' ) ),
			'insured'    => array( 'label' => __( 'Fully insured', 'ctp-core' ), 'type' => 'checkbox', 'desc' => __( 'Show the "licensed and insured" trust badge.', 'ctp-core' ) ),
		),

		__( 'Contact', 'ctp-core' )       => array(
			'phone'     => array( 'label' => __( 'Phone', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Displayed exactly as typed. Tel links are generated automatically.', 'ctp-core' ) ),
			'phone_alt' => array( 'label' => __( 'Second phone', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Optional.', 'ctp-core' ) ),
			'email'     => array( 'label' => __( 'Email', 'ctp-core' ), 'type' => 'email' ),
			'hours'     => array( 'label' => __( 'Hours', 'ctp-core' ), 'type' => 'textarea', 'desc' => __( 'One line per row, for example: Monday - Friday: 7:00am - 5:00pm', 'ctp-core' ), 'rows' => 4 ),
		),

		__( 'Location', 'ctp-core' )      => array(
			'street'       => array( 'label' => __( 'Street address', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Leave blank if he works out of the house. Google does not require a street address for a service-area business, and publishing a home address is usually a mistake.', 'ctp-core' ) ),
			'city'         => array( 'label' => __( 'City', 'ctp-core' ), 'type' => 'text' ),
			'state'        => array( 'label' => __( 'State', 'ctp-core' ), 'type' => 'text' ),
			'zip'          => array( 'label' => __( 'ZIP', 'ctp-core' ), 'type' => 'text' ),
			'county'       => array( 'label' => __( 'County', 'ctp-core' ), 'type' => 'text' ),
			'lat'          => array( 'label' => __( 'Latitude', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Used in schema. Wood Dale is roughly 41.9639.', 'ctp-core' ) ),
			'lng'          => array( 'label' => __( 'Longitude', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Wood Dale is roughly -87.9784.', 'ctp-core' ) ),
			'radius_miles' => array( 'label' => __( 'Service radius (miles)', 'ctp-core' ), 'type' => 'text', 'desc' => __( 'Roughly one hour of driving. 45 miles is a sensible figure from Wood Dale.', 'ctp-core' ) ),
		),

		__( 'Profiles', 'ctp-core' ) => array(
			'google'    => array( 'label' => __( 'Google Business Profile URL', 'ctp-core' ), 'type' => 'url', 'desc' => __( 'Single most valuable link for a local contractor. Claim it early.', 'ctp-core' ) ),
			'facebook'  => array( 'label' => __( 'Facebook URL', 'ctp-core' ), 'type' => 'url' ),
			'instagram' => array( 'label' => __( 'Instagram URL', 'ctp-core' ), 'type' => 'url' ),
			'yelp'      => array( 'label' => __( 'Yelp URL', 'ctp-core' ), 'type' => 'url' ),
		),
	);
}

/**
 * Remind anyone in the admin that the site is hidden from search engines.
 *
 * WordPress does flag this in the Dashboard's At a Glance box, but that is a
 * single line of grey text on one screen. Discouraging indexing during a build
 * is the right call; forgetting to undo it at launch is the expensive part, so
 * this says so plainly on the screens someone actually works in.
 */
function ctp_noindex_reminder() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( '0' !== get_option( 'blog_public' ) ) {
		return;
	}

	$screen = get_current_screen();
	$show_on = array( 'dashboard', 'options-reading', 'settings_page_ctp-business-info', 'tools_page_ctp-starter-content' );

	if ( ! $screen || ! in_array( $screen->id, $show_on, true ) ) {
		return;
	}

	?>
	<div class="notice notice-warning">
		<p>
			<strong><?php esc_html_e( 'This site is hidden from Google.', 'ctp-core' ); ?></strong>
			<?php esc_html_e( 'Search engines are being discouraged from indexing it, which is what you want while the content is still being finished.', 'ctp-core' ); ?>
		</p>
		<p>
			<?php
			printf(
				/* translators: %s: link to the Reading settings screen. */
				esc_html__( 'When the site is ready to launch, untick "Discourage search engines" on %s — nothing will rank until you do.', 'ctp-core' ),
				'<a href="' . esc_url( admin_url( 'options-reading.php' ) ) . '">' . esc_html__( 'Settings → Reading', 'ctp-core' ) . '</a>'
			);
			?>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'ctp_noindex_reminder' );

/**
 * Add the settings page under Settings.
 */
function ctp_settings_menu() {
	add_options_page(
		__( 'Business Info', 'ctp-core' ),
		__( 'Business Info', 'ctp-core' ),
		'manage_options',
		'ctp-business-info',
		'ctp_settings_page'
	);
}
add_action( 'admin_menu', 'ctp_settings_menu' );

/**
 * Register the single option with a sanitizing callback.
 */
function ctp_settings_register() {
	register_setting(
		'ctp_business_group',
		'ctp_business_info',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'ctp_sanitize_business_info',
			'default'           => ctp_business_defaults(),
		)
	);
}
add_action( 'admin_init', 'ctp_settings_register' );

/**
 * Sanitize every submitted field according to its declared type.
 *
 * @param mixed $input Raw submitted value.
 * @return array<string,string>
 */
function ctp_sanitize_business_info( $input ) {
	$clean = array();

	if ( ! is_array( $input ) ) {
		return ctp_business_defaults();
	}

	foreach ( ctp_settings_schema() as $fields ) {
		foreach ( $fields as $key => $field ) {
			$raw = isset( $input[ $key ] ) ? $input[ $key ] : '';

			switch ( $field['type'] ) {
				case 'textarea':
					$clean[ $key ] = sanitize_textarea_field( $raw );
					break;
				case 'email':
					$clean[ $key ] = sanitize_email( $raw );
					break;
				case 'url':
					$clean[ $key ] = esc_url_raw( $raw );
					break;
				case 'checkbox':
					$clean[ $key ] = $raw ? '1' : '';
					break;
				default:
					$clean[ $key ] = sanitize_text_field( $raw );
					break;
			}
		}
	}

	return $clean;
}

/**
 * Render the settings screen.
 */
function ctp_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$values = ctp_business();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Business Info', 'ctp-core' ); ?></h1>
		<p class="description" style="max-width:60em">
			<?php esc_html_e( 'These details appear in the header, footer, contact page, sticky call bar and the structured data Google reads. Change them here once rather than editing pages.', 'ctp-core' ); ?>
		</p>

		<form method="post" action="options.php">
			<?php settings_fields( 'ctp_business_group' ); ?>

			<?php foreach ( ctp_settings_schema() as $group_label => $fields ) : ?>
				<h2 class="title"><?php echo esc_html( $group_label ); ?></h2>
				<table class="form-table" role="presentation">
					<tbody>
					<?php foreach ( $fields as $key => $field ) : ?>
						<?php
						$id    = 'ctp_field_' . $key;
						$name  = 'ctp_business_info[' . $key . ']';
						$value = isset( $values[ $key ] ) ? $values[ $key ] : '';
						?>
						<tr>
							<th scope="row">
								<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
							</th>
							<td>
								<?php if ( 'textarea' === $field['type'] ) : ?>
									<textarea
										id="<?php echo esc_attr( $id ); ?>"
										name="<?php echo esc_attr( $name ); ?>"
										rows="<?php echo isset( $field['rows'] ) ? (int) $field['rows'] : 4; ?>"
										class="large-text"><?php echo esc_textarea( (string) $value ); ?></textarea>

								<?php elseif ( 'checkbox' === $field['type'] ) : ?>
									<label>
										<input
											type="checkbox"
											id="<?php echo esc_attr( $id ); ?>"
											name="<?php echo esc_attr( $name ); ?>"
											value="1"
											<?php checked( $value, '1' ); ?> />
										<?php echo isset( $field['desc'] ) ? esc_html( $field['desc'] ) : ''; ?>
									</label>

								<?php else : ?>
									<input
										type="<?php echo esc_attr( 'email' === $field['type'] ? 'email' : ( 'url' === $field['type'] ? 'url' : 'text' ) ); ?>"
										id="<?php echo esc_attr( $id ); ?>"
										name="<?php echo esc_attr( $name ); ?>"
										value="<?php echo esc_attr( (string) $value ); ?>"
										class="regular-text" />
								<?php endif; ?>

								<?php if ( ! empty( $field['desc'] ) && 'checkbox' !== $field['type'] ) : ?>
									<p class="description"><?php echo esc_html( $field['desc'] ); ?></p>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php endforeach; ?>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
