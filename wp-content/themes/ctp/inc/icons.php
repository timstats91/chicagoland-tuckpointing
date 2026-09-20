<?php
/**
 * Inline SVG icon set.
 *
 * Inline rather than an icon font or sprite file: no extra request, no FOUT,
 * and they inherit currentColor. The whole set is well under 4KB and only the
 * icons actually used on a page are printed.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Icon path data, keyed by name. All drawn on a 24x24 grid, stroked.
 *
 * @return array<string,string>
 */
function ctp_icon_paths() {
	return array(

		// Service icons.
		'trowel'     => '<path d="M20.5 3.5 12 12l-4.2-4.2 8.5-4.3z"/><path d="m7.8 7.8-4.3 8.5L12 12"/><path d="m5.5 18.5-2 2"/>',
		'brick'      => '<rect x="2.5" y="4.5" width="19" height="15" rx="1"/><path d="M2.5 9.5h19M2.5 14.5h19M9 4.5v5M15 9.5v5M9 14.5v5"/>',
		'chimney'    => '<path d="M2.5 11 12 3.5 21.5 11"/><path d="M5 9.4V20h14V9.4"/><path d="M16 6.4V3h3v5.7"/>',
		'caulk'      => '<rect x="2.5" y="9" width="11" height="6" rx="1"/><path d="M13.5 12h3l5-3.5"/><path d="M6 15v4.5M10 15v3"/>',
		'patio'      => '<rect x="2.5" y="3.5" width="8.5" height="6.5" rx="1"/><rect x="13" y="3.5" width="8.5" height="6.5" rx="1"/><rect x="2.5" y="14" width="8.5" height="6.5" rx="1"/><rect x="13" y="14" width="8.5" height="6.5" rx="1"/>',
		'lintel'     => '<rect x="2.5" y="5.5" width="19" height="3.5" rx="0.5"/><path d="M6 9v11.5M18 9v11.5"/><path d="M2.5 20.5h19"/>',
		'stone'      => '<path d="M2.5 4.5h8v5.5h-8zM12.5 4.5h9v5.5h-9zM2.5 13.5h13V19h-13zM17.5 13.5h4V19h-4z"/>',
		'waterproof' => '<path d="M12 2.8s6.2 6.6 6.2 10.4a6.2 6.2 0 0 1-12.4 0C5.8 9.4 12 2.8 12 2.8z"/><path d="m9.3 13.2 1.9 1.9 3.6-3.6"/>',
		'wash'       => '<path d="m2.8 21.2 7-7"/><path d="m13.5 3.5 7 7-4 4-7-7z"/><path d="M17 2v3M20.5 6.5h3M19.2 3.8 21.4 1.6"/>',
		'steps'      => '<path d="M2.5 20.5v-4.5h5v-4h5v-4h5v-4h4"/><path d="M2.5 20.5h19"/>',
		'wall'       => '<path d="M2 5.5h20"/><rect x="3" y="8" width="18" height="12" rx="1"/><path d="M3 14h18M9 8v6M15 14v6"/>',
		'inspect'    => '<circle cx="10.5" cy="10.5" r="7"/><path d="m15.6 15.6 5.4 5.4"/><path d="M6 10.5h9M10.5 6v9"/>',

		// Interface icons.
		'phone'      => '<path d="M21 16.4v2.8a1.9 1.9 0 0 1-2.1 1.9 18.8 18.8 0 0 1-8.2-2.9 18.5 18.5 0 0 1-5.7-5.7A18.8 18.8 0 0 1 2.1 4.2 1.9 1.9 0 0 1 4 2.1h2.8a1.9 1.9 0 0 1 1.9 1.6c.1 1 .3 1.8.7 2.7a1.9 1.9 0 0 1-.4 2L7.8 9.6a15 15 0 0 0 5.7 5.7l1.2-1.2a1.9 1.9 0 0 1 2-.4c.9.3 1.8.6 2.7.7a1.9 1.9 0 0 1 1.6 2z"/>',
		'mail'       => '<rect x="2.5" y="4.5" width="19" height="15" rx="2"/><path d="m3 6 9 6.5L21 6"/>',
		'pin'        => '<path d="M20 10.5c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10.5" r="3"/>',
		'clock'      => '<circle cx="12" cy="12" r="9.2"/><path d="M12 6.8V12l3.4 2"/>',
		'check'      => '<path d="m4.5 12.5 5 5 10-11"/>',
		'arrow'      => '<path d="M4.5 12h14"/><path d="m13 6.5 5.5 5.5-5.5 5.5"/>',
		'menu'       => '<path d="M3.5 6.5h17M3.5 12h17M3.5 17.5h17"/>',
		'close'      => '<path d="m5.5 5.5 13 13M18.5 5.5l-13 13"/>',
		'star'       => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1 6.2-5.5-2.9-5.5 2.9 1-6.2L3 9.6l6.2-.9z"/>',
		'shield'     => '<path d="M12 2.5 20 5.8v5.7c0 4.8-3.3 8.5-8 10-4.7-1.5-8-5.2-8-10V5.8z"/><path d="m8.8 11.8 2.2 2.2 4.2-4.2"/>',
		'chevron'    => '<path d="m6.5 9.5 5.5 5.5 5.5-5.5"/>',
		'quote'      => '<path d="M9.5 5.5C6.4 7 4.5 9.6 4.5 13v5.5h6V12H7.8c.2-2 1.3-3.5 3-4.4zM19.5 5.5C16.4 7 14.5 9.6 14.5 13v5.5h6V12h-2.7c.2-2 1.3-3.5 3-4.4z"/>',
		'hammer'     => '<path d="m14.5 6.5 3-3 4 4-3 3z"/><path d="m14.5 9.5-9 9-3-3 9-9"/><path d="m11.5 4.5 4 4"/>',
	);
}

