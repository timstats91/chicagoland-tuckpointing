<?php
/**
 * Starter content importer.
 *
 * Tools > Starter Content runs this once and fills the site with real services,
 * service-area pages, articles and the core pages, wired together with menus.
 * It is idempotent: anything whose slug already exists is skipped, so running
 * it twice does nothing and never overwrites edits.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Full coverage list, grouped by county.
 *
 * @return array<string,string[]>
 */
function ctp_coverage_list() {
	static $list = null;

	if ( null === $list ) {
		$file = CTP_CORE_DIR . 'data/coverage.php';
		$list = file_exists( $file ) ? (array) require $file : array();
	}

	return $list;
}

/**
 * Convert the seed markup convention into Gutenberg block markup.
 *
 * Supports: blank-line separated paragraphs, "## " headings, "- " lists and
 * inline **bold**. Anything else is treated as paragraph text.
 *
 * @param string $text Source text.
 * @return string Block markup.
 */
function ctp_seed_to_blocks( $text ) {
	$chunks = preg_split( '/\n\s*\n/', trim( (string) $text ) );
	$out    = array();

	foreach ( (array) $chunks as $chunk ) {
		$chunk = trim( $chunk );

		if ( '' === $chunk ) {
			continue;
		}

		// Heading.
		if ( 0 === strpos( $chunk, '## ' ) ) {
			$heading = ctp_seed_inline( substr( $chunk, 3 ) );
			$out[]   = "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">" . $heading . "</h2>\n<!-- /wp:heading -->";
			continue;
		}

		// Unordered list: every line starts with "- ".
		$lines   = preg_split( '/\n/', $chunk );
		$is_list = true;

		foreach ( $lines as $line ) {
			if ( 0 !== strpos( trim( $line ), '- ' ) ) {
				$is_list = false;
				break;
			}
		}

		if ( $is_list ) {
			$items = '';

			foreach ( $lines as $line ) {
				$item   = ctp_seed_inline( substr( trim( $line ), 2 ) );
				$items .= "<!-- wp:list-item -->\n<li>" . $item . "</li>\n<!-- /wp:list-item -->\n";
			}

			$out[] = "<!-- wp:list -->\n<ul class=\"wp-block-list\">\n" . $items . "</ul>\n<!-- /wp:list -->";
			continue;
		}

		// Ordered list: every line starts with "1. ", "2. " and so on.
		$is_ordered = true;

		foreach ( $lines as $line ) {
			if ( ! preg_match( '/^\d+\.\s+/', trim( $line ) ) ) {
				$is_ordered = false;
				break;
			}
		}

		if ( $is_ordered ) {
			$items = '';

			foreach ( $lines as $line ) {
				$item   = ctp_seed_inline( preg_replace( '/^\d+\.\s+/', '', trim( $line ) ) );
				$items .= "<!-- wp:list-item -->\n<li>" . $item . "</li>\n<!-- /wp:list-item -->\n";
			}

			$out[] = "<!-- wp:list {\"ordered\":true} -->\n<ol class=\"wp-block-list\">\n" . $items . "</ol>\n<!-- /wp:list -->";
			continue;
		}

		$paragraph = ctp_seed_inline( str_replace( "\n", ' ', $chunk ) );
		$out[]     = "<!-- wp:paragraph -->\n<p>" . $paragraph . "</p>\n<!-- /wp:paragraph -->";
	}

	return implode( "\n\n", $out );
}

/**
 * Inline formatting: **bold** only, everything else escaped.
 *
 * @param string $text Source text.
 * @return string
 */
