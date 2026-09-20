<?php
/**
 * Theme supports, menus and image sizes.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme features.
 */
function ctp_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-logo', array(
		'height'      => 64,
		'width'       => 260,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );

	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'ctp' ),
			'footer'  => __( 'Footer Menu', 'ctp' ),
		)
	);

	// Cards are 4:3; hero and project images are 16:9.
	add_image_size( 'ctp-card', 720, 540, true );
	add_image_size( 'ctp-wide', 1400, 788, true );
	add_image_size( 'ctp-square', 800, 800, true );
}
add_action( 'after_setup_theme', 'ctp_setup' );

/**
 * Content width for embeds.
 */
function ctp_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'ctp_content_width', 0 );

/**
 * Footer widget area, optional.
 */
function ctp_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Extra', 'ctp' ),
			'id'            => 'footer-extra',
			'description'   => __( 'Optional. Appears in the footer next to the contact details.', 'ctp' ),
			'before_widget' => '<div id="%1$s" class="footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer__heading">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'ctp_widgets_init' );

/**
 * Give the body a hook for per-template styling.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function ctp_body_classes( $classes ) {
	if ( ! is_singular() || is_front_page() ) {
		$classes[] = 'has-hero';
	}

	if ( is_singular( array( 'ctp_service', 'ctp_area', 'ctp_project' ) ) || is_front_page() ) {
		$classes[] = 'has-hero';
	}

	return array_unique( $classes );
}
add_filter( 'body_class', 'ctp_body_classes' );

/**
 * Honour the per-page noindex flag the seeder sets on the thank-you page.
 */
function ctp_noindex() {
	if ( is_singular() && ctp_meta( 'noindex', null, '' ) ) {
		echo '<meta name="robots" content="noindex, follow" />' . "\n";
	}
}
add_action( 'wp_head', 'ctp_noindex', 1 );

/**
 * Trim excerpts to something that fits a card without clipping mid-word.
 *
 * @param int $length Default length.
 * @return int
 */
function ctp_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'ctp_excerpt_length' );

/**
 * Replace the bracketed ellipsis.
 *
 * @return string
 */
function ctp_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'ctp_excerpt_more' );
