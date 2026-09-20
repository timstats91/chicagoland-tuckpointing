<?php
/**
 * Custom fields for services, areas and projects.
 *
 * Plain core meta boxes on purpose: no ACF dependency, nothing to renew, and
 * one less plugin loading on every admin page.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definitions, keyed by post type then by meta key.
 *
 * Supported types: text, textarea, number, url, select, image, checkbox.
 *
 * @return array<string,array<string,array<string,mixed>>>
 */
function ctp_field_schema() {
	return array(
		'ctp_service' => array(
			'icon'      => array(
				'label'   => __( 'Icon', 'ctp-core' ),
				'type'    => 'select',
				'options' => ctp_icon_choices(),
				'desc'    => __( 'Shown on service cards and the homepage grid.', 'ctp-core' ),
			),
			'tagline'   => array(
				'label' => __( 'Card tagline', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'One short line, around 8-14 words. Used on cards and the services grid.', 'ctp-core' ),
			),
			'price'     => array(
				'label' => __( 'Typical investment', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: Most homes fall between $2,400 and $7,500. Leave blank to hide.', 'ctp-core' ),
			),
			'duration'  => array(
				'label' => __( 'Typical timeline', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: 2-5 working days, weather permitting.', 'ctp-core' ),
			),
			'signs'     => array(
				'label' => __( 'Signs you need this', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One per line. Rendered as a checklist near the top of the page.', 'ctp-core' ),
				'rows'  => 6,
			),
			'includes'  => array(
				'label' => __( "What's included", 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One per line. Rendered as the scope-of-work list.', 'ctp-core' ),
				'rows'  => 8,
			),
			'process'   => array(
				'label' => __( 'Our process', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One step per line, formatted as: Step name | What happens in this step.', 'ctp-core' ),
				'rows'  => 6,
			),
			'faq'       => array(
				'label' => __( 'FAQs', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One per line, formatted as: Question? | Answer. These also generate FAQ schema for Google.', 'ctp-core' ),
				'rows'  => 8,
			),
		),

		'ctp_area'    => array(
			'county'        => array(
				'label' => __( 'County', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: DuPage County.', 'ctp-core' ),
			),
			'drive_time'    => array(
				'label' => __( 'Distance from the shop', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: 12 minutes from our Wood Dale shop.', 'ctp-core' ),
			),
			'zips'          => array(
				'label' => __( 'ZIP codes served', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'Comma separated. Used on the page and in local search schema.', 'ctp-core' ),
			),
			'neighborhoods' => array(
				'label' => __( 'Neighborhoods and subdivisions', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One per line. Helps the page rank for very local searches.', 'ctp-core' ),
				'rows'  => 6,
			),
			'housing'       => array(
				'label' => __( 'Local masonry notes', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One per line. What the housing stock is like here and what typically fails, e.g. 1950s brick ranches with soft lime mortar.', 'ctp-core' ),
				'rows'  => 5,
			),
			'faq'           => array(
				'label' => __( 'FAQs', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One per line, formatted as: Question? | Answer.', 'ctp-core' ),
				'rows'  => 6,
			),
		),

		'ctp_project' => array(
			'location'    => array(
				'label' => __( 'Location', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'City and state, for example: Elmhurst, IL. Never publish a full street address.', 'ctp-core' ),
			),
			'completed'   => array(
				'label' => __( 'Completed', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: June 2026.', 'ctp-core' ),
			),
			'duration'    => array(
				'label' => __( 'Time on site', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: 4 days.', 'ctp-core' ),
			),
			'scope'       => array(
				'label' => __( 'Scope of work', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'One line per item.', 'ctp-core' ),
				'rows'  => 6,
			),
			'materials'   => array(
				'label' => __( 'Materials used', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: Type N mortar, color-matched to original.', 'ctp-core' ),
			),
			'before_img'  => array(
				'label' => __( 'Before photo', 'ctp-core' ),
				'type'  => 'image',
				'desc'  => __( 'Shown in the before/after slider. Use the same camera angle as the after photo.', 'ctp-core' ),
			),
			'after_img'   => array(
				'label' => __( 'After photo', 'ctp-core' ),
				'type'  => 'image',
				'desc'  => __( 'Shown in the before/after slider.', 'ctp-core' ),
			),
			'quote'       => array(
				'label' => __( 'Customer quote', 'ctp-core' ),
				'type'  => 'textarea',
				'desc'  => __( 'Optional. Only publish quotes the customer agreed to.', 'ctp-core' ),
				'rows'  => 4,
			),
			'quote_by'    => array(
				'label' => __( 'Quote attribution', 'ctp-core' ),
				'type'  => 'text',
				'desc'  => __( 'For example: Maria R., Elmhurst.', 'ctp-core' ),
			),
		),
	);
}

/**
 * The icon keys the theme can render.
 *
 * @return array<string,string>
 */
function ctp_icon_choices() {
	return array(
		'trowel'     => __( 'Trowel (tuckpointing)', 'ctp-core' ),
		'brick'      => __( 'Brick wall (masonry)', 'ctp-core' ),
		'chimney'    => __( 'Chimney', 'ctp-core' ),
		'caulk'      => __( 'Caulk gun (sealant)', 'ctp-core' ),
		'patio'      => __( 'Pavers (patios and walkways)', 'ctp-core' ),
		'lintel'     => __( 'Lintel and steel', 'ctp-core' ),
		'stone'      => __( 'Stone and limestone', 'ctp-core' ),
		'waterproof' => __( 'Waterproofing', 'ctp-core' ),
		'wash'       => __( 'Power washing', 'ctp-core' ),
		'steps'      => __( 'Steps and stoops', 'ctp-core' ),
		'wall'       => __( 'Retaining and parapet walls', 'ctp-core' ),
		'inspect'    => __( 'Inspection', 'ctp-core' ),
	);
}

/**
 * Register one meta box per supported post type.
 */
function ctp_add_meta_boxes() {
	foreach ( ctp_field_schema() as $post_type => $fields ) {
		$labels = get_post_type_object( $post_type );

		add_meta_box(
			'ctp_details',
			$labels ? sprintf( '%s Details', $labels->labels->singular_name ) : __( 'Details', 'ctp-core' ),
			'ctp_render_meta_box',
			$post_type,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'ctp_add_meta_boxes' );

/**
 * Render the fields for the current post type.
 *
 * @param WP_Post $post Post being edited.
 */
function ctp_render_meta_box( $post ) {
	$schema = ctp_field_schema();

	if ( ! isset( $schema[ $post->post_type ] ) ) {
		return;
	}

	wp_nonce_field( 'ctp_save_meta', 'ctp_meta_nonce' );

	echo '<div class="ctp-fields">';

	foreach ( $schema[ $post->post_type ] as $key => $field ) {
		$value = get_post_meta( $post->ID, '_ctp_' . $key, true );
		$id    = 'ctp_' . $key;
		$name  = 'ctp_' . $key;

		echo '<p class="ctp-field ctp-field--' . esc_attr( $field['type'] ) . '">';
		echo '<label for="' . esc_attr( $id ) . '"><strong>' . esc_html( $field['label'] ) . '</strong></label>';

		switch ( $field['type'] ) {
			case 'textarea':
				printf(
					'<textarea id="%1$s" name="%1$s" rows="%2$d" class="large-text code">%3$s</textarea>',
					esc_attr( $id ),
					isset( $field['rows'] ) ? (int) $field['rows'] : 5,
					esc_textarea( (string) $value )
				);
				break;

			case 'select':
				echo '<select id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '">';
				echo '<option value="">' . esc_html__( '— none —', 'ctp-core' ) . '</option>';
				foreach ( $field['options'] as $opt_value => $opt_label ) {
					printf(
						'<option value="%1$s" %2$s>%3$s</option>',
						esc_attr( $opt_value ),
						selected( $value, $opt_value, false ),
						esc_html( $opt_label )
					);
				}
				echo '</select>';
				break;

			case 'image':
				$attachment_id = (int) $value;
				$preview       = $attachment_id ? wp_get_attachment_image( $attachment_id, 'medium' ) : '';

				echo '<span class="ctp-image-field">';
				echo '<span class="ctp-image-field__preview">' . wp_kses_post( $preview ) . '</span>';
				printf(
					'<input type="hidden" id="%1$s" name="%1$s" value="%2$s" />',
					esc_attr( $id ),
					esc_attr( (string) $attachment_id )
				);
				echo '<button type="button" class="button ctp-image-pick">' . esc_html__( 'Choose image', 'ctp-core' ) . '</button> ';
				echo '<button type="button" class="button-link ctp-image-clear">' . esc_html__( 'Remove', 'ctp-core' ) . '</button>';
				echo '</span>';
				break;

			case 'number':
			case 'url':
			case 'text':
			default:
				printf(
					'<input type="%1$s" id="%2$s" name="%2$s" value="%3$s" class="large-text" />',
					esc_attr( 'text' === $field['type'] ? 'text' : $field['type'] ),
					esc_attr( $id ),
					esc_attr( (string) $value )
				);
				break;
		}

		if ( ! empty( $field['desc'] ) ) {
			echo '<span class="description">' . esc_html( $field['desc'] ) . '</span>';
		}

		echo '</p>';
	}

	echo '</div>';
}

/**
 * Save the fields.
 *
 * @param int $post_id Post ID.
 */
function ctp_save_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['ctp_meta_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['ctp_meta_nonce'] ) );

	if ( ! wp_verify_nonce( $nonce, 'ctp_save_meta' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_type = get_post_type( $post_id );
	$schema    = ctp_field_schema();

	if ( ! isset( $schema[ $post_type ] ) ) {
		return;
	}

	foreach ( $schema[ $post_type ] as $key => $field ) {
		$name = 'ctp_' . $key;

		if ( ! isset( $_POST[ $name ] ) ) {
			delete_post_meta( $post_id, '_ctp_' . $key );
			continue;
		}

		$raw = wp_unslash( $_POST[ $name ] );

		switch ( $field['type'] ) {
			case 'textarea':
				$clean = sanitize_textarea_field( $raw );
				break;
			case 'image':
			case 'number':
				$clean = (string) absint( $raw );
				$clean = '0' === $clean ? '' : $clean;
				break;
			case 'url':
				$clean = esc_url_raw( $raw );
				break;
			case 'select':
				$clean = array_key_exists( $raw, $field['options'] ) ? $raw : '';
				break;
			default:
				$clean = sanitize_text_field( $raw );
				break;
		}

		if ( '' === $clean ) {
			delete_post_meta( $post_id, '_ctp_' . $key );
		} else {
			update_post_meta( $post_id, '_ctp_' . $key, $clean );
		}
	}
}
add_action( 'save_post', 'ctp_save_meta' );

/**
 * Admin styles and the media picker, loaded only on the edit screens that need them.
 *
 * @param string $hook Current admin page.
 */
function ctp_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( ! $screen || ! array_key_exists( $screen->post_type, ctp_field_schema() ) ) {
		return;
	}

	wp_enqueue_media();

	$css = '.ctp-fields{display:grid;gap:18px}'
		. '.ctp-field{margin:0;display:grid;gap:5px}'
		. '.ctp-field .description{font-style:normal;color:#646970}'
		. '.ctp-image-field{display:flex;align-items:center;gap:10px;flex-wrap:wrap}'
		. '.ctp-image-field__preview img{max-width:160px;height:auto;border-radius:6px;display:block}';

	wp_register_style( 'ctp-admin', false, array(), CTP_CORE_VERSION );
	wp_enqueue_style( 'ctp-admin' );
	wp_add_inline_style( 'ctp-admin', $css );

	$js = <<<'JS'
( function () {
	document.addEventListener( 'click', function ( event ) {
		var wrap;

		if ( event.target.classList.contains( 'ctp-image-pick' ) ) {
			event.preventDefault();
			wrap = event.target.closest( '.ctp-image-field' );

			var frame = wp.media( {
				title: 'Choose image',
				multiple: false,
				library: { type: 'image' },
				button: { text: 'Use this image' }
			} );

			frame.on( 'select', function () {
				var attachment = frame.state().get( 'selection' ).first().toJSON();
				var url = ( attachment.sizes && attachment.sizes.medium )
					? attachment.sizes.medium.url
					: attachment.url;

				wrap.querySelector( 'input[type="hidden"]' ).value = attachment.id;
				wrap.querySelector( '.ctp-image-field__preview' ).innerHTML =
					'<img src="' + url + '" alt="" />';
			} );

			frame.open();
		}

		if ( event.target.classList.contains( 'ctp-image-clear' ) ) {
			event.preventDefault();
			wrap = event.target.closest( '.ctp-image-field' );
			wrap.querySelector( 'input[type="hidden"]' ).value = '';
			wrap.querySelector( '.ctp-image-field__preview' ).innerHTML = '';
		}
	} );
}() );
JS;

	wp_register_script( 'ctp-admin', false, array( 'media-editor' ), CTP_CORE_VERSION, true );
	wp_enqueue_script( 'ctp-admin' );
	wp_add_inline_script( 'ctp-admin', $js );
}
add_action( 'admin_enqueue_scripts', 'ctp_admin_assets' );
