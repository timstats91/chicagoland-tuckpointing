<?php
/**
 * Single service area.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$ctp_id       = get_the_ID();
	$ctp_slug     = (string) get_post_field( 'post_name', $ctp_id );
	$ctp_town     = get_the_title();
	$ctp_county   = (string) ctp_meta( 'county', $ctp_id, '' );
	$ctp_drive    = (string) ctp_meta( 'drive_time', $ctp_id, '' );
	$ctp_zips     = (string) ctp_meta( 'zips', $ctp_id, '' );
	$ctp_hoods    = ctp_meta_lines( 'neighborhoods', $ctp_id );
	$ctp_housing  = ctp_meta_lines( 'housing', $ctp_id );
	$ctp_faqs     = ctp_meta_faq( 'faq', $ctp_id );
	$ctp_services = ctp_get_services( 12 );
	$ctp_phone    = ctp_business( 'phone' );
	$ctp_projects = ctp_linked_posts( 'ctp_area_link', $ctp_slug, array( 'ctp_project' ), 3 );
	?>

	<section class="page-hero">
		<div class="container">
			<?php ctp_breadcrumbs( 'light' ); ?>

			<h1>
				<?php
				/* translators: %s: town name. */
				printf( esc_html__( 'Tuckpointing & Masonry Repair in %s', 'ctp' ), esc_html( $ctp_town ) );
				?>
			</h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="page-hero__text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
			<?php endif; ?>

			<ul class="page-hero__meta">
				<?php if ( $ctp_county ) : ?>
					<li><?php ctp_icon( 'pin', 16 ); ?><span><?php echo esc_html( $ctp_county ); ?></span></li>
				<?php endif; ?>
				<?php if ( $ctp_drive ) : ?>
					<li><?php ctp_icon( 'clock', 16 ); ?><span><?php echo esc_html( $ctp_drive ); ?></span></li>
				<?php endif; ?>
				<?php if ( $ctp_zips ) : ?>
					<li><?php ctp_icon( 'check', 16 ); ?><span><?php echo esc_html( $ctp_zips ); ?></span></li>
				<?php endif; ?>
			</ul>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="layout layout--sidebar">

				<article <?php post_class( 'u-flow' ); ?>>

					<div class="prose prose--wide">
						<?php the_content(); ?>
					</div>

					<?php if ( $ctp_housing ) : ?>
						<div class="panel u-mt-7">
							<h2 class="panel__title">
								<?php
								/* translators: %s: town name. */
								printf( esc_html__( 'What we typically see in %s', 'ctp' ), esc_html( $ctp_town ) );
								?>
							</h2>
							<?php ctp_checklist( $ctp_housing ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_services ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title">
								<?php
								/* translators: %s: town name. */
								printf( esc_html__( 'Services we offer in %s', 'ctp' ), esc_html( $ctp_town ) );
								?>
							</h2>
							<div class="card-grid card-grid--3">
								<?php foreach ( $ctp_services as $ctp_service ) : ?>
									<?php ctp_service_card( $ctp_service ); ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_hoods ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title"><?php esc_html_e( 'Neighborhoods we cover', 'ctp' ); ?></h2>
							<ul class="pill-row">
								<?php foreach ( $ctp_hoods as $ctp_hood ) : ?>
									<li class="pill"><?php echo esc_html( $ctp_hood ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( $ctp_projects ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title">
								<?php
								/* translators: %s: town name. */
								printf( esc_html__( 'Work we have done in %s', 'ctp' ), esc_html( $ctp_town ) );
								?>
							</h2>
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

				</article>

				<aside class="sidebar sidebar--sticky">

					<div class="panel panel--dark">
						<h2 class="panel__title">
							<?php
							/* translators: %s: town name. */
							printf( esc_html__( 'Serving %s', 'ctp' ), esc_html( $ctp_town ) );
							?>
						</h2>
						<p class="panel__text"><?php esc_html_e( 'Free written estimates, usually within a few days. Send photos if you have them.', 'ctp' ); ?></p>
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

					<?php
					$ctp_nearby = get_posts(
						array(
							'post_type'      => 'ctp_area',
							'posts_per_page' => 8,
							'post__not_in'   => array( $ctp_id ),
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
						)
					);
					?>
					<?php if ( $ctp_nearby ) : ?>
						<div class="panel">
							<h2 class="panel__title"><?php esc_html_e( 'Nearby towns', 'ctp' ); ?></h2>
							<ul class="pill-row">
								<?php foreach ( $ctp_nearby as $ctp_other ) : ?>
									<li>
										<a class="pill" href="<?php echo esc_url( (string) get_permalink( $ctp_other ) ); ?>">
											<?php echo esc_html( get_the_title( $ctp_other ) ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
							<p class="u-mt-4 u-small u-mb-0">
								<a href="<?php echo esc_url( ctp_url( 'areas' ) ); ?>"><?php esc_html_e( 'All service areas', 'ctp' ); ?></a>
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
			/* translators: %s: town name. */
			__( 'Masonry work in %s?', 'ctp' ),
			$ctp_town
		)
	);

endwhile;

get_footer();
