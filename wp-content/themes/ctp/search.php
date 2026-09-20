<?php
/**
 * Search results.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="page-hero">
	<div class="container">
		<?php ctp_breadcrumbs( 'light' ); ?>
		<h1>
			<?php
			/* translators: %s: search term. */
			printf( esc_html__( 'Results for &ldquo;%s&rdquo;', 'ctp' ), esc_html( get_search_query() ) );
			?>
		</h1>
		<p class="page-hero__text">
			<?php
			printf(
				/* translators: %d: number of results. */
				esc_html( _n( '%d match found.', '%d matches found.', (int) $GLOBALS['wp_query']->found_posts, 'ctp' ) ),
				(int) $GLOBALS['wp_query']->found_posts
			);
			?>
		</p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="layout layout--sidebar">

			<div>
				<?php if ( have_posts() ) : ?>
					<div class="post-list">
						<?php while ( have_posts() ) : the_post(); ?>
							<article class="post-list__item">
								<p class="post-meta">
									<span><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
								</p>
								<h2 class="post-list__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<p class="post-list__excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
							</article>
						<?php endwhile; ?>
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
						<h2><?php esc_html_e( 'Nothing matched', 'ctp' ); ?></h2>
						<p><?php esc_html_e( 'Try a different word, or browse the services below. If you are looking for something specific, calling is usually faster.', 'ctp' ); ?></p>
					</div>
				<?php endif; ?>

				<div class="u-mt-7 u-measure">
					<?php get_search_form(); ?>
				</div>
			</div>

			<aside class="sidebar sidebar--sticky">
				<div class="panel">
					<h2 class="panel__title"><?php esc_html_e( 'Services', 'ctp' ); ?></h2>
					<?php ctp_service_list(); ?>
				</div>
			</aside>

		</div>
	</div>
</section>

<?php
ctp_cta_band();

get_footer();
