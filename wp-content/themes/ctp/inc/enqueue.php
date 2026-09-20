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
 * The stylesheet is render-blocking and small. Preloading it shaves a round
 * trip on shared hosting where TTFB is the weak point.
 */
function ctp_resource_hints() {
	printf(
		'<link rel="preload" href="%s" as="style" />' . "\n",
		esc_url( CTP_URI . '/assets/css/app.css?ver=' . ctp_asset_version( 'assets/css/app.css' ) )
	);
}
add_action( 'wp_head', 'ctp_resource_hints', 1 );

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