function ctp_seed_inline( $text ) {
	$text = wp_kses_post( trim( (string) $text ) );

	return (string) preg_replace( '/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text );
}

/**
 * Load one of the data files.
 *
 * @param string $name File name without extension.
 * @return array<int,array<string,mixed>>
 */
function ctp_seed_data( $name ) {
	$file = CTP_CORE_DIR . 'data/' . $name . '.php';

	return file_exists( $file ) ? (array) require $file : array();
}

/**
 * Create a post unless its slug already exists.
 *
 * @param array<string,mixed> $args      wp_insert_post arguments.
 * @param string              $post_type Post type.
 * @return int|null Post ID on creation, null when skipped or failed.
 */
function ctp_seed_insert( array $args, $post_type ) {
	$existing = get_page_by_path( $args['post_name'], OBJECT, $post_type );

	if ( $existing ) {
		return null;
	}

	$post_id = wp_insert_post(
		wp_parse_args(
			$args,
			array(
				'post_type'   => $post_type,
				'post_status' => 'publish',
			)
		),
		true
	);

	return is_wp_error( $post_id ) ? null : (int) $post_id;
}

/**
 * Run the import.
 *
 * @return array<string,int> Counts by content type.
 */
function ctp_run_seed() {
	$counts = array(
		'services' => 0,
		'areas'    => 0,
		'articles' => 0,
		'pages'    => 0,
	);

	// --- Services -------------------------------------------------------
	$order = 0;

	foreach ( ctp_seed_data( 'services' ) as $service ) {
		$order += 10;

		$post_id = ctp_seed_insert(
			array(
				'post_name'    => $service['slug'],
				'post_title'   => $service['title'],
				'post_excerpt' => $service['excerpt'],
				'post_content' => ctp_seed_to_blocks( $service['content'] ),
				'menu_order'   => $order,
			),
			'ctp_service'
		);

		if ( ! $post_id ) {
			continue;
		}

		$meta = isset( $service['meta'] ) ? (array) $service['meta'] : array();

		if ( ! empty( $service['icon'] ) ) {
			$meta['icon'] = $service['icon'];
		}

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post_id, '_ctp_' . $key, $value );
		}

		wp_set_object_terms( $post_id, array(), 'ctp_service_link' );
		$counts['services']++;
	}

	// --- Service areas --------------------------------------------------
	$order = 0;

	foreach ( ctp_seed_data( 'areas' ) as $area ) {
		$order += 10;

		$post_id = ctp_seed_insert(
			array(
				'post_name'    => $area['slug'],
				'post_title'   => $area['title'],
				'post_excerpt' => $area['excerpt'],
				'post_content' => ctp_seed_to_blocks( $area['content'] ),
				'menu_order'   => $order,
			),
			'ctp_area'
		);

		if ( ! $post_id ) {
			continue;
		}

		foreach ( (array) ( $area['meta'] ?? array() ) as $key => $value ) {
			update_post_meta( $post_id, '_ctp_' . $key, $value );
		}

		$counts['areas']++;
	}

	// --- Knowledge hub articles ----------------------------------------
	foreach ( ctp_seed_data( 'articles' ) as $article ) {
		$post_id = ctp_seed_insert(
			array(
				'post_name'    => $article['slug'],
				'post_title'   => $article['title'],
				'post_excerpt' => $article['excerpt'],
				'post_content' => ctp_seed_to_blocks( $article['content'] ),
			),
			'post'
		);

		if ( ! $post_id ) {
			continue;
		}

		if ( ! empty( $article['services'] ) ) {
			wp_set_object_terms( $post_id, (array) $article['services'], 'ctp_service_link' );
		}

		if ( ! empty( $article['areas'] ) ) {
			wp_set_object_terms( $post_id, (array) $article['areas'], 'ctp_area_link' );
		}

		$counts['articles']++;
	}

	// --- Pages ----------------------------------------------------------
	$page_ids = array();

	foreach ( ctp_seed_data( 'pages' ) as $page ) {
		$existing = get_page_by_path( $page['slug'], OBJECT, 'page' );

		if ( $existing ) {
			$page_ids[ $page['slug'] ] = (int) $existing->ID;
			continue;
		}

		$post_id = ctp_seed_insert(
			array(
				'post_name'    => $page['slug'],
				'post_title'   => $page['title'],
				'post_content' => ctp_seed_to_blocks( $page['content'] ),
			),
			'page'
		);

		if ( ! $post_id ) {
			continue;
		}

		$page_ids[ $page['slug'] ] = $post_id;

		if ( ! empty( $page['template'] ) ) {
			update_post_meta( $post_id, '_wp_page_template', $page['template'] );
		}

		if ( ! empty( $page['noindex'] ) ) {
			update_post_meta( $post_id, '_ctp_noindex', '1' );
		}

		$counts['pages']++;
	}

	// --- Reading settings ------------------------------------------------
	if ( isset( $page_ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_ids['home'] );
	}

	if ( isset( $page_ids['knowledge-hub'] ) ) {
		update_option( 'page_for_posts', $page_ids['knowledge-hub'] );
	}

	// Pretty permalinks; tuckpointing-in-elmhurst beats ?p=417.
	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	ctp_seed_menus( $page_ids );

	flush_rewrite_rules();

	return $counts;
}

