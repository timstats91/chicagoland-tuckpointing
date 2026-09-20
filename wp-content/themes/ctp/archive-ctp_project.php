<?php
/**
 * Projects archive.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="page-hero">
	<div class="container">
		<?php ctp_breadcrumbs( 'light' ); ?>
		<h1><?php esc_html_e( 'Recent Projects', 'ctp' ); ?></h1>
		<p class="page-hero__text">
			<?php esc_html_e( 'Real jobs, with before and after photos, what the problem actually was, and what it took to fix it.', 'ctp' ); ?>
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
					ctp_project_card( get_post() );
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

			<div class="layout layout--sidebar">
				<div class="prose">
					<h2><?php esc_html_e( 'Projects are on the way', 'ctp' ); ?></h2>
					<p>
						<?php esc_html_e( 'We are putting together a set of recent jobs with before and after photos. In the meantime, the services pages cover what each type of work involves, and we are happy to send examples of similar work when we come out to quote.', 'ctp' ); ?>
					</p>
					<?php if ( current_user_can( 'edit_posts' ) ) : ?>
						<p>
							<a class="btn btn--primary" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=ctp_project' ) ); ?>">
								<?php esc_html_e( 'Add the first project', 'ctp' ); ?>
							</a>
						</p>
					<?php endif; ?>
				</div>

				<aside class="sidebar">
					<div class="panel">
						<h2 class="panel__title"><?php esc_html_e( 'Browse services instead', 'ctp' ); ?></h2>
						<?php ctp_service_list(); ?>
					</div>
				</aside>
			</div>

		<?php endif; ?>
	</div>
</section>

<?php
ctp_cta_band();

get_footer();
