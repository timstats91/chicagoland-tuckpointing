<?php
/**
 * Knowledge hub index and the generic fallback template.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ctp_hub_id   = (int) get_option( 'page_for_posts' );
$ctp_hub_text = $ctp_hub_id ? wp_strip_all_tags( (string) get_post_field( 'post_excerpt', $ctp_hub_id ) ) : '';

if ( ! $ctp_hub_text ) {
	$ctp_hub_text = __( 'Straight answers about masonry in the Chicago area: what fails, why it fails here, what repairs cost, and how to tell good work from work that will not last.', 'ctp' );
}
?>

<section class="page-hero">
	<div class="container">
		<?php ctp_breadcrumbs( 'light' ); ?>
		<h1>
			<?php
			if ( is_home() && $ctp_hub_id ) {
				echo esc_html( get_the_title( $ctp_hub_id ) );
			} elseif ( is_archive() ) {
				echo esc_html( wp_strip_all_tags( get_the_archive_title() ) );
			} else {
				esc_html_e( 'Knowledge Hub', 'ctp' );
			}
			?>
		</h1>
		<p class="page-hero__text"><?php echo esc_html( $ctp_hub_text ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="layout layout--sidebar">

			<div>
				<?php if ( have_posts() ) : ?>

					<div class="card-grid card-grid--2">
						<?php
						while ( have_posts() ) :
							the_post();
							ctp_post_card( get_post() );
						endwhile;
						?>
					</div>

					<?php
					the_posts_pagination(
						array(
							'class'     => 'pagination',
							'mid_size'  => 2,
							'prev_text' => __( 'Previous', 'ctp' ),
							'next_text' => __( 'Next', 'ctp' ),
						)
					);
					?>

				<?php else : ?>
					<div class="prose">
						<h2><?php esc_html_e( 'Nothing here yet', 'ctp' ); ?></h2>
						<p><?php esc_html_e( 'Articles are on the way. In the meantime the service pages cover most of the common questions.', 'ctp' ); ?></p>
					</div>
				<?php endif; ?>
			</div>

			<aside class="sidebar sidebar--sticky">
				<div class="panel">
					<h2 class="panel__title"><?php esc_html_e( 'Services', 'ctp' ); ?></h2>
					<?php ctp_service_list(); ?>
				</div>

				<div class="panel panel--dark">
					<h2 class="panel__title"><?php esc_html_e( 'Rather just ask someone?', 'ctp' ); ?></h2>
					<p class="panel__text"><?php esc_html_e( 'Call and describe what you are seeing. No charge for an opinion.', 'ctp' ); ?></p>
					<?php if ( ctp_business( 'phone' ) ) : ?>
						<p class="u-mt-5 u-mb-0">
							<a class="btn btn--primary btn--block" href="tel:<?php echo esc_attr( ctp_tel( ctp_business( 'phone' ) ) ); ?>">
								<?php ctp_icon( 'phone', 17 ); ?>
								<?php echo esc_html( ctp_business( 'phone' ) ); ?>
							</a>
						</p>
					<?php endif; ?>
				</div>
			</aside>

		</div>
	</div>
</section>

<?php
ctp_cta_band();

get_footer();
