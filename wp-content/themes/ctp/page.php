<?php
/**
 * Generic page.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<section class="page-hero">
		<div class="container">
			<?php ctp_breadcrumbs( 'light' ); ?>
			<h1><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="page-hero__text"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="layout layout--sidebar">

				<article <?php post_class( 'u-flow' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<?php ctp_media( get_the_ID(), 'ctp-wide', 'media--wide media--rounded' ); ?>
					<?php endif; ?>

					<div class="prose prose--wide">
						<?php the_content(); ?>
					</div>

					<?php
					wp_link_pages(
						array(
							'before' => '<nav class="pagination">',
							'after'  => '</nav>',
						)
					);
					?>
				</article>

				<aside class="sidebar sidebar--sticky">
					<div class="panel panel--dark">
						<h2 class="panel__title"><?php esc_html_e( 'Free written estimate', 'ctp' ); ?></h2>
						<p class="panel__text"><?php esc_html_e( 'No obligation, no expiring price, and an honest answer if the work can wait.', 'ctp' ); ?></p>
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
