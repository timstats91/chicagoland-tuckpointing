<?php
/**
 * Shared helpers. Everything the theme needs to read business data goes through
 * here, so there is exactly one source of truth.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default business information, overridden by Settings > Business Info.
 *
 * @return array<string,string>
 */
function ctp_business_defaults() {
	return array(
		'name'         => 'Chicagoland Tuckpointing',
		'legal_name'   => 'Chicagoland Tuckpointing',
		'tagline'      => 'Masonry restoration done right the first time.',
		'phone'        => '(630) 555-0123',
		'phone_alt'    => '',
		'email'        => 'info@chicagolandtuckpointing.com',
		'street'       => '',
		'city'         => 'Wood Dale',
		'state'        => 'IL',
		'zip'          => '60191',
		'county'       => 'DuPage County',
		'lat'          => '41.9639',
		'lng'          => '-87.9784',
		'hours'        => "Monday - Friday: 7:00am - 5:00pm\nSaturday: 8:00am - 2:00pm\nSunday: Closed",
		'founded'      => '2005',
		'license'      => '',
		'insured'      => '1',
		'radius_miles' => '45',
		'facebook'     => '',
		'instagram'    => '',
		'google'       => '',
		'yelp'         => '',
	);
}

/**
 * Get one business field, or the whole array when $key is empty.
 *
 * @param string $key      Field key.
 * @param string $fallback Value returned when the stored field is empty.
 * @return mixed
 */
function ctp_business( $key = '', $fallback = '' ) {
	static $cache = null;

	if ( null === $cache ) {
		$saved = get_option( 'ctp_business_info', array() );
		$cache = wp_parse_args( is_array( $saved ) ? $saved : array(), ctp_business_defaults() );
	}

	if ( '' === $key ) {
		return $cache;
	}

	$value = isset( $cache[ $key ] ) ? $cache[ $key ] : '';

	return ( '' === $value || null === $value ) ? $fallback : $value;
}

/**
 * Clear the cached business info after a save.
 */
function ctp_flush_business_cache() {
	// Static caches live for one request only; nothing persistent to clear yet.
	wp_cache_delete( 'ctp_business_info', 'options' );
}

/**
 * Strip a phone number down to digits for a tel: link.
 *
 * @param string $phone Raw phone string, defaults to the business phone.
 * @return string
 */
function ctp_tel( $phone = '' ) {
	$phone  = $phone ? $phone : ctp_business( 'phone' );
	$digits = preg_replace( '/[^0-9]/', '', (string) $phone );

	if ( 10 === strlen( $digits ) ) {
		$digits = '1' . $digits;
	}

	return $digits ? '+' . $digits : '';
}

/**
 * Address string built from whatever parts are filled in.
 *
 * @param bool $with_street Include the street line.
 * @return string
 */
function ctp_address_line( $with_street = false ) {
	$parts = array();

	if ( $with_street && ctp_business( 'street' ) ) {
		$parts[] = ctp_business( 'street' );
	}

	$city_state = trim( ctp_business( 'city' ) . ', ' . ctp_business( 'state' ) . ' ' . ctp_business( 'zip' ) );
	$parts[]    = trim( $city_state, ' ,' );

	return implode( ', ', array_filter( $parts ) );
}

/**
 * Business hours split into display lines.
 *
 * @return string[]
 */
function ctp_hours_lines() {
	$lines = preg_split( '/\r\n|\r|\n/', (string) ctp_business( 'hours' ) );

	return array_values( array_filter( array_map( 'trim', (array) $lines ) ) );
}

/**
 * Years in business, or 0 when the founding year is missing or implausible.
 *
 * @return int
 */
function ctp_years_in_business() {
	$founded = (int) ctp_business( 'founded' );
	$now     = (int) current_time( 'Y' );

	if ( $founded < 1900 || $founded > $now ) {
		return 0;
	}

	return $now - $founded;
}

/**
 * Read a CTP post meta value with a fallback.
 *
 * @param string   $key      Meta key, without the _ctp_ prefix.
 * @param int|null $post_id  Post ID, defaults to the current post.
 * @param mixed    $fallback Value returned when empty.
 * @return mixed
 */