/**
 * Return an icon as inline SVG.
 *
 * @param string $name  Icon key.
 * @param int    $size  Pixel size.
 * @param string $class Extra CSS classes.
 * @return string
 */
function ctp_get_icon( $name, $size = 24, $class = '' ) {
	$paths = ctp_icon_paths();

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	$classes = trim( 'icon icon--' . $name . ' ' . $class );

	return sprintf(
		'<svg class="%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $classes ),
		(int) $size,
		$paths[ $name ]
	);
}

/**
 * Echo an icon.
 *
 * @param string $name  Icon key.
 * @param int    $size  Pixel size.
 * @param string $class Extra CSS classes.
 */
function ctp_icon( $name, $size = 24, $class = '' ) {
	echo ctp_get_icon( $name, $size, $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG markup.
}

/**
 * Pick a sensible icon for a service that has no icon set.
 *
 * @param int $post_id Service post ID.
 * @return string
 */
function ctp_service_icon_name( $post_id ) {
	$icon = (string) ctp_meta( 'icon', $post_id, '' );

	if ( $icon ) {
		return $icon;
	}

	$slug  = (string) get_post_field( 'post_name', $post_id );
	$guess = array(
		'tuckpoint' => 'trowel',
		'point'     => 'trowel',
		'chimney'   => 'chimney',
		'caulk'     => 'caulk',
		'seal'      => 'caulk',
		'patio'     => 'patio',
		'paver'     => 'patio',
		'lintel'    => 'lintel',
		'step'      => 'steps',
		'stoop'     => 'steps',
		'stone'     => 'stone',
		'limestone' => 'stone',
		'water'     => 'waterproof',
		'clean'     => 'wash',
		'wash'      => 'wash',
		'wall'      => 'wall',
	);

	foreach ( $guess as $needle => $icon_name ) {
		if ( false !== strpos( $slug, $needle ) ) {
			return $icon_name;
		}
	}

	return 'brick';
}
