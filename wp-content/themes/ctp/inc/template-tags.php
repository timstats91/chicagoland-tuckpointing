<?php
/**
 * Template helpers.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Build the breadcrumb trail. Also consumed by the schema output in the plugin,
 * so the visible breadcrumbs and the structured data can never disagree.
 *
 * @return array<int,array{label:string,url:string}>
 */
function ctp_breadcrumb_trail() {
	$trail = array(
		array(
			'label' => __( 'Home', 'ctp' ),
			'url'   => home_url( '/' ),
		),
	);

	if ( is_front_page() ) {
		return array();
	}

	if ( is_singular( 'ctp_service' ) ) {
		$trail[] = array( 'label' => __( 'Services', 'ctp' ), 'url' => ctp_url( 'services' ) );
		$trail[] = array( 'label' => get_the_title(), 'url' => '' );
	} elseif ( is_post_type_archive( 'ctp_service' ) ) {
		$trail[] = array( 'label' => __( 'Services', 'ctp' ), 'url' => '' );
	} elseif ( is_singular( 'ctp_area' ) ) {
		$trail[] = array( 'label' => __( 'Service Areas', 'ctp' ), 'url' => ctp_url( 'areas' ) );
		$trail[] = array( 'label' => get_the_title(), 'url' => '' );
	} elseif ( is_post_type_archive( 'ctp_area' ) ) {
		$trail[] = array( 'label' => __( 'Service Areas', 'ctp' ), 'url' => '' );
	} elseif ( is_singular( 'ctp_project' ) ) {
		$trail[] = array( 'label' => __( 'Projects', 'ctp' ), 'url' => ctp_url( 'projects' ) );
		$trail[] = array( 'label' => get_the_title(), 'url' => '' );
	} elseif ( is_post_type_archive( 'ctp_project' ) ) {
		$trail[] = array( 'label' => __( 'Projects', 'ctp' ), 'url' => '' );
	} elseif ( is_singular( 'post' ) ) {
		$trail[] = array( 'label' => __( 'Knowledge Hub', 'ctp' ), 'url' => ctp_url( 'hub' ) );
		$trail[] = array( 'label' => get_the_title(), 'url' => '' );
	} elseif ( is_home() ) {
		$trail[] = array( 'label' => __( 'Knowledge Hub', 'ctp' ), 'url' => '' );
	} elseif ( is_page() ) {
		$parent_id = wp_get_post_parent_id( get_the_ID() );

		if ( $parent_id ) {
			$trail[] = array( 'label' => get_the_title( $parent_id ), 'url' => get_permalink( $parent_id ) );
		}

		$trail[] = array( 'label' => get_the_title(), 'url' => '' );
	} elseif ( is_search() ) {
		$trail[] = array( 'label' => __( 'Search results', 'ctp' ), 'url' => '' );
	} elseif ( is_404() ) {
		$trail[] = array( 'label' => __( 'Page not found', 'ctp' ), 'url' => '' );
	} elseif ( is_archive() ) {
		$trail[] = array( 'label' => wp_strip_all_tags( get_the_archive_title() ), 'url' => '' );
	}

	return $trail;
}

/**
 * Print the breadcrumbs.
 *
 * @param string $variant Empty for default, 'light' on dark backgrounds.
 */
function ctp_breadcrumbs( $variant = '' ) {
	$trail = ctp_breadcrumb_trail();

	if ( count( $trail ) < 2 ) {
		return;
	}

	$class = 'breadcrumbs' . ( $variant ? ' breadcrumbs--' . $variant : '' );

	echo '<nav class="' . esc_attr( $class ) . '" aria-label="' . esc_attr__( 'Breadcrumb', 'ctp' ) . '"><ol>';

	$last = count( $trail ) - 1;

	foreach ( $trail as $i => $crumb ) {
		echo '<li>';

		if ( $crumb['url'] && $i !== $last ) {
			printf( '<a href="%s">%s</a>', esc_url( $crumb['url'] ), esc_html( $crumb['label'] ) );
		} else {
			printf( '<span aria-current="page">%s</span>', esc_html( $crumb['label'] ) );
		}

		echo '</li>';
	}

	echo '</ol></nav>';
}