/**
 * Build the primary and footer menus, unless they already exist.
 *
 * @param array<string,int> $page_ids Slug to page ID map.
 */
function ctp_seed_menus( array $page_ids ) {

	$menus = array(
		'primary' => array(
			'name'  => __( 'Primary Menu', 'ctp-core' ),
			'items' => array(
				array( 'title' => __( 'Services', 'ctp-core' ), 'url' => ctp_url( 'services' ) ),
				array( 'title' => __( 'Service Areas', 'ctp-core' ), 'url' => ctp_url( 'areas' ) ),
				array( 'title' => __( 'Projects', 'ctp-core' ), 'url' => ctp_url( 'projects' ) ),
				array( 'title' => __( 'Knowledge Hub', 'ctp-core' ), 'page' => 'knowledge-hub' ),
				array( 'title' => __( 'About', 'ctp-core' ), 'page' => 'about' ),
				array( 'title' => __( 'Contact', 'ctp-core' ), 'page' => 'contact' ),
			),
		),
		'footer'  => array(
			'name'  => __( 'Footer Menu', 'ctp-core' ),
			'items' => array(
				array( 'title' => __( 'About', 'ctp-core' ), 'page' => 'about' ),
				array( 'title' => __( 'Knowledge Hub', 'ctp-core' ), 'page' => 'knowledge-hub' ),
				array( 'title' => __( 'Projects', 'ctp-core' ), 'url' => ctp_url( 'projects' ) ),
				array( 'title' => __( 'Contact', 'ctp-core' ), 'page' => 'contact' ),
			),
		),
	);

	$locations = get_theme_mod( 'nav_menu_locations', array() );

	foreach ( $menus as $location => $config ) {
		$menu = wp_get_nav_menu_object( $config['name'] );

		if ( ! $menu ) {
			$menu_id = wp_create_nav_menu( $config['name'] );

			if ( is_wp_error( $menu_id ) ) {
				continue;
			}

			foreach ( $config['items'] as $item ) {
				if ( isset( $item['page'] ) ) {
					if ( ! isset( $page_ids[ $item['page'] ] ) ) {
						continue;
					}

					wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-title'     => $item['title'],
							'menu-item-object'    => 'page',
							'menu-item-object-id' => $page_ids[ $item['page'] ],
							'menu-item-type'      => 'post_type',
							'menu-item-status'    => 'publish',
						)
					);
					continue;
				}

				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => $item['title'],
						'menu-item-url'    => $item['url'],
						'menu-item-type'   => 'custom',
						'menu-item-status' => 'publish',
					)
				);
			}
		} else {
			$menu_id = (int) $menu->term_id;
		}

		$locations[ $location ] = $menu_id;
	}

	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Tools > Starter Content.
 */
