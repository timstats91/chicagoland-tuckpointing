<?php
/**
 * WCAG contrast checker for the theme palette.
 *
 * Run: php tools/contrast-check.php
 *
 * Keeps the palette honest. Every text pair in the theme is listed here with
 * the level it has to clear, so a color change that quietly breaks contrast
 * fails here instead of in an audit.
 *
 * Thresholds (WCAG 2.1 AA):
 *   4.5  normal body text
 *   3.0  large text (>=24px, or >=18.66px bold) and UI component boundaries
 */

/**
 * Parse #rgb or #rrggbb into [r, g, b].
 */
function hex_rgb( string $hex ): array {
	$hex = ltrim( trim( $hex ), '#' );

	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	return array(
		hexdec( substr( $hex, 0, 2 ) ),
		hexdec( substr( $hex, 2, 2 ) ),
		hexdec( substr( $hex, 4, 2 ) ),
	);
}

/**
 * Composite a translucent foreground over an opaque background.
 */
function composite( string $fg, float $alpha, string $bg ): string {
	[ $fr, $fg_, $fb ] = hex_rgb( $fg );
	[ $br, $bg_, $bb ] = hex_rgb( $bg );

	return sprintf(
		'#%02x%02x%02x',
		(int) round( $fr * $alpha + $br * ( 1 - $alpha ) ),
		(int) round( $fg_ * $alpha + $bg_ * ( 1 - $alpha ) ),
		(int) round( $fb * $alpha + $bb * ( 1 - $alpha ) )
	);
}

/**
 * Relative luminance, per WCAG.
 */
function luminance( string $hex ): float {
	$parts = array_map(
		static function ( $channel ) {
			$c = $channel / 255;
			return $c <= 0.03928 ? $c / 12.92 : pow( ( $c + 0.055 ) / 1.055, 2.4 );
		},
		hex_rgb( $hex )
	);

	return 0.2126 * $parts[0] + 0.7152 * $parts[1] + 0.0722 * $parts[2];
}

/**
 * Contrast ratio between two opaque colors.
 */
function ratio( string $a, string $b ): float {
	$la = luminance( $a );
	$lb = luminance( $b );

	return ( max( $la, $lb ) + 0.05 ) / ( min( $la, $lb ) + 0.05 );
}

// --- The palette -------------------------------------------------------------

$c = array(
	'bg'          => '#ffffff',
	'bg-2'        => '#f4f4f2',
	'bg-3'        => '#e8e8e4',
	'ink'         => '#14181a',
	'ink-2'       => '#2f3539',
	'muted'       => '#575f65',
	'muted-2'     => '#656d73',
	'line'        => '#e971e2', // placeholder, overwritten below
	'line-2'      => '#cbcbc5',
	'field'       => '#7e837d',
	'brand-light' => '#c85f3e',
	'brand'       => '#9e3a20',
	'brand-600'   => '#86301a',
	'brand-700'   => '#6e2714',
	'brand-tint'  => '#faf0ec',
	'dark'        => '#16191b',
	'dark-2'      => '#1f2427',
	'dark-3'      => '#2d3439',
);
$c['line'] = '#e2e2de';

// --- Every pair the theme actually renders -----------------------------------

$checks = array(
	// label, foreground, background, required ratio
	array( 'body text on white',            $c['ink-2'],  $c['bg'],         4.5 ),
	array( 'body text on stone',            $c['ink-2'],  $c['bg-2'],       4.5 ),
	array( 'headings on white',             $c['ink'],    $c['bg'],         4.5 ),
	array( 'muted text on white',           $c['muted'],  $c['bg'],         4.5 ),
	array( 'muted text on stone',           $c['muted'],  $c['bg-2'],       4.5 ),
	array( 'card meta (small caps) white',  $c['muted-2'], $c['bg'],        4.5 ),
	array( 'card meta (small caps) stone',  $c['muted-2'], $c['bg-2'],      4.5 ),
	array( 'link on white',                 $c['brand-600'], $c['bg'],      4.5 ),
	array( 'link on stone',                 $c['brand-600'], $c['bg-2'],    4.5 ),
	array( 'link on brand tint',            $c['brand-600'], $c['brand-tint'], 4.5 ),
	array( 'white on brand button',         '#ffffff',    $c['brand'],      4.5 ),
	array( 'white on ink button',           '#ffffff',    $c['ink'],        4.5 ),
	array( 'eyebrow brand on white',        $c['brand-600'], $c['bg'],      4.5 ),

	// Dark sections
	array( 'hero heading on dark',          '#ffffff',    $c['dark'],       4.5 ),
	array( 'hero body on dark',             composite( '#ffffff', 0.80, $c['dark'] ), $c['dark'], 4.5 ),
	array( 'trust bar on dark',             composite( '#ffffff', 0.82, $c['dark'] ), $c['dark'], 4.5 ),
	array( 'breadcrumb link on dark',       composite( '#ffffff', 0.74, $c['dark'] ), $c['dark'], 4.5 ),
	array( 'footer body on dark',           composite( '#ffffff', 0.72, $c['dark'] ), $c['dark'], 4.5 ),
	array( 'footer bottom on dark',         composite( '#ffffff', 0.62, $c['dark'] ), $c['dark'], 4.5 ),
	array( 'panel--dark text',              composite( '#ffffff', 0.76, $c['dark-2'] ), $c['dark-2'], 4.5 ),
	array( 'white on brand (dark section)', '#ffffff',    $c['brand'],      4.5 ),

	// Non-text: boundaries and focus rings need 3:1 against adjacent colour
	array( 'field border on white',         $c['field'], $c['bg'],         3.0 ),
	array( 'field border on stone',         $c['field'], $c['bg-2'],       3.0 ),
	array( 'focus ring on white',           $c['brand'],  $c['bg'],         3.0 ),
	array( 'focus ring on stone',           $c['brand'],  $c['bg-2'],       3.0 ),
	array( 'brand accent on dark',          $c['brand-light'], $c['dark'],  3.0 ),
	array( 'brand accent on dark-2',        $c['brand-light'], $c['dark-2'], 3.0 ),
	array( 'focus ring on dark',            $c['brand-light'], $c['dark'],  3.0 ),
);

// --- Report ------------------------------------------------------------------

$pass = 0;
$fail = 0;

printf( "%-34s %-9s %-9s %7s %6s  %s\n", 'PAIR', 'FG', 'BG', 'RATIO', 'NEEDS', '' );
echo str_repeat( '-', 86 ), "\n";

foreach ( $checks as [ $label, $fg, $bg, $need ] ) {
	$r  = ratio( $fg, $bg );
	$ok = $r >= $need;

	$ok ? $pass++ : $fail++;

	printf(
		"%-34s %-9s %-9s %6.2f:1 %5.1f  %s\n",
		$label,
		$fg,
		$bg,
		$r,
		$need,
		$ok ? 'pass' : '*** FAIL ***'
	);
}

echo str_repeat( '-', 86 ), "\n";
printf( "%d passed, %d failed\n", $pass, $fail );

exit( $fail > 0 ? 1 : 0 );
