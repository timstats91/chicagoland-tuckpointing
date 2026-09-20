<?php
/**
 * Site header.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

$ctp_phone = ctp_business( 'phone' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#16242f" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'ctp' ); ?></a>

<header class="header">
	<div class="container header__inner">

		<?php if ( has_custom_logo() ) : ?>
			<div class="brand"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<span class="brand__mark"><?php ctp_icon( 'trowel', 21 ); ?></span>
				<span class="brand__text">
					<span class="brand__name"><?php echo esc_html( ctp_business( 'name', get_bloginfo( 'name' ) ) ); ?></span>
					<span class="brand__tag"><?php esc_html_e( 'Masonry Restoration', 'ctp' ); ?></span>
				</span>
			</a>
		<?php endif; ?>

		<nav class="nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'ctp' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
			} else {
				echo '<ul>';
				printf( '<li><a href="%s">%s</a></li>', esc_url( ctp_url( 'services' ) ), esc_html__( 'Services', 'ctp' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( ctp_url( 'areas' ) ), esc_html__( 'Service Areas', 'ctp' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( ctp_url( 'projects' ) ), esc_html__( 'Projects', 'ctp' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( ctp_url( 'contact' ) ), esc_html__( 'Contact', 'ctp' ) );
				echo '</ul>';
			}
			?>
		</nav>

		<div class="header__actions">
			<?php if ( $ctp_phone ) : ?>
				<a class="header__phone" href="tel:<?php echo esc_attr( ctp_tel( $ctp_phone ) ); ?>">
					<?php ctp_icon( 'phone', 17 ); ?>
					<span><?php echo esc_html( $ctp_phone ); ?></span>
				</a>
			<?php endif; ?>

			<a class="btn btn--primary" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
				<?php esc_html_e( 'Free estimate', 'ctp' ); ?>
			</a>

			<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
				<span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'ctp' ); ?></span>
				<?php ctp_icon( 'menu', 22 ); ?>
				<?php ctp_icon( 'close', 22 ); ?>
			</button>
		</div>

	</div>
</header>

<main id="main">
