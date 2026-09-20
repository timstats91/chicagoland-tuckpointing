<?php
/**
 * Site footer.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

$ctp_phone    = ctp_business( 'phone' );
$ctp_email    = ctp_business( 'email' );
$ctp_services = ctp_get_services( 8 );
$ctp_areas    = ctp_get_areas( 10 );
$ctp_socials  = array_filter(
	array(
		'Google'    => ctp_business( 'google' ),
		'Facebook'  => ctp_business( 'facebook' ),
		'Instagram' => ctp_business( 'instagram' ),
		'Yelp'      => ctp_business( 'yelp' ),
	)
);
?>
</main>

<footer class="footer">
	<div class="container">

		<div class="footer__top">

			<div class="footer__brand">
				<h2 class="footer__heading"><?php echo esc_html( ctp_business( 'name', get_bloginfo( 'name' ) ) ); ?></h2>
				<p><?php echo esc_html( ctp_business( 'tagline' ) ); ?></p>
				<?php if ( ctp_business( 'insured' ) ) : ?>
					<p class="u-small"><?php esc_html_e( 'Licensed and fully insured. Certificate available on request.', 'ctp' ); ?></p>
				<?php endif; ?>
				<?php if ( ctp_business( 'license' ) ) : ?>
					<p class="u-small">
						<?php
						/* translators: %s: license number. */
						printf( esc_html__( 'License #%s', 'ctp' ), esc_html( ctp_business( 'license' ) ) );
						?>
					</p>
				<?php endif; ?>
			</div>

			<?php if ( $ctp_services ) : ?>
				<div>
					<h2 class="footer__heading"><?php esc_html_e( 'Services', 'ctp' ); ?></h2>
					<ul>
						<?php foreach ( $ctp_services as $ctp_service ) : ?>
							<li>
								<a href="<?php echo esc_url( (string) get_permalink( $ctp_service ) ); ?>">
									<?php echo esc_html( get_the_title( $ctp_service ) ); ?>
								</a>
							</li>
						<?php endforeach; ?>
						<li><a href="<?php echo esc_url( ctp_url( 'services' ) ); ?>"><?php esc_html_e( 'All services', 'ctp' ); ?></a></li>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( $ctp_areas ) : ?>
				<div>
					<h2 class="footer__heading"><?php esc_html_e( 'Service Areas', 'ctp' ); ?></h2>
					<ul>
						<?php foreach ( $ctp_areas as $ctp_area ) : ?>
							<li>
								<a href="<?php echo esc_url( (string) get_permalink( $ctp_area ) ); ?>">
									<?php echo esc_html( get_the_title( $ctp_area ) ); ?>
								</a>
							</li>
						<?php endforeach; ?>
						<li><a href="<?php echo esc_url( ctp_url( 'areas' ) ); ?>"><?php esc_html_e( 'All service areas', 'ctp' ); ?></a></li>
					</ul>
				</div>
			<?php endif; ?>

			<div>
				<h2 class="footer__heading"><?php esc_html_e( 'Get in touch', 'ctp' ); ?></h2>
				<ul class="footer__contact">
					<?php if ( $ctp_phone ) : ?>
						<li>
							<?php ctp_icon( 'phone', 17 ); ?>
							<a class="footer__phone" href="tel:<?php echo esc_attr( ctp_tel( $ctp_phone ) ); ?>">
								<?php echo esc_html( $ctp_phone ); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ( $ctp_email ) : ?>
						<li>
							<?php ctp_icon( 'mail', 17 ); ?>
							<a href="<?php echo esc_url( 'mailto:' . $ctp_email ); ?>"><?php echo esc_html( antispambot( $ctp_email ) ); ?></a>
						</li>
					<?php endif; ?>

					<?php if ( ctp_address_line() ) : ?>
						<li>
							<?php ctp_icon( 'pin', 17 ); ?>
							<span><?php echo esc_html( ctp_address_line( true ) ); ?></span>
						</li>
					<?php endif; ?>
				</ul>

				<?php if ( ctp_hours_lines() ) : ?>
					<h2 class="footer__heading" style="margin-top:1.5rem"><?php esc_html_e( 'Hours', 'ctp' ); ?></h2>
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
				<?php endif; ?>
			</div>

			<?php if ( is_active_sidebar( 'footer-extra' ) ) : ?>
				<div><?php dynamic_sidebar( 'footer-extra' ); ?></div>
			<?php endif; ?>

		</div>

		<div class="footer__bottom">
			<p class="u-mb-0">
				<?php
				printf(
					'&copy; %1$s %2$s. %3$s',
					esc_html( (string) current_time( 'Y' ) ),
					esc_html( ctp_business( 'legal_name', ctp_business( 'name', get_bloginfo( 'name' ) ) ) ),
					esc_html__( 'All rights reserved.', 'ctp' )
				);
				?>
			</p>

			<?php if ( has_nav_menu( 'footer' ) || $ctp_socials ) : ?>
				<div class="footer__social">
					<?php
					if ( has_nav_menu( 'footer' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'depth'          => 1,
								'items_wrap'     => '<ul style="display:flex;gap:1rem;flex-wrap:wrap">%3$s</ul>',
								'fallback_cb'    => false,
							)
						);
					}

					foreach ( $ctp_socials as $ctp_label => $ctp_link ) {
						printf(
							'<a href="%s" rel="noopener nofollow" target="_blank">%s</a>',
							esc_url( $ctp_link ),
							esc_html( $ctp_label )
						);
					}
					?>
				</div>
			<?php endif; ?>
		</div>

	</div>
</footer>

<?php if ( get_theme_mod( 'ctp_sticky_bar', true ) && ( $ctp_phone || ctp_url( 'contact' ) ) ) : ?>
	<div class="call-bar">
		<?php if ( $ctp_phone ) : ?>
			<a class="btn btn--primary" href="tel:<?php echo esc_attr( ctp_tel( $ctp_phone ) ); ?>">
				<?php ctp_icon( 'phone', 17 ); ?>
				<?php esc_html_e( 'Call now', 'ctp' ); ?>
			</a>
		<?php endif; ?>
		<a class="btn btn--ghost" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
			<?php esc_html_e( 'Free estimate', 'ctp' ); ?>
		</a>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