function ctp_seed_menu_page() {
	add_management_page(
		__( 'Starter Content', 'ctp-core' ),
		__( 'Starter Content', 'ctp-core' ),
		'manage_options',
		'ctp-starter-content',
		'ctp_seed_page'
	);
}
add_action( 'admin_menu', 'ctp_seed_menu_page' );

/**
 * Render and handle the importer screen.
 */
function ctp_seed_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$result = null;

	if ( isset( $_POST['ctp_seed_run'] ) ) {
		check_admin_referer( 'ctp_seed' );
		$result = ctp_run_seed();
	}

	$counts = array(
		'services' => wp_count_posts( 'ctp_service' )->publish ?? 0,
		'areas'    => wp_count_posts( 'ctp_area' )->publish ?? 0,
		'projects' => wp_count_posts( 'ctp_project' )->publish ?? 0,
		'articles' => wp_count_posts( 'post' )->publish ?? 0,
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Starter Content', 'ctp-core' ); ?></h1>

		<?php if ( $result ) : ?>
			<div class="notice notice-success">
				<p>
					<?php
					printf(
						/* translators: %1$d services, %2$d areas, %3$d articles, %4$d pages. */
						esc_html__( 'Imported %1$d services, %2$d service areas, %3$d articles and %4$d pages. Anything that already existed was left alone.', 'ctp-core' ),
						(int) $result['services'],
						(int) $result['areas'],
						(int) $result['articles'],
						(int) $result['pages']
					);
					?>
				</p>
			</div>
		<?php endif; ?>

		<p style="max-width:60em">
			<?php esc_html_e( 'This fills the site with a complete set of starting content: ten service pages, twenty-one service area pages, six knowledge hub articles, and the home, about, contact and knowledge hub pages. It also sets the front page, the posts page, pretty permalinks and the navigation menus.', 'ctp-core' ); ?>
		</p>
		<p style="max-width:60em">
			<strong><?php esc_html_e( 'Safe to run more than once.', 'ctp-core' ); ?></strong>
			<?php esc_html_e( 'Anything whose slug already exists is skipped, so your edits are never overwritten.', 'ctp-core' ); ?>
		</p>

		<h2><?php esc_html_e( 'Currently published', 'ctp-core' ); ?></h2>
		<ul class="ul-disc">
			<li><?php printf( esc_html__( 'Services: %d', 'ctp-core' ), (int) $counts['services'] ); ?></li>
			<li><?php printf( esc_html__( 'Service areas: %d', 'ctp-core' ), (int) $counts['areas'] ); ?></li>
			<li><?php printf( esc_html__( 'Projects: %d', 'ctp-core' ), (int) $counts['projects'] ); ?></li>
			<li><?php printf( esc_html__( 'Knowledge hub articles: %d', 'ctp-core' ), (int) $counts['articles'] ); ?></li>
		</ul>

		<form method="post">
			<?php wp_nonce_field( 'ctp_seed' ); ?>
			<p>
				<button type="submit" name="ctp_seed_run" value="1" class="button button-primary button-hero">
					<?php esc_html_e( 'Import starter content', 'ctp-core' ); ?>
				</button>
			</p>
		</form>

		<h2><?php esc_html_e( 'After importing', 'ctp-core' ); ?></h2>
		<ol>
			<li><?php esc_html_e( 'Go to Settings > Business Info and put in the real phone number, email and hours.', 'ctp-core' ); ?></li>
			<li><?php esc_html_e( 'Read through the service pages. The copy is a solid starting point but it should sound like your dad, not like a template.', 'ctp-core' ); ?></li>
			<li><?php esc_html_e( 'Add photos as you get them. Every service and project supports a featured image, and projects support before and after shots.', 'ctp-core' ); ?></li>
			<li><?php esc_html_e( 'Claim the Google Business Profile and paste the URL into Business Info.', 'ctp-core' ); ?></li>
		</ol>
	</div>
	<?php
}
