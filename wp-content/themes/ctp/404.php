<?php
/**
 * 404.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="page-hero">
	<div class="container">
		<?php ctp_breadcrumbs( 'light' ); ?>
		<h1><?php esc_html_e( 'That page is not here', 'ctp' ); ?></h1>
		<p class="page-hero__text">
			<?php esc_html_e( 'The link may be out of date, or the page may have moved. Here is where most people are heading.', 'ctp' ); ?>
		</p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section__head">
			<h2 class="section__title"><?php esc_html_e( 'Services', 'ctp' ); ?></h2>
		</div>

		<?php $ctp_services = ctp_get_services( 6 ); ?>
		<?php if ( $ctp_services ) : ?>
			<div class="card-grid card-grid--3">
				<?php foreach ( $ctp_services as $ctp_service ) : ?>
					<?php ctp_service_card( $ctp_service ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="u-mt-7 u-measure">
			<h2 class="section__title"><?php esc_html_e( 'Or search the site', 'ctp' ); ?></h2>
			<?php get_search_form(); ?>
		</div>
	</div>
</section>

<?php
ctp_cta_band();

get_footer();
