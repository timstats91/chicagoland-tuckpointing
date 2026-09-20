<?php
/**
 * Shortcodes for dropping live business data into block-editor pages.
 *
 * Use these instead of typing the phone number into page content: change it
 * once in Settings > Business Info and every page follows.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * [ctp_phone] and [ctp_phone link="no"]
 *
 * @param array<string,string> $atts Shortcode attributes.
 * @return string
 */
function ctp_sc_phone( $atts ) {
	$atts = shortcode_atts(
		array(
			'link' => 'yes',
		),
		$atts,
		'ctp_phone'
	);

	$phone = ctp_business( 'phone' );

	if ( ! $phone ) {
		return '';
	}

	if ( 'no' === $atts['link'] ) {
		return esc_html( $phone );
	}

	return sprintf(
		'<a href="tel:%s" class="ctp-tel">%s</a>',
		esc_attr( ctp_tel( $phone ) ),
		esc_html( $phone )
	);
}
add_shortcode( 'ctp_phone', 'ctp_sc_phone' );

/**
 * [ctp_email]
 *
 * @return string
 */
function ctp_sc_email() {
	$email = ctp_business( 'email' );

	if ( ! $email ) {
		return '';
	}

	return sprintf(
		'<a href="%s">%s</a>',
		esc_url( 'mailto:' . $email ),
		esc_html( antispambot( $email ) )
	);
}
add_shortcode( 'ctp_email', 'ctp_sc_email' );

/**
 * [ctp_hours]
 *
 * @return string
 */
function ctp_sc_hours() {
	$lines = ctp_hours_lines();

	if ( ! $lines ) {
		return '';
	}

	$out = '<ul class="ctp-hours">';

	foreach ( $lines as $line ) {
		$parts = array_map( 'trim', explode( ':', $line, 2 ) );

		if ( 2 === count( $parts ) ) {
			$out .= sprintf(
				'<li><span>%s</span><span>%s</span></li>',
				esc_html( $parts[0] ),
				esc_html( $parts[1] )
			);
		} else {
			$out .= '<li><span>' . esc_html( $line ) . '</span></li>';
		}
	}

	return $out . '</ul>';
}
add_shortcode( 'ctp_hours', 'ctp_sc_hours' );

/**
 * [ctp_cta heading="..." text="..."]
 *
 * @param array<string,string> $atts Shortcode attributes.
 * @return string
 */
function ctp_sc_cta( $atts ) {
	$atts = shortcode_atts(
		array(
			'heading' => __( 'Get a free, no-pressure estimate', 'ctp-core' ),
			'text'    => __( 'We will look at the work, explain what actually needs doing, and put a written price in your hands.', 'ctp-core' ),
		),
		$atts,
		'ctp_cta'
	);

	ob_start();
	?>
	<div class="cta-band cta-band--inline">
		<div class="cta-band__inner">
			<h2 class="cta-band__title"><?php echo esc_html( $atts['heading'] ); ?></h2>
			<p class="cta-band__text"><?php echo esc_html( $atts['text'] ); ?></p>
			<div class="cta-band__actions">
				<?php if ( ctp_business( 'phone' ) ) : ?>
					<a class="btn btn--primary btn--lg" href="tel:<?php echo esc_attr( ctp_tel() ); ?>">
						<?php echo esc_html( ctp_business( 'phone' ) ); ?>
					</a>
				<?php endif; ?>
				<a class="btn btn--ghost btn--lg" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
					<?php esc_html_e( 'Request an estimate', 'ctp-core' ); ?>
				</a>
			</div>
		</div>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'ctp_cta', 'ctp_sc_cta' );

/**
 * [ctp_services limit="6"] — grid of service cards.
 *
 * @param array<string,string> $atts Shortcode attributes.
 * @return string
 */
function ctp_sc_services( $atts ) {
	$atts = shortcode_atts( array( 'limit' => '-1' ), $atts, 'ctp_services' );

	$services = ctp_get_services( (int) $atts['limit'] );

	if ( ! $services ) {
		return '';
	}

	ob_start();
	echo '<div class="card-grid card-grid--3">';

	foreach ( $services as $service ) {
		if ( function_exists( 'ctp_service_card' ) ) {
			ctp_service_card( $service );
		} else {
			printf(
				'<a class="card" href="%s"><h3>%s</h3><p>%s</p></a>',
				esc_url( get_permalink( $service ) ),
				esc_html( get_the_title( $service ) ),
				esc_html( (string) ctp_meta( 'tagline', $service->ID ) )
			);
		}
	}

	echo '</div>';

	return (string) ob_get_clean();
}
add_shortcode( 'ctp_services', 'ctp_sc_services' );

/**
 * [ctp_areas] — compact linked list of every service area, grouped by county.
 *
 * @return string
 */
function ctp_sc_areas() {
	$areas = ctp_get_areas();

	if ( ! $areas ) {
		return '';
	}

	$by_county = array();

	foreach ( $areas as $area ) {
		$county                 = (string) ctp_meta( 'county', $area->ID, __( 'Other areas', 'ctp-core' ) );
		$by_county[ $county ][] = $area;
	}

	ksort( $by_county );

	ob_start();
	echo '<div class="area-columns">';

	foreach ( $by_county as $county => $group ) {
		echo '<div class="area-columns__group">';
		echo '<h3 class="area-columns__heading">' . esc_html( $county ) . '</h3>';
		echo '<ul class="area-columns__list">';

		foreach ( $group as $area ) {
			printf(
				'<li><a href="%s">%s</a></li>',
				esc_url( get_permalink( $area ) ),
				esc_html( get_the_title( $area ) )
			);
		}

		echo '</ul></div>';
	}

	echo '</div>';

	return (string) ob_get_clean();
}
add_shortcode( 'ctp_areas', 'ctp_sc_areas' );
