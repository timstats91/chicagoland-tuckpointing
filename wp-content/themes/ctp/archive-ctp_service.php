<?php
/**
 * Services archive.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="page-hero">
	<div class="container">
		<?php ctp_breadcrumbs( 'light' ); ?>
		<h1><?php esc_html_e( 'Masonry Services', 'ctp' ); ?></h1>
		<p class="page-hero__text">
			<?php esc_html_e( 'Nearly every masonry problem is a water problem. These are the places water gets into a wall, and what it takes to close them properly.', 'ctp' ); ?>
		</p>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="card-grid card-grid--3">
				<?php
				while ( have_posts() ) :
					the_post();
					ctp_service_card( get_post() );
				endwhile;
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'No services have been added yet. Run the starter content importer under Tools > Starter Content.', 'ctp' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="section section--alt">
	<div class="container">
		<div class="section__head section__head--center">
			<h2 class="section__title"><?php esc_html_e( 'Not sure which one you need?', 'ctp' ); ?></h2>
			<p class="section__text">
				<?php esc_html_e( 'Most people are not, and that is fine. Describe what you are seeing, or send a photo, and we will tell you what it is. If it does not need fixing yet, we will say so.', 'ctp' ); ?>
			</p>
		</div>

		<?php
		ctp_process_steps(
			array(
				__( 'Crumbling or sandy mortar | Tuckpointing, sometimes with brick replacement if water has already got in.', 'ctp' ),
				__( 'Rust stain above a window | Lintel replacement. It gets worse steadily and never better.', 'ctp' ),
				__( 'Water stain on a ceiling near the chimney | Chimney crown and flashing, usually before any rebuild.', 'ctp' ),
				__( 'Brick faces flaking off | Masonry repair, plus finding whatever is putting water into that wall.', 'ctp' ),
			)
		);
		?>
	</div>
</section>

<?php
ctp_cta_band();

get_footer();
