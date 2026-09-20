<?php
/**
 * Single project.
 *
 * Project posts are the proof. Once photos exist, set a featured image plus a
 * before and after shot and this page does the rest.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$ctp_id        = get_the_ID();
	$ctp_location  = (string) ctp_meta( 'location', $ctp_id, '' );
	$ctp_completed = (string) ctp_meta( 'completed', $ctp_id, '' );
	$ctp_duration  = (string) ctp_meta( 'duration', $ctp_id, '' );
	$ctp_materials = (string) ctp_meta( 'materials', $ctp_id, '' );
	$ctp_scope     = ctp_meta_lines( 'scope', $ctp_id );
	$ctp_quote     = (string) ctp_meta( 'quote', $ctp_id, '' );
	$ctp_quote_by  = (string) ctp_meta( 'quote_by', $ctp_id, '' );
	$ctp_before    = (int) ctp_meta( 'before_img', $ctp_id, 0 );
	$ctp_after     = (int) ctp_meta( 'after_img', $ctp_id, 0 );
	$ctp_phone     = ctp_business( 'phone' );
	$ctp_service_terms = get_the_terms( $ctp_id, 'ctp_service_link' );
	?>

	<section class="page-hero">
		<div class="container">
			<?php ctp_breadcrumbs( 'light' ); ?>
			<h1><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="page-hero__text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
			<?php endif; ?>

			<ul class="page-hero__meta">
				<?php if ( $ctp_location ) : ?>
					<li><?php ctp_icon( 'pin', 16 ); ?><span><?php echo esc_html( $ctp_location ); ?></span></li>
				<?php endif; ?>
				<?php if ( $ctp_completed ) : ?>
					<li><?php ctp_icon( 'check', 16 ); ?><span><?php echo esc_html( $ctp_completed ); ?></span></li>
				<?php endif; ?>
				<?php if ( $ctp_duration ) : ?>
					<li><?php ctp_icon( 'clock', 16 ); ?><span><?php echo esc_html( $ctp_duration ); ?></span></li>
				<?php endif; ?>
			</ul>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="layout layout--sidebar">

				<article <?php post_class( 'u-flow' ); ?>>

					<?php if ( $ctp_before && $ctp_after ) : ?>
						<figure class="ba" style="margin:0">
							<div class="ba__pane">
								<?php echo wp_get_attachment_image( $ctp_before, 'ctp-wide', false, array( 'alt' => esc_attr__( 'Before', 'ctp' ) ) ); ?>
							</div>
							<div class="ba__after">
								<?php echo wp_get_attachment_image( $ctp_after, 'ctp-wide', false, array( 'alt' => esc_attr__( 'After', 'ctp' ) ) ); ?>
							</div>
							<span class="ba__label ba__label--before"><?php esc_html_e( 'Before', 'ctp' ); ?></span>
							<span class="ba__label ba__label--after"><?php esc_html_e( 'After', 'ctp' ); ?></span>
							<button
								class="ba__handle"
								type="button"
								role="slider"
								tabindex="0"
								aria-label="<?php esc_attr_e( 'Drag to compare before and after', 'ctp' ); ?>"
								aria-valuemin="0"
								aria-valuemax="100"
								aria-valuenow="50">
								<span class="ba__grip" aria-hidden="true">&#8596;</span>
							</button>
						</figure>
					<?php else : ?>
						<?php ctp_media( $ctp_id, 'ctp-wide', 'media--wide media--rounded' ); ?>
					<?php endif; ?>

					<div class="prose prose--wide u-mt-6">
						<?php the_content(); ?>
					</div>

					<?php if ( $ctp_scope ) : ?>
						<div class="panel u-mt-7">
							<h2 class="panel__title"><?php esc_html_e( 'Scope of work', 'ctp' ); ?></h2>
							<?php ctp_checklist( $ctp_scope, 'checklist--2' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_quote ) : ?>
						<div class="quote-block u-mt-7">
							<?php ctp_icon( 'quote', 28 ); ?>
							<blockquote><?php echo esc_html( $ctp_quote ); ?></blockquote>
							<?php if ( $ctp_quote_by ) : ?>
								<cite><?php echo esc_html( $ctp_quote_by ); ?></cite>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				</article>

				<aside class="sidebar sidebar--sticky">

					<div class="panel">
						<h2 class="panel__title"><?php esc_html_e( 'Project details', 'ctp' ); ?></h2>
						<dl class="spec-list">
							<?php if ( $ctp_location ) : ?>
								<div><dt><?php esc_html_e( 'Location', 'ctp' ); ?></dt><dd><?php echo esc_html( $ctp_location ); ?></dd></div>
							<?php endif; ?>
							<?php if ( $ctp_completed ) : ?>
								<div><dt><?php esc_html_e( 'Completed', 'ctp' ); ?></dt><dd><?php echo esc_html( $ctp_completed ); ?></dd></div>
							<?php endif; ?>
							<?php if ( $ctp_duration ) : ?>
								<div><dt><?php esc_html_e( 'Time on site', 'ctp' ); ?></dt><dd><?php echo esc_html( $ctp_duration ); ?></dd></div>
							<?php endif; ?>
							<?php if ( $ctp_materials ) : ?>
								<div><dt><?php esc_html_e( 'Materials', 'ctp' ); ?></dt><dd><?php echo esc_html( $ctp_materials ); ?></dd></div>
							<?php endif; ?>
						</dl>
					</div>

					<?php if ( $ctp_service_terms && ! is_wp_error( $ctp_service_terms ) ) : ?>
						<div class="panel">
							<h2 class="panel__title"><?php esc_html_e( 'Services used', 'ctp' ); ?></h2>
							<ul class="pill-row">
								<?php foreach ( $ctp_service_terms as $ctp_term ) : ?>
									<?php $ctp_service_post = get_page_by_path( $ctp_term->slug, OBJECT, 'ctp_service' ); ?>
									<li>
										<?php if ( $ctp_service_post ) : ?>
											<a class="pill" href="<?php echo esc_url( (string) get_permalink( $ctp_service_post ) ); ?>">
												<?php echo esc_html( $ctp_term->name ); ?>
											</a>
										<?php else : ?>
											<span class="pill"><?php echo esc_html( $ctp_term->name ); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<div class="panel panel--dark">
						<h2 class="panel__title"><?php esc_html_e( 'Want something similar?', 'ctp' ); ?></h2>
						<p class="panel__text"><?php esc_html_e( 'Send a photo of what you are dealing with and we will tell you what it would take.', 'ctp' ); ?></p>
						<div class="u-mt-5 u-flow">
							<?php if ( $ctp_phone ) : ?>
								<a class="btn btn--primary btn--block" href="tel:<?php echo esc_attr( ctp_tel( $ctp_phone ) ); ?>">
									<?php ctp_icon( 'phone', 17 ); ?>
									<?php echo esc_html( $ctp_phone ); ?>
								</a>
							<?php endif; ?>
							<a class="btn btn--ghost-light btn--block" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
								<?php esc_html_e( 'Request an estimate', 'ctp' ); ?>
							</a>
						</div>
					</div>

				</aside>

			</div>
		</div>
	</section>

	<?php
	ctp_cta_band();

endwhile;

get_footer();
