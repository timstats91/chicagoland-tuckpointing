<?php
/**
 * Service areas archive.
 *
 * Towns with their own page get a card. Everything else inside the radius is
 * listed by county underneath, which keeps the coverage honest without
 * creating dozens of near-identical pages.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ctp_radius   = ctp_business( 'radius_miles', '45' );
$ctp_coverage = ctp_coverage_list();

// Map town name to permalink so the coverage list links anything that has a page.
$ctp_linked = array();

foreach ( ctp_get_areas() as $ctp_area_post ) {
	$ctp_linked[ strtolower( get_the_title( $ctp_area_post ) ) ] = (string) get_permalink( $ctp_area_post );
}
?>

<section class="page-hero">
	<div class="container">
		<?php ctp_breadcrumbs( 'light' ); ?>
		<h1><?php esc_html_e( 'Service Areas', 'ctp' ); ?></h1>
		<p class="page-hero__text">
			<?php
			printf(
				/* translators: 1: home city, 2: radius in miles. */
				esc_html__( 'We work within about an hour of %1$s, which is roughly %2$s miles in every direction: all of DuPage, most of Cook, and into Kane, Lake, Will, McHenry and Kendall.', 'ctp' ),
				esc_html( ctp_business( 'city', 'Wood Dale' ) ),
				esc_html( $ctp_radius )
			);
			?>
		</p>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Towns we work in most', 'ctp' ); ?></h2>
				<p class="section__text"><?php esc_html_e( 'Each of these has its own page covering the local housing stock and what tends to fail on it.', 'ctp' ); ?></p>
			</div>

			<div class="card-grid card-grid--4">
				<?php
				while ( have_posts() ) :
					the_post();
					ctp_area_card( get_post() );
				endwhile;
				?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php if ( $ctp_coverage ) : ?>
	<section class="section section--alt">
		<div class="container">
			<div class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Full coverage area', 'ctp' ); ?></h2>
				<p class="section__text">
					<?php esc_html_e( 'If your town is on this list, we come to you. If it is just outside, call and ask anyway.', 'ctp' ); ?>
				</p>
			</div>

			<div class="area-columns">
				<?php foreach ( $ctp_coverage as $ctp_county => $ctp_towns ) : ?>
					<div class="area-columns__group">
						<h3 class="area-columns__heading"><?php echo esc_html( $ctp_county ); ?></h3>
						<ul class="area-columns__list">
							<?php foreach ( $ctp_towns as $ctp_town ) : ?>
								<?php $ctp_link = $ctp_linked[ strtolower( $ctp_town ) ] ?? ''; ?>
								<li>
									<?php if ( $ctp_link ) : ?>
										<a href="<?php echo esc_url( $ctp_link ); ?>"><?php echo esc_html( $ctp_town ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $ctp_town ); ?>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
ctp_cta_band( __( 'Are we in your area?', 'ctp' ), __( 'Call and ask. If we cannot get to you, we will usually know someone who can.', 'ctp' ) );

get_footer();