function ctp_meta( $key, $post_id = null, $fallback = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	if ( ! $post_id ) {
		return $fallback;
	}

	$value = get_post_meta( $post_id, '_ctp_' . $key, true );

	return ( '' === $value || null === $value ) ? $fallback : $value;
}

/**
 * Split a textarea meta field into trimmed, non-empty lines.
 *
 * @param string   $key     Meta key.
 * @param int|null $post_id Post ID.
 * @return string[]
 */
function ctp_meta_lines( $key, $post_id = null ) {
	$raw = (string) ctp_meta( $key, $post_id, '' );

	if ( '' === $raw ) {
		return array();
	}

	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ) ) );
}

/**
 * Parse a "Question | Answer" textarea into FAQ pairs.
 *
 * @param string   $key     Meta key.
 * @param int|null $post_id Post ID.
 * @return array<int,array{q:string,a:string}>
 */
function ctp_meta_faq( $key = 'faq', $post_id = null ) {
	$faqs = array();

	foreach ( ctp_meta_lines( $key, $post_id ) as $line ) {
		$pair = array_map( 'trim', explode( '|', $line, 2 ) );

		if ( 2 === count( $pair ) && '' !== $pair[0] && '' !== $pair[1] ) {
			$faqs[] = array(
				'q' => $pair[0],
				'a' => $pair[1],
			);
		}
	}

	return $faqs;
}

/**
 * Canonical URLs for the handful of destinations the theme links to constantly.
 *
 * @param string $which One of: home, services, areas, projects, hub, contact.
 * @return string
 */
function ctp_url( $which ) {
	switch ( $which ) {
		case 'services':
			$link = get_post_type_archive_link( 'ctp_service' );
			return $link ? $link : home_url( '/services/' );

		case 'areas':
			$link = get_post_type_archive_link( 'ctp_area' );
			return $link ? $link : home_url( '/service-areas/' );

		case 'projects':
			$link = get_post_type_archive_link( 'ctp_project' );
			return $link ? $link : home_url( '/projects/' );

		case 'hub':
			$page_id = (int) get_option( 'page_for_posts' );
			return $page_id ? get_permalink( $page_id ) : home_url( '/knowledge-hub/' );

		case 'contact':
			$page = get_page_by_path( 'contact' );
			return $page ? get_permalink( $page ) : home_url( '/contact/' );

		case 'home':
		default:
			return home_url( '/' );
	}
}

/**
 * Posts linked to a service or area through the shared linking taxonomies.
 * Service and area post slugs double as the term slugs, so a service page can
 * pull its own projects and articles with no extra configuration.
 *
 * @param string          $taxonomy   ctp_service_link or ctp_area_link.
 * @param string          $term_slug  Term slug to match.
 * @param string|string[] $post_types Post types to query.
 * @param int             $limit      Maximum number of posts.
 * @return WP_Post[]
 */
function ctp_linked_posts( $taxonomy, $term_slug, $post_types = array( 'ctp_project' ), $limit = 3 ) {
	if ( ! $term_slug || ! taxonomy_exists( $taxonomy ) ) {
		return array();
	}

	$query = new WP_Query(
		array(
			'post_type'              => $post_types,
			'post_status'            => 'publish',
			'posts_per_page'         => (int) $limit,
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'tax_query'              => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $term_slug,
				),
			),
		)
	);

	return $query->posts;
}

/**
 * All published services, ordered by menu order then title.
 *
 * @param int $limit -1 for all.
 * @return WP_Post[]
 */
function ctp_get_services( $limit = -1 ) {
	return get_posts(
		array(
			'post_type'        => 'ctp_service',
			'post_status'      => 'publish',
			'posts_per_page'   => $limit,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
			'suppress_filters' => false,
		)
	);
}

/**
 * All published service areas, ordered by menu order then title.
 *
 * @param int $limit -1 for all.
 * @return WP_Post[]
 */
function ctp_get_areas( $limit = -1 ) {
	return get_posts(
		array(
			'post_type'        => 'ctp_area',
			'post_status'      => 'publish',
			'posts_per_page'   => $limit,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
			'suppress_filters' => false,
		)
	);
}
