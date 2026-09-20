<?php
/**
 * Performance trims.
 *
 * Namecheap Stellar is entry-level shared hosting, so the goal is to send as
 * little as possible and to let LiteSpeed Cache serve most requests from cache.
 * Every removal here is something this site genuinely does not use. Each one is
 * filterable in case a future plugin needs it back.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check whether a given trim is enabled.
 *
 * @param string $key Trim name.
 * @return bool
 */
function ctp_perf_enabled( $key ) {
	/**
	 * Toggle an individual performance trim.
	 *
	 * @param bool   $enabled Whether the trim runs.
	 * @param string $key     Trim name.
	 */
	return (bool) apply_filters( 'ctp_performance', true, $key );
}

/**
 * Remove the emoji detection script and its inline CSS. Roughly 14KB of
 * JavaScript on every page for something this site never uses.
 */
function ctp_disable_emojis() {
	if ( ! ctp_perf_enabled( 'emojis' ) ) {
		return;
	}

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	add_filter(
		'tiny_mce_plugins',
		static function ( $plugins ) {
			return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
		}
	);
}
add_action( 'init', 'ctp_disable_emojis' );

/**
 * Drop head clutter this site has no use for.
 */
function ctp_clean_head() {
	if ( ! ctp_perf_enabled( 'head' ) ) {
		return;
	}

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'init', 'ctp_clean_head' );

/**
 * Remove the wp-embed script. Only needed for embedding other WordPress posts.
 */
function ctp_dequeue_embed() {
	if ( is_admin() || ! ctp_perf_enabled( 'embed' ) ) {
		return;
	}

	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'ctp_dequeue_embed' );

/**
 * Remove the classic theme block styles this theme does not rely on.
 */
function ctp_dequeue_classic_styles() {
	if ( is_admin() || ! ctp_perf_enabled( 'classic_styles' ) ) {
		return;
	}

	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'ctp_dequeue_classic_styles', 20 );

/**
 * Preload the LCP image on templates that have one, so the hero photo is not
 * discovered late. Without a featured image this does nothing.
 */
function ctp_preload_hero_image() {
	if ( ! is_singular() || ! has_post_thumbnail() ) {
		return;
	}

	$src = get_the_post_thumbnail_url( null, 'ctp-wide' );

	if ( ! $src ) {
		return;
	}

	printf( '<link rel="preload" as="image" href="%s" fetchpriority="high" />' . "\n", esc_url( $src ) );
}
add_action( 'wp_head', 'ctp_preload_hero_image', 2 );

/**
 * Never lazy-load the first image on a page; lazy-loading the LCP element makes
 * Largest Contentful Paint worse, not better.
 *
 * @param string|bool $value   Current loading attribute.
 * @param string      $image   Image markup.
 * @param string      $context Context.
 * @return string|bool
 */
function ctp_skip_lazy_on_first_image( $value, $image, $context ) {
	static $seen = false;

	if ( is_admin() || 'the_content' !== $context ) {
		return $value;
	}

	if ( ! $seen ) {
		$seen = true;
		return false;
	}

	return $value;
}
add_filter( 'wp_img_tag_add_loading_attr', 'ctp_skip_lazy_on_first_image', 10, 3 );

/**
 * Disable XML-RPC. It is a standing brute-force target and nothing here uses it.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Shorten the excerpt of the REST API surface used by bots without breaking the
 * block editor: keep REST for logged-in users, close it to anonymous callers
 * except for the routes the front end genuinely needs.
 *
 * @param WP_Error|null|true $result Current result.
 * @return WP_Error|null|true
 */
function ctp_restrict_rest( $result ) {
	if ( ! empty( $result ) || is_user_logged_in() ) {
		return $result;
	}

	if ( ! ctp_perf_enabled( 'rest' ) ) {
		return $result;
	}

	$route = isset( $GLOBALS['wp']->query_vars['rest_route'] ) ? (string) $GLOBALS['wp']->query_vars['rest_route'] : '';

	// User enumeration via /wp/v2/users is the one worth closing.
	if ( 0 === strpos( $route, '/wp/v2/users' ) ) {
		return new WP_Error(
			'rest_forbidden',
			__( 'Not available.', 'ctp' ),
			array( 'status' => rest_authorization_required_code() )
		);
	}

	return $result;
}
add_filter( 'rest_authentication_errors', 'ctp_restrict_rest' );