/**
 * A featured image, or a styled placeholder when there is not one yet.
 *
 * The placeholder is deliberate: an empty box looks broken, whereas this looks
 * like a slot waiting for a photo. Delete nothing when the photos arrive; just
 * set a featured image and it takes over.
 *
 * @param int|null $post_id Post ID.
 * @param string   $size    Image size.
 * @param string   $class   Wrapper classes.
 * @param string   $label   Placeholder caption.
 */
function ctp_media( $post_id = null, $size = 'ctp-card', $class = '', $label = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$classes = trim( 'media ' . $class );

	if ( $post_id && has_post_thumbnail( $post_id ) ) {
		printf( '<div class="%s">', esc_attr( $classes ) );
		echo get_the_post_thumbnail(
			$post_id,
			$size,
			array(
				'loading'  => 'lazy',
				'decoding' => 'async',
				'alt'      => esc_attr( get_the_title( $post_id ) ),
			)
		);
		echo '</div>';
		return;
	}

	$label = $label ? $label : __( 'Photo coming soon', 'ctp' );

	printf( '<div class="%s media--placeholder" role="img" aria-label="%s">', esc_attr( $classes ), esc_attr( $label ) );
	echo '<span class="media__mark">' . ctp_get_icon( 'brick', 28 ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '<span class="media__label">' . esc_html( $label ) . '</span>';
	echo '</div>';
}

/**
 * Service card.
 *
 * @param WP_Post|int $service Service post.
 */
function ctp_service_card( $service ) {
	$post_id = is_object( $service ) ? (int) $service->ID : (int) $service;
	$tagline = (string) ctp_meta( 'tagline', $post_id, '' );

	if ( ! $tagline ) {
		$tagline = wp_strip_all_tags( get_the_excerpt( $post_id ) );
	}
	?>
	<a class="card card--service" href="<?php echo esc_url( (string) get_permalink( $post_id ) ); ?>">
		<span class="card__icon"><?php ctp_icon( ctp_service_icon_name( $post_id ), 26 ); ?></span>
		<h3 class="card__title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
		<p class="card__text"><?php echo esc_html( $tagline ); ?></p>
		<span class="card__more"><?php esc_html_e( 'Learn more', 'ctp' ); ?><?php ctp_icon( 'arrow', 16 ); ?></span>
	</a>
	<?php
}

/**
 * Service area card.
 *
 * @param WP_Post|int $area Area post.
 */
function ctp_area_card( $area ) {
	$post_id = is_object( $area ) ? (int) $area->ID : (int) $area;
	$county  = (string) ctp_meta( 'county', $post_id, '' );
	$drive   = (string) ctp_meta( 'drive_time', $post_id, '' );
	?>
	<a class="card card--area" href="<?php echo esc_url( (string) get_permalink( $post_id ) ); ?>">
		<span class="card__icon card__icon--sm"><?php ctp_icon( 'pin', 20 ); ?></span>
		<h3 class="card__title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
		<?php if ( $county ) : ?>
			<p class="card__meta"><?php echo esc_html( $county ); ?></p>
		<?php endif; ?>
		<?php if ( $drive ) : ?>
			<p class="card__text"><?php echo esc_html( $drive ); ?></p>
		<?php endif; ?>
	</a>
	<?php
}

/**
 * Project card.
 *
 * @param WP_Post|int $project Project post.
 */
function ctp_project_card( $project ) {
	$post_id  = is_object( $project ) ? (int) $project->ID : (int) $project;
	$location = (string) ctp_meta( 'location', $post_id, '' );
	?>
	<a class="card card--project" href="<?php echo esc_url( (string) get_permalink( $post_id ) ); ?>">
		<?php ctp_media( $post_id, 'ctp-card', 'card__media' ); ?>
		<div class="card__body">
			<?php if ( $location ) : ?>
				<p class="card__meta"><?php ctp_icon( 'pin', 14 ); ?><?php echo esc_html( $location ); ?></p>
			<?php endif; ?>
			<h3 class="card__title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
			<p class="card__text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt( $post_id ) ) ); ?></p>
		</div>
	</a>
	<?php
}

/**
 * Knowledge hub article card.
 *
 * @param WP_Post|int $post Post.
 */
function ctp_post_card( $post ) {
	$post_id = is_object( $post ) ? (int) $post->ID : (int) $post;
	?>
	<a class="card card--post" href="<?php echo esc_url( (string) get_permalink( $post_id ) ); ?>">
		<div class="card__body">
			<p class="card__meta"><?php ctp_icon( 'clock', 14 ); ?><?php echo esc_html( ctp_reading_time( $post_id ) ); ?></p>
			<h3 class="card__title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
			<p class="card__text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt( $post_id ) ) ); ?></p>
			<span class="card__more"><?php esc_html_e( 'Read', 'ctp' ); ?><?php ctp_icon( 'arrow', 16 ); ?></span>
		</div>
	</a>
	<?php
}

/**
 * Rough reading time.
 *
 * @param int|null $post_id Post ID.
 * @return string
 */
function ctp_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$words   = str_word_count( wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) ) );
	$minutes = max( 1, (int) round( $words / 220 ) );

	/* translators: %d: number of minutes. */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'ctp' ), $minutes );
}

