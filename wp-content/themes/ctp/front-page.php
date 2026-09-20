<?php
/**
 * Front page.
 *
 * Composed from the content types rather than hard-coded, so adding a service
 * or an area in the admin updates the homepage with no template editing.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ctp_hero_image_id = (int) get_theme_mod( 'ctp_hero_image', 0 );
$ctp_hero_image    = $ctp_hero_image_id ? wp_get_attachment_image_url( $ctp_hero_image_id, 'full' ) : '';
$ctp_services      = ctp_get_services( 12 );
$ctp_areas         = ctp_get_areas( 12 );
$ctp_phone         = ctp_business( 'phone' );
?>

<section class="hero<?php echo $ctp_hero_image ? ' hero--image' : ''; ?>">
	<?php if ( $ctp_hero_image ) : ?>
		<img class="hero__bg" src="<?php echo esc_url( $ctp_hero_image ); ?>" alt="" fetchpriority="high" decoding="async" />
	<?php endif; ?>

	<div class="container">
		<div class="hero__inner">
			<?php if ( get_theme_mod( 'ctp_hero_eyebrow' ) ) : ?>
				<span class="hero__eyebrow">
					<?php ctp_icon( 'pin', 15 ); ?>
					<?php echo esc_html( get_theme_mod( 'ctp_hero_eyebrow' ) ); ?>
				</span>
			<?php endif; ?>

			<h1><?php echo esc_html( get_theme_mod( 'ctp_hero_title', __( 'Tuckpointing and masonry repair that holds up to Chicago winters', 'ctp' ) ) ); ?></h1>

			<p class="hero__text">
				<?php echo esc_html( get_theme_mod( 'ctp_hero_text', __( 'Family run out of Wood Dale, working within about an hour in every direction.', 'ctp' ) ) ); ?>
			</p>

			<div class="btn-row">
				<?php if ( $ctp_phone ) : ?>
					<a class="btn btn--primary btn--lg" href="tel:<?php echo esc_attr( ctp_tel( $ctp_phone ) ); ?>">
						<?php ctp_icon( 'phone', 18 ); ?>
						<?php echo esc_html( $ctp_phone ); ?>
					</a>
				<?php endif; ?>
				<a class="btn btn--ghost-light btn--lg" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
					<?php esc_html_e( 'Get a free estimate', 'ctp' ); ?>
				</a>
			</div>

			<?php ctp_trust_bar(); ?>
		</div>
	</div>
</section>

<?php if ( $ctp_services ) : ?>
	<section class="section">
		<div class="container">
			<div class="section__head">
				<span class="section__eyebrow"><?php ctp_icon( 'hammer', 15 ); ?><?php esc_html_e( 'What we do', 'ctp' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Masonry services', 'ctp' ); ?></h2>
				<p class="section__text">
					<?php esc_html_e( 'Most of what we do comes back to keeping water out of a wall. Here is where it usually gets in.', 'ctp' ); ?>
				</p>
			</div>

			<div class="card-grid card-grid--3">
				<?php foreach ( $ctp_services as $ctp_service ) : ?>
					<?php ctp_service_card( $ctp_service ); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
// The Home page's own editor content, used as the "why us" block.
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$ctp_home_content = trim( (string) get_the_content() );

		if ( $ctp_home_content ) :
			?>
			<section class="section section--alt">
				<div class="container">
					<div class="layout layout--sidebar">
						<div class="prose prose--wide">
							<?php the_content(); ?>
						</div>

						<aside class="sidebar">
							<div class="panel panel--brand">
								<h2 class="panel__title"><?php esc_html_e( 'What you can expect', 'ctp' ); ?></h2>
								<?php
								ctp_checklist(
									array(
										__( 'A written, itemized price that does not expire', 'ctp' ),
										__( 'Photos of every problem we find', 'ctp' ),
										__( 'Mortar matched to your brick, not to whatever is on the truck', 'ctp' ),
										__( 'Joints cut to proper depth, not skimmed over', 'ctp' ),
										__( 'Landscaping protected and the site swept daily', 'ctp' ),
										__( 'An honest no when the work does not need doing', 'ctp' ),
									)
								);
								?>
							</div>
						</aside>
					</div>
				</div>
			</section>
			<?php
		endif;
	endwhile;
endif;
?>

<section class="section">
	<div class="container">
		<div class="section__head section__head--center">
			<span class="section__eyebrow"><?php ctp_icon( 'check', 15 ); ?><?php esc_html_e( 'How it works', 'ctp' ); ?></span>
			<h2 class="section__title"><?php esc_html_e( 'Four steps, no surprises', 'ctp' ); ?></h2>
		</div>

		<?php
		ctp_process_steps(
			array(
				__( 'You call or send photos | Tell us what you are seeing. Photos of the wall, chimney or steps often tell us most of what we need before we come out.', 'ctp' ),
				__( 'We walk the property | A full exterior inspection, with photos of everything that is failing and an honest note on what can wait.', 'ctp' ),
				__( 'You get a written price | Itemized by elevation and by task, so you can see exactly what you are paying for. No pressure, no expiry date.', 'ctp' ),
				__( 'We do the work | Protected landscaping, proper mortar, correct depth, and the site swept at the end of every day.', 'ctp' ),
			)
		);
		?>
	</div>
</section>

<?php
$ctp_projects = get_posts(
	array(
		'post_type'      => 'ctp_project',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
	)
);

if ( $ctp_projects ) :
	?>
	<section class="section section--alt">
		<div class="container">
			<div class="section__head">
				<span class="section__eyebrow"><?php ctp_icon( 'brick', 15 ); ?><?php esc_html_e( 'Recent work', 'ctp' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Projects around Chicagoland', 'ctp' ); ?></h2>
			</div>

			<div class="card-grid card-grid--3">
				<?php foreach ( $ctp_projects as $ctp_project ) : ?>
					<?php ctp_project_card( $ctp_project ); ?>
				<?php endforeach; ?>
			</div>

			<p class="u-mt-6">
				<a class="btn btn--ghost" href="<?php echo esc_url( ctp_url( 'projects' ) ); ?>">
					<?php esc_html_e( 'See all projects', 'ctp' ); ?>
				</a>
			</p>
		</div>
	</section>
<?php endif; ?>

<?php if ( $ctp_areas ) : ?>
	<section class="section<?php echo $ctp_projects ? '' : ' section--alt'; ?>">
		<div class="container">
			<div class="layout layout--sidebar">
				<div>
					<span class="section__eyebrow"><?php ctp_icon( 'pin', 15 ); ?><?php esc_html_e( 'Where we work', 'ctp' ); ?></span>
					<h2 class="section__title"><?php esc_html_e( 'Serving about an hour in every direction from Wood Dale', 'ctp' ); ?></h2>
					<p class="section__text u-mb-0">
						<?php esc_html_e( 'That radius is deliberate. It is close enough that we can come back out if something needs another look, and close enough that our reputation travels between the towns we work in.', 'ctp' ); ?>
					</p>

					<ul class="pill-row u-mt-6">
						<?php foreach ( $ctp_areas as $ctp_area ) : ?>
							<li>
								<a class="pill" href="<?php echo esc_url( (string) get_permalink( $ctp_area ) ); ?>">
									<?php ctp_icon( 'pin', 13 ); ?>
									<?php echo esc_html( get_the_title( $ctp_area ) ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>

					<p class="u-mt-5">
						<a class="btn btn--ghost" href="<?php echo esc_url( ctp_url( 'areas' ) ); ?>">
							<?php esc_html_e( 'See every town we cover', 'ctp' ); ?>
						</a>
					</p>
				</div>

				<aside class="sidebar">
					<div class="panel panel--dark">
						<h2 class="panel__title"><?php esc_html_e( 'Not sure if you are in range?', 'ctp' ); ?></h2>
						<p class="panel__text"><?php esc_html_e( 'Call and ask. If you are just outside the radius we will usually still come look, and if we cannot we will tell you who can.', 'ctp' ); ?></p>
						<?php if ( $ctp_phone ) : ?>
							<p class="u-mt-5 u-mb-0">
								<a class="btn btn--primary btn--block" href="tel:<?php echo esc_attr( ctp_tel( $ctp_phone ) ); ?>">
									<?php ctp_icon( 'phone', 17 ); ?>
									<?php echo esc_html( $ctp_phone ); ?>
								</a>
							</p>
						<?php endif; ?>
					</div>
				</aside>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
$ctp_articles = get_posts(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
	)
);

if ( $ctp_articles ) :
	?>
	<section class="section section--alt">
		<div class="container">
			<div class="section__head">
				<span class="section__eyebrow"><?php ctp_icon( 'inspect', 15 ); ?><?php esc_html_e( 'Knowledge hub', 'ctp' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Straight answers, no sales pitch', 'ctp' ); ?></h2>
				<p class="section__text">
					<?php esc_html_e( 'If you read one of these and decide you do not need us yet, that is a good outcome.', 'ctp' ); ?>
				</p>
			</div>

			<div class="card-grid card-grid--3">
				<?php foreach ( $ctp_articles as $ctp_article ) : ?>
					<?php ctp_post_card( $ctp_article ); ?>
				<?php endforeach; ?>
			</div>

			<p class="u-mt-6">
				<a class="btn btn--ghost" href="<?php echo esc_url( ctp_url( 'hub' ) ); ?>">
					<?php esc_html_e( 'Read the knowledge hub', 'ctp' ); ?>
				</a>
			</p>
		</div>
	</section>
<?php endif; ?>

<?php
ctp_cta_band();

get_footer();
