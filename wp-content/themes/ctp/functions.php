<?php
/**
 * Theme bootstrap.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

define( 'CTP_VERSION', '1.0.0' );
define( 'CTP_DIR', get_template_directory() );
define( 'CTP_URI', get_template_directory_uri() );

require_once CTP_DIR . '/inc/setup.php';
require_once CTP_DIR . '/inc/enqueue.php';
require_once CTP_DIR . '/inc/performance.php';
require_once CTP_DIR . '/inc/icons.php';
require_once CTP_DIR . '/inc/template-tags.php';
require_once CTP_DIR . '/inc/nav.php';
require_once CTP_DIR . '/inc/customizer.php';

/**
 * The plugin carries the content model; the theme only draws it. If the plugin
 * is switched off, say so plainly in the admin rather than fatal-erroring on
 * the front end.
 */
function ctp_require_plugin_notice() {
	if ( function_exists( 'ctp_business' ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	echo '<div class="notice notice-error"><p><strong>Chicagoland Tuckpointing theme:</strong> the <em>CTP Core</em> plugin is not active. Services, service areas, projects and business details all come from it. Activate it under Plugins.</p></div>';
}
add_action( 'admin_notices', 'ctp_require_plugin_notice' );

/**
 * Safety net so templates never fatal when the plugin is inactive.
 */
if ( ! function_exists( 'ctp_business' ) ) {
	/**
	 * @param string $key      Unused.
	 * @param string $fallback Returned as-is.
	 * @return string
	 */
	function ctp_business( $key = '', $fallback = '' ) {
		return $fallback;
	}
}

if ( ! function_exists( 'ctp_meta' ) ) {
	/**
	 * @param string   $key      Unused.
	 * @param int|null $post_id  Unused.
	 * @param mixed    $fallback Returned as-is.
	 * @return mixed
	 */
	function ctp_meta( $key, $post_id = null, $fallback = '' ) {
		return $fallback;
	}
}

if ( ! function_exists( 'ctp_meta_lines' ) ) {
	/**
	 * @param string   $key     Unused.
	 * @param int|null $post_id Unused.
	 * @return array<int,string>
	 */
	function ctp_meta_lines( $key, $post_id = null ) {
		return array();
	}
}

if ( ! function_exists( 'ctp_meta_faq' ) ) {
	/**
	 * @param string   $key     Unused.
	 * @param int|null $post_id Unused.
	 * @return array<int,array<string,string>>
	 */
	function ctp_meta_faq( $key = 'faq', $post_id = null ) {
		return array();
	}
}

if ( ! function_exists( 'ctp_tel' ) ) {
	/**
	 * @param string $phone Phone string.
	 * @return string
	 */
	function ctp_tel( $phone = '' ) {
		$digits = preg_replace( '/[^0-9]/', '', (string) $phone );

		return $digits ? '+' . $digits : '';
	}
}

if ( ! function_exists( 'ctp_url' ) ) {
	/**
	 * @param string $which Destination key.
	 * @return string
	 */
	function ctp_url( $which ) {
		return home_url( '/' );
	}
}

if ( ! function_exists( 'ctp_get_services' ) ) {
	/**
	 * @param int $limit Unused.
	 * @return array<int,WP_Post>
	 */
	function ctp_get_services( $limit = -1 ) {
		return array();
	}
}

if ( ! function_exists( 'ctp_get_areas' ) ) {
	/**
	 * @param int $limit Unused.
	 * @return array<int,WP_Post>
	 */
	function ctp_get_areas( $limit = -1 ) {
		return array();
	}
}

if ( ! function_exists( 'ctp_linked_posts' ) ) {
	/**
	 * @param string          $taxonomy   Unused.
	 * @param string          $term_slug  Unused.
	 * @param string|string[] $post_types Unused.
	 * @param int             $limit      Unused.
	 * @return array<int,WP_Post>
	 */
	function ctp_linked_posts( $taxonomy, $term_slug, $post_types = array(), $limit = 3 ) {
		return array();
	}
}

if ( ! function_exists( 'ctp_hours_lines' ) ) {
	/**
	 * @return array<int,string>
	 */
	function ctp_hours_lines() {
		return array();
	}
}

if ( ! function_exists( 'ctp_address_line' ) ) {
	/**
	 * @param bool $with_street Unused.
	 * @return string
	 */
	function ctp_address_line( $with_street = false ) {
		return '';
	}
}

if ( ! function_exists( 'ctp_years_in_business' ) ) {
	/**
	 * @return int
	 */
	function ctp_years_in_business() {
		return 0;
	}
}

if ( ! function_exists( 'ctp_coverage_list' ) ) {
	/**
	 * @return array<string,array<int,string>>
	 */
	function ctp_coverage_list() {
		return array();
	}
}
