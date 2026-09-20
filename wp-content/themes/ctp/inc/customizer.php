<?php
/**
 * Customizer settings.
 *
 * Only the handful of things that genuinely need changing without editing code.
 * Everything else about the business lives in Settings > Business Info.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register sections and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function ctp_customize_register( $wp_customize ) {

	// --- Homepage hero ---------------------------------------------------
	$wp_customize->add_section(
		'ctp_hero',
		array(
			'title'       => __( 'Homepage Hero', 'ctp' ),
			'priority'    => 30,
			'description' => __( 'The headline block at the top of the home page.', 'ctp' ),
		)
	);

	$hero_fields = array(
		'ctp_hero_eyebrow' => array(
			'label'   => __( 'Small line above the headline', 'ctp' ),
			'default' => __( 'Masonry restoration across Chicagoland', 'ctp' ),
			'type'    => 'text',
		),
		'ctp_hero_title'   => array(
			'label'   => __( 'Headline', 'ctp' ),
			'default' => __( 'Tuckpointing and masonry repair that holds up to Chicago winters', 'ctp' ),
			'type'    => 'textarea',
		),
		'ctp_hero_text'    => array(
			'label'   => __( 'Supporting paragraph', 'ctp' ),
			'default' => __( 'Family run out of Wood Dale, working within about an hour in every direction. We will tell you what actually needs doing, put it in writing, and do it properly the first time.', 'ctp' ),
			'type'    => 'textarea',
		),
	);

	foreach ( $hero_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'textarea' === $field['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'ctp_hero',
				'type'    => $field['type'],
			)
		);
	}

	$wp_customize->add_setting(
		'ctp_hero_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'ctp_hero_image',
			array(
				'label'       => __( 'Hero photo', 'ctp' ),
				'description' => __( 'Optional. A wide shot of finished work is ideal, at least 1600px across. Without one the hero uses a clean typographic layout instead, which looks intentional rather than empty.', 'ctp' ),
				'section'     => 'ctp_hero',
				'mime_type'   => 'image',
			)
		)
	);

	// --- Contact form ----------------------------------------------------
	$wp_customize->add_section(
		'ctp_forms',
		array(
			'title'    => __( 'Contact Form', 'ctp' ),
			'priority' => 31,
		)
	);

	$wp_customize->add_setting(
		'ctp_form_shortcode',
		array(
			'default'           => '[fluentform id="1"]',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'ctp_form_shortcode',
		array(
			'label'       => __( 'Form shortcode', 'ctp' ),
			'description' => __( 'Paste the shortcode from Fluent Forms here. It is used on the contact page and anywhere else a form appears.', 'ctp' ),
			'section'     => 'ctp_forms',
			'type'        => 'text',
		)
	);

	// --- Mobile call bar -------------------------------------------------
	$wp_customize->add_section(
		'ctp_mobile',
		array(
			'title'       => __( 'Mobile Call Bar', 'ctp' ),
			'priority'    => 32,
			'description' => __( 'A fixed bar at the bottom of the screen on phones with call and estimate buttons. For a contractor site this is usually the single biggest source of calls, so it is on by default.', 'ctp' ),
		)
	);

	$wp_customize->add_setting(
		'ctp_sticky_bar',
		array(
			'default'           => true,
			'sanitize_callback' => 'ctp_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctp_sticky_bar',
		array(
			'label'   => __( 'Show the mobile call bar', 'ctp' ),
			'section' => 'ctp_mobile',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'ctp_customize_register' );

/**
 * Checkbox sanitizer.
 *
 * @param mixed $value Raw value.
 * @return bool
 */
function ctp_sanitize_checkbox( $value ) {
	return (bool) $value;
}
