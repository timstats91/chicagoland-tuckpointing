<?php
/**
 * Single knowledge hub article.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$ctp_id            = get_the_ID();
	$ctp_service_terms = get_the_terms( $ctp_id, 'ctp_service_link' );
	$ctp_related       = array();

	if ( $ctp_service_terms && ! is_wp_error( $ctp_service_terms ) ) {
		foreach ( $ctp_service_terms as $ctp_term ) {
			$ctp_service_post = get_page_by_path( $ctp_term->slug, OBJECT, 'ctp_service' );

			if ( $ctp_service_post ) {
				$ctp_related[] = $ctp_service_post;
			}
		}
	}
	?>

	<section class="page-hero">
		<div class="container">
			<?php ctp_breadcrumbs( 'light' ); ?>
			<h1><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="page-hero__text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
			<?php endif; ?>

			<ul class="page-hero__meta">
				<li><?php ctp_icon( 'clock', 16 ); ?><span><?php echo esc_html( ctp_reading_time( $ctp_id ) ); ?></span></li>
				<li>
					<?php ctp_icon( 'check', 16 ); ?>
					<span>
						<?php
						/* translators: %s: formatted date. */
						printf( esc_html__( 'Updated %s', 'ctp' ), esc_html( get_the_modified_date() ) );
						?>
					</span>
				</li>
			</ul>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="layout layout--sidebar">

				<article <?php post_class( 'u-flow' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<?php ctp_media( $ctp_id, 'ctp-wide', 'media--wide media--rounded' ); ?>
					<?php endif; ?>

					<div class="prose">
						<?php the_content(); ?>
					</div>

					<?php if ( $ctp_related ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title"><?php esc_html_e( 'Related services', 'ctp' ); ?></h2>
							<div class="card-grid card-grid--3">
								<?php foreach ( $ctp_related as $ctp_service ) : ?>
									<?php ctp_service_card( $ctp_service ); ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php
					$ctp_more = get_posts(
						array(
							'post_type'      => 'post',
							'posts_per_page' => 2,
							'post__not_in'   => array( $ctp_id ),
						)
					);
					?>
					<?php if ( $ctp_more ) : ?>
						<div class="u-mt-7">
							<h2 class="section__title"><?php esc_html_e( 'Keep reading', 'ctp' ); ?></h2>
							<div class="card-grid card-grid--2">
								<?php foreach ( $ctp_more as $ctp_other ) : ?>
									<?php ctp_post_card( $ctp_other ); ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</article>

				<aside class="sidebar sidebar--sticky">
					<div class="panel panel--dark">
						<h2 class="panel__title"><?php esc_html_e( 'Want a second opinion?', 'ctp' ); ?></h2>
						<p class="panel__text"><?php esc_html_e( 'Free written estimates, and an honest answer if the work does not need doing yet.', 'ctp' ); ?></p>
						<div class="u-mt-5 u-flow">
							<?php if ( ctp_business( 'phone' ) ) : ?>
								<a class="btn btn--primary btn--block" href="tel:<?php echo esc_attr( ctp_tel( ctp_business( 'phone' ) ) ); ?>">
									<?php ctp_icon( 'phone', 17 ); ?>
									<?php echo esc_html( ctp_business( 'phone' ) ); ?>
								</a>
							<?php endif; ?>
							<a class="btn btn--ghost-light btn--block" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
								<?php esc_html_e( 'Request an estimate', 'ctp' ); ?>
							</a>
						</div>
					</div>

					<div class="panel">
						<h2 class="panel__title"><?php esc_html_e( 'Services', 'ctp' ); ?></h2>
						<?php ctp_service_list(); ?>
					</div>
				</aside>

			</div>
		</div>
	</section>

	<?php
	ctp_cta_band();

endwhile;

get_footer();