/**
 * Checklist rendered from a set of lines.
 *
 * @param string[] $lines Items.
 * @param string   $class Extra classes.
 */
function ctp_checklist( array $lines, $class = '' ) {
	if ( ! $lines ) {
		return;
	}

	printf( '<ul class="checklist %s">', esc_attr( $class ) );

	foreach ( $lines as $line ) {
		echo '<li>' . ctp_get_icon( 'check', 18 ) . '<span>' . esc_html( $line ) . '</span></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	echo '</ul>';
}

/**
 * Numbered process steps from "Title | Description" lines.
 *
 * @param string[] $lines Steps.
 */
function ctp_process_steps( array $lines ) {
	if ( ! $lines ) {
		return;
	}

	echo '<ol class="steps">';

	$n = 1;

	foreach ( $lines as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$title = $parts[0];
		$text  = isset( $parts[1] ) ? $parts[1] : '';

		echo '<li class="steps__item">';
		echo '<span class="steps__num">' . esc_html( (string) $n ) . '</span>';
		echo '<div class="steps__body">';
		echo '<h3 class="steps__title">' . esc_html( $title ) . '</h3>';

		if ( $text ) {
			echo '<p class="steps__text">' . esc_html( $text ) . '</p>';
		}

		echo '</div></li>';
		$n++;
	}

	echo '</ol>';
}

/**
 * FAQ accordion. Uses native details/summary, so it works with no JavaScript.
 *
 * @param array<int,array{q:string,a:string}> $faqs  FAQ pairs.
 * @param string                              $title Section heading.
 */
function ctp_faqs( array $faqs, $title = '' ) {
	if ( ! $faqs ) {
		return;
	}

	echo '<div class="faqs">';

	if ( $title ) {
		echo '<h2 class="section__title">' . esc_html( $title ) . '</h2>';
	}

	foreach ( $faqs as $faq ) {
		echo '<details class="faq">';
		echo '<summary class="faq__q">' . esc_html( $faq['q'] ) . ctp_get_icon( 'chevron', 20, 'faq__chevron' ) . '</summary>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<div class="faq__a"><p>' . esc_html( $faq['a'] ) . '</p></div>';
		echo '</details>';
	}

	echo '</div>';
}

/**
 * The closing call to action, used at the bottom of nearly every template.
 *
 * @param string $heading Optional heading override.
 * @param string $text    Optional body override.
 */
function ctp_cta_band( $heading = '', $text = '' ) {
	$heading = $heading ? $heading : __( 'Get a free, no-pressure estimate', 'ctp' );
	$text    = $text ? $text : __( 'We look at the work, tell you honestly what needs doing, and put a written price in your hands. No expiring discounts, no follow-up calls three times a week.', 'ctp' );
	?>
	<section class="cta-band">
		<div class="container">
			<div class="cta-band__inner">
				<h2 class="cta-band__title"><?php echo esc_html( $heading ); ?></h2>
				<p class="cta-band__text"><?php echo esc_html( $text ); ?></p>
				<div class="cta-band__actions">
					<?php if ( ctp_business( 'phone' ) ) : ?>
						<a class="btn btn--primary btn--lg" href="tel:<?php echo esc_attr( ctp_tel( ctp_business( 'phone' ) ) ); ?>">
							<?php ctp_icon( 'phone', 18 ); ?>
							<?php echo esc_html( ctp_business( 'phone' ) ); ?>
						</a>
					<?php endif; ?>
					<a class="btn btn--ghost-light btn--lg" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
						<?php esc_html_e( 'Request an estimate', 'ctp' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * The short trust strip under the hero.
 */
function ctp_trust_bar() {
	$years   = ctp_years_in_business();
	$items   = array();

	if ( $years > 0 ) {
		$items[] = array(
			'icon' => 'hammer',
			/* translators: %d: number of years. */
			'text' => sprintf( _n( '%d year in business', '%d years in business', $years, 'ctp' ), $years ),
		);
	}

	if ( ctp_business( 'insured' ) ) {
		$items[] = array( 'icon' => 'shield', 'text' => __( 'Licensed and fully insured', 'ctp' ) );
	}

	$items[] = array( 'icon' => 'pin', 'text' => __( 'Family run, based in Wood Dale', 'ctp' ) );
	$items[] = array( 'icon' => 'check', 'text' => __( 'Free written estimates', 'ctp' ) );

	echo '<ul class="trust-bar">';

	foreach ( $items as $item ) {
		echo '<li>' . ctp_get_icon( $item['icon'], 18 ) . '<span>' . esc_html( $item['text'] ) . '</span></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	echo '</ul>';
}

/**
 * Compact linked list of every service, used in sidebars and footers.
 *
 * @param int $current_id Post ID to mark as current.
 */
function ctp_service_list( $current_id = 0 ) {
	$services = ctp_get_services();

	if ( ! $services ) {
		return;
	}

	echo '<ul class="link-list">';

	foreach ( $services as $service ) {
		$is_current = ( (int) $service->ID === (int) $current_id );

		printf(
			'<li%1$s><a href="%2$s">%3$s</a></li>',
			$is_current ? ' class="is-current"' : '',
			esc_url( (string) get_permalink( $service ) ),
			esc_html( get_the_title( $service ) )
		);
	}

	echo '</ul>';
}

/**
 * The contact form: the configured shortcode, or a clear fallback so the page
 * is never a dead end if the forms plugin is missing.
 */
function ctp_contact_form() {
	$shortcode = trim( (string) get_theme_mod( 'ctp_form_shortcode', '[fluentform id="1"]' ) );

	if ( $shortcode ) {
		$rendered = do_shortcode( $shortcode );

		// An unregistered shortcode comes back unchanged; treat that as absent.
		if ( trim( $rendered ) !== $shortcode ) {
			echo $rendered; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- shortcode output.
			return;
		}
	}

	?>
	<div class="form-fallback">
		<p class="form-fallback__title"><?php esc_html_e( 'The contact form is not connected yet.', 'ctp' ); ?></p>
		<p>
			<?php esc_html_e( 'Install and activate Fluent Forms, build a form, then paste its shortcode under Appearance > Customize > Contact Form. Until then, use the phone number or email below.', 'ctp' ); ?>
		</p>
		<?php if ( current_user_can( 'manage_options' ) ) : ?>
			<p>
				<a class="btn btn--primary" href="<?php echo esc_url( admin_url( 'plugin-install.php?s=fluent+forms&tab=search&type=term' ) ); ?>">
					<?php esc_html_e( 'Install Fluent Forms', 'ctp' ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
	<?php
}
