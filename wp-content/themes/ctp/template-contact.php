<?php
/**
 * Template Name: Contact
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ctp_phone = ctp_business( 'phone' );
$ctp_alt   = ctp_business( 'phone_alt' );
$ctp_email = ctp_business( 'email' );

while ( have_posts() ) :
	the_post();
	?>

	<section class="page-hero">
		<div class="container">
			<?php ctp_breadcrumbs( 'light' ); ?>
			<h1><?php esc_html_e( 'Get a free estimate', 'ctp' ); ?></h1>
			<p class="page-hero__text">
				<?php esc_html_e( 'Tell us what you are seeing. We will come out, take photos, and give you a written price with no obligation and no expiry date.', 'ctp' ); ?>
			</p>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="layout layout--sidebar-left">

				<aside class="sidebar">

					<div class="panel panel--brand">
						<h2 class="panel__title"><?php esc_html_e( 'Call us', 'ctp' ); ?></h2>
						<?php if ( $ctp_phone ) : ?>
							<p>
								<a class="phone-display" href="tel:<?php echo esc_attr( ctp_tel( $ctp_phone ) ); ?>">
									<?php echo esc_html( $ctp_phone ); ?>
								</a>
							</p>
						<?php endif; ?>
						<?php if ( $ctp_alt ) : ?>
							<p class="u-small">
								<a href="tel:<?php echo esc_attr( ctp_tel( $ctp_alt ) ); ?>"><?php echo esc_html( $ctp_alt ); ?></a>
							</p>
						<?php endif; ?>
						<?php if ( $ctp_email ) : ?>
							<p class="u-small u-mb-0">
								<a href="<?php echo esc_url( 'mailto:' . $ctp_email ); ?>"><?php echo esc_html( antispambot( $ctp_email ) ); ?></a>
							</p>
						<?php endif; ?>
					</div>

					<?php if ( ctp_hours_lines() ) : ?>
						<div class="panel">
							<h2 class="panel__title"><?php esc_html_e( 'Hours', 'ctp' ); ?></h2>
							<ul class="ctp-hours">
								<?php foreach ( ctp_hours_lines() as $ctp_line ) : ?>
									<?php $ctp_parts = array_map( 'trim', explode( ':', $ctp_line, 2 ) ); ?>
									<li>
										<span><?php echo esc_html( $ctp_parts[0] ); ?></span>
										<?php if ( isset( $ctp_parts[1] ) ) : ?>
											<span><?php echo esc_html( $ctp_parts[1] ); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<div class="panel">
						<h2 class="panel__title"><?php esc_html_e( 'Where we are', 'ctp' ); ?></h2>
						<p class="panel__text">
							<?php echo esc_html( ctp_address_line( true ) ); ?>
						</p>
						<p class="panel__text u-mb-0">
							<?php
							printf(
								/* translators: %s: radius in miles. */
								esc_html__( 'We serve about %s miles in every direction, which is roughly an hour of driving.', 'ctp' ),
								esc_html( ctp_business( 'radius_miles', '45' ) )
							);
							?>
						</p>
						<p class="u-mt-4 u-small u-mb-0">
							<a href="<?php echo esc_url( ctp_url( 'areas' ) ); ?>"><?php esc_html_e( 'See all service areas', 'ctp' ); ?></a>
						</p>
					</div>

					<div class="panel">
						<h2 class="panel__title"><?php esc_html_e( 'What helps us most', 'ctp' ); ?></h2>
						<?php
						ctp_checklist(
							array(
								__( 'Photos of the wall, chimney or steps', 'ctp' ),
								__( 'Roughly when the house was built', 'ctp' ),
								__( 'Whether it has been repointed before', 'ctp' ),
								__( 'Whether you are seeing water inside', 'ctp' ),
							)
						);
						?>
					</div>

				</aside>

				<div class="u-flow">
					<?php if ( trim( (string) get_the_content() ) ) : ?>
						<div class="prose">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>

					<div class="panel u-mt-6">
						<?php ctp_contact_form(); ?>
					</div>
				</div>

			</div>
		</div>
	</section>

	<?php
endwhile;

get_footer();
