<?php
/**
 * Single service.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$ctp_id       = get_the_ID();
	$ctp_slug     = (string) get_post_field( 'post_name', $ctp_id );
	$ctp_price    = (string) ctp_meta( 'price', $ctp_id, '' );
	$ctp_duration = (string) ctp_meta( 'duration', $ctp_id, '' );
	$ctp_signs    = ctp_meta_lines( 'signs', $ctp_id );
	$ctp_includes = ctp_meta_lines( 'includes', $ctp_id );
	$ctp_process  = ctp_meta_lines( 'process', $ctp_id );
	$ctp_faqs     = ctp_meta_faq( 'faq', $ctp_id );
	$ctp_phone    = ctp_business( 'phone' );
	$ctp_projects = ctp_linked_posts( 'ctp_service_link', $ctp_slug, array( 'ctp_project' ), 3 );
	$ctp_articles = ctp_linked_posts( 'ctp_service_link', $ctp_slug, array( 'post' ), 3 );
	?>

	<section class="page-hero">
		<div class="container">
			<?php ctp_breadcrumbs( 'light' ); ?>
			<h1><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="page-hero__text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
			<?php endif; ?>

			<?php if ( $ctp_price || $ctp_duration ) : ?>
				<ul class="page-hero__meta">
					<?php if ( $ctp_price ) : ?>
						<li><?php ctp_icon( 'check', 16 ); ?><span><?php echo esc_html( $ctp_price ); ?></span></li>
					<?php endif; ?>
					<?php if ( $ctp_duration ) : ?>
						<li><?php ctp_icon( 'clock', 16 ); ?><span><?php echo esc_html( $ctp_duration ); ?></span></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="layout layout--sidebar">

				<article <?php post_class( 'u-flow' ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<?php ctp_media( $ctp_id, 'ctp-wide', 'media--wide media--rounded' ); ?>
					<?php endif; ?>

					<div class="prose prose--wide">
						<?php the_content(); ?>
					</div>

					<?php if ( $ctp_signs ) : ?>
						<div class="panel u-mt-7">
							<h2 class="panel__title"><?php esc_html_e( 'Signs you need this work', 'ctp' ); ?></h2>
							<?php ctp_checklist( $ctp_signs, 'checklist--2' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_includes ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title"><?php esc_html_e( "What's included", 'ctp' ); ?></h2>
							<?php ctp_checklist( $ctp_includes, 'checklist--2' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_process ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title"><?php esc_html_e( 'How we do it', 'ctp' ); ?></h2>
							<?php ctp_process_steps( $ctp_process ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_projects ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title"><?php esc_html_e( 'Recent projects', 'ctp' ); ?></h2>
							<div class="card-grid card-grid--3">
								<?php foreach ( $ctp_projects as $ctp_project ) : ?>
									<?php ctp_project_card( $ctp_project ); ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_faqs ) : ?>
						<div class="u-mt-7">
							<?php ctp_faqs( $ctp_faqs, __( 'Common questions', 'ctp' ) ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_articles ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title"><?php esc_html_e( 'Read more on this', 'ctp' ); ?></h2>
							<div class="card-grid card-grid--3">
								<?php foreach ( $ctp_articles as $ctp_article ) : ?>
									<?php ctp_post_card( $ctp_article ); ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

				</article>

				<aside class="sidebar sidebar--sticky">

					<div class="panel panel--dark">
						<h2 class="panel__title"><?php esc_html_e( 'Free written estimate', 'ctp' ); ?></h2>
						<p class="panel__text">
							<?php esc_html_e( 'Tell us what you are seeing and we will take a look. No obligation, no expiring price.', 'ctp' ); ?>
						</p>
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

					<div class="panel">
						<h2 class="panel__title"><?php esc_html_e( 'Other services', 'ctp' ); ?></h2>
						<?php ctp_service_list( $ctp_id ); ?>
					</div>

					<?php $ctp_areas = ctp_get_areas( 8 ); ?>
					<?php if ( $ctp_areas ) : ?>
						<div class="panel">
							<h2 class="panel__title"><?php esc_html_e( 'Where we work', 'ctp' ); ?></h2>
							<ul class="pill-row">
								<?php foreach ( $ctp_areas as $ctp_area ) : ?>
									<li>
										<a class="pill" href="<?php echo esc_url( (string) get_permalink( $ctp_area ) ); ?>">
											<?php echo esc_html( get_the_title( $ctp_area ) ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
							<p class="u-mt-4 u-small u-mb-0">
								<a href="<?php echo esc_url( ctp_url( 'areas' ) ); ?>"><?php esc_html_e( 'See all service areas', 'ctp' ); ?></a>
							</p>
						</div>
					<?php endif; ?>

				</aside>

			</div>
		</div>
	</section>

	<?php
	ctp_cta_band(
		sprintf(
			/* translators: %s: service name. */
			__( 'Need %s?', 'ctp' ),
			strtolower( get_the_title() )
		)
	);

endwhile;

get_footer();
