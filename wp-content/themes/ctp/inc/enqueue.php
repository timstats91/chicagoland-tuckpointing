<?php
/**
 * Asset loading.
 *
 * One stylesheet, one small script, both versioned by file modification time so
 * LiteSpeed Cache and browsers pick up changes immediately.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Version string based on file mtime, falling back to the theme version.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function ctp_asset_version( $relative_path ) {
	$file = CTP_DIR . '/' . ltrim( $relative_path, '/' );

	return file_exists( $file ) ? (string) filemtime( $file ) : CTP_VERSION;
}

/**
 * Front-end assets.
 */
function ctp_enqueue_assets() {
	wp_enqueue_style(
		'ctp-app',
		CTP_URI . '/assets/css/app.css',
		array(),
		ctp_asset_version( 'assets/css/app.css' )
	);

	wp_enqueue_script(
		'ctp-app',
		CTP_URI . '/assets/js/app.js',
		array(),
		ctp_asset_version( 'assets/js/app.js' ),
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ctp_enqueue_assets' );

/**
 * Preload the stylesheet and the display typeface.
 *
 * The font is self-hosted, so there is no third-party DNS lookup or connection
 * to pay for — but it is still discovered late, because the browser only finds
 * it after parsing the CSS. Preloading the latin subset overlaps that fetch
 * with the stylesheet and removes the flash of fallback text on a cold load.
 *
 * Only the latin file is preloaded. The latin-ext subset is gated behind a
 * unicode-range, so it downloads only if a page actually uses those characters
 * (Polish surnames in a testimonial, for example) — preloading it would make
 * every visitor pay 32 KB for something most pages never need.
 */
function ctp_resource_hints() {
	printf(
		'<link rel="preload" href="%s" as="style" />' . "\n",
		esc_url( CTP_URI . '/assets/css/app.css?ver=' . ctp_asset_version( 'assets/css/app.css' ) )
	);

	if ( ctp_webfont_enabled() ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin />' . "\n",
			esc_url( CTP_URI . '/assets/fonts/archivo-latin.woff2' )
		);
	}
}
add_action( 'wp_head', 'ctp_resource_hints', 1 );

/**
 * Whether the self-hosted display face is used.
 *
 * Filterable so the whole thing can be dropped back to the system stack with
 * one line in a child theme, without editing CSS:
 *
 *     add_filter( 'ctp_use_webfont', '__return_false' );
 *
 * @return bool
 */
function ctp_webfont_enabled() {
	return (bool) apply_filters( 'ctp_use_webfont', true );
}

/**
 * Add a class so the stylesheet can fall back to the system stack cleanly when
 * the webfont is switched off.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function ctp_webfont_body_class( $classes ) {
	if ( ! ctp_webfont_enabled() ) {
		$classes[] = 'no-webfont';
	}

	return $classes;
}
add_filter( 'body_class', 'ctp_webfont_body_class' );

/**
 * Block editor styles so the admin preview matches the front end.
 */
function ctp_editor_assets() {
	wp_enqueue_style(
		'ctp-editor',
		CTP_URI . '/assets/css/editor.css',
		array(),
		ctp_asset_version( 'assets/css/editor.css' )
	);
}
add_action( 'enqueue_block_editor_assets', 'ctp_editor_assets' );
