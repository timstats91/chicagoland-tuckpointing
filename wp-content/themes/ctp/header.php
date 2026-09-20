<?php
/**
 * Site header.
 *
 * No phone number here by choice — the header carries one action, and a single
 * unambiguous CTA converts better than two competing ones. The number lives on
 * the contact page, in the footer, and in the sticky call bar on phones.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#16191b" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'ctp' ); ?></a>

<header class="header">
	<div class="container header__inner">

		<?php ctp_logo(); ?>

		<nav class="nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'ctp' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'depth'          => 2,
						'walker'         => new CTP_Nav_Walker(),
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
			<a class="btn btn--primary" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
				<?php esc_html_e( 'Free estimate', 'ctp' ); ?>
			</a>

			<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'ctp' ); ?></span>
				<?php ctp_icon( 'menu', 22, 'nav-toggle__open' ); ?>
				<?php ctp_icon( 'close', 22, 'nav-toggle__close' ); ?>
			</button>
		</div>

	</div>
</header>

<main id="main">
