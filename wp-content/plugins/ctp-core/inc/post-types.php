<?php
/**
 * Post types and taxonomies.
 *
 * Three content types: services, service areas, and projects. Two private
 * "linking" taxonomies tie projects and knowledge-hub articles back to the
 * service and area they belong to. The taxonomies are deliberately not public:
 * we do not want /service-link/tuckpointing/ archives competing with the real
 * /services/tuckpointing/ page in search results.
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the three content types.
 */
function ctp_register_post_types() {

	register_post_type(
		'ctp_service',
		array(
			'labels'        => array(
				'name'               => __( 'Services', 'ctp-core' ),
				'singular_name'      => __( 'Service', 'ctp-core' ),
				'add_new_item'       => __( 'Add New Service', 'ctp-core' ),
				'edit_item'          => __( 'Edit Service', 'ctp-core' ),
				'new_item'           => __( 'New Service', 'ctp-core' ),
				'view_item'          => __( 'View Service', 'ctp-core' ),
				'search_items'       => __( 'Search Services', 'ctp-core' ),
				'not_found'          => __( 'No services yet.', 'ctp-core' ),
				'menu_name'          => __( 'Services', 'ctp-core' ),
				'all_items'          => __( 'All Services', 'ctp-core' ),
				'featured_image'     => __( 'Service Photo', 'ctp-core' ),
				'set_featured_image' => __( 'Set service photo', 'ctp-core' ),
			),
			'public'        => true,
			'has_archive'   => 'services',
			'rewrite'       => array(
				'slug'       => 'services',
				'with_front' => false,
			),
			'menu_icon'     => 'dashicons-hammer',
			'menu_position' => 20,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions', 'custom-fields' ),
			'show_in_rest'  => true,
			'hierarchical'  => false,
		)
	);

	register_post_type(
		'ctp_area',
		array(
			'labels'        => array(
				'name'          => __( 'Service Areas', 'ctp-core' ),
				'singular_name' => __( 'Service Area', 'ctp-core' ),
				'add_new_item'  => __( 'Add New Service Area', 'ctp-core' ),
				'edit_item'     => __( 'Edit Service Area', 'ctp-core' ),
				'new_item'      => __( 'New Service Area', 'ctp-core' ),
				'view_item'     => __( 'View Service Area', 'ctp-core' ),
				'search_items'  => __( 'Search Service Areas', 'ctp-core' ),
				'not_found'     => __( 'No service areas yet.', 'ctp-core' ),
				'menu_name'     => __( 'Service Areas', 'ctp-core' ),
				'all_items'     => __( 'All Service Areas', 'ctp-core' ),
			),
			'public'        => true,
			'has_archive'   => 'service-areas',
			'rewrite'       => array(
				'slug'       => 'service-areas',
				'with_front' => false,
			),
			'menu_icon'     => 'dashicons-location-alt',
			'menu_position' => 21,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions', 'custom-fields' ),
			'show_in_rest'  => true,
			'hierarchical'  => false,
		)
	);

	register_post_type(
		'ctp_project',
		array(
			'labels'        => array(
				'name'               => __( 'Projects', 'ctp-core' ),
				'singular_name'      => __( 'Project', 'ctp-core' ),
				'add_new_item'       => __( 'Add New Project', 'ctp-core' ),
				'edit_item'          => __( 'Edit Project', 'ctp-core' ),
				'new_item'           => __( 'New Project', 'ctp-core' ),
				'view_item'          => __( 'View Project', 'ctp-core' ),
				'search_items'       => __( 'Search Projects', 'ctp-core' ),
				'not_found'          => __( 'No projects yet.', 'ctp-core' ),
				'menu_name'          => __( 'Projects', 'ctp-core' ),
				'all_items'          => __( 'All Projects', 'ctp-core' ),
				'featured_image'     => __( 'Main Photo', 'ctp-core' ),
				'set_featured_image' => __( 'Set main photo', 'ctp-core' ),
			),
			'public'        => true,
			'has_archive'   => 'projects',
			'rewrite'       => array(
				'slug'       => 'projects',
				'with_front' => false,
			),
			'menu_icon'     => 'dashicons-format-gallery',
			'menu_position' => 22,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			'show_in_rest'  => true,
			'hierarchical'  => false,
		)
	);
}
add_action( 'init', 'ctp_register_post_types', 5 );

/**
 * Register the two linking taxonomies.
 *
 * These are the glue: tag a project or an article with "Tuckpointing" and it
 * automatically appears on the Tuckpointing service page, because the service's
 * post slug and the term's slug are kept in sync.
 */
function ctp_register_taxonomies() {

	$shared = array( 'ctp_project', 'post' );

	register_taxonomy(
		'ctp_service_link',
		$shared,
		array(
			'labels'            => array(
				'name'          => __( 'Related Services', 'ctp-core' ),
				'singular_name' => __( 'Related Service', 'ctp-core' ),
				'menu_name'     => __( 'Related Services', 'ctp-core' ),
				'all_items'     => __( 'All Related Services', 'ctp-core' ),
			),
			'public'            => false,
			'publicly_queryable' => false,
			'show_ui'           => true,
			'show_in_menu'      => false,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => true,
			'rewrite'           => false,
		)
	);

	register_taxonomy(
		'ctp_area_link',
		$shared,
		array(
			'labels'            => array(
				'name'          => __( 'Related Areas', 'ctp-core' ),
				'singular_name' => __( 'Related Area', 'ctp-core' ),
				'menu_name'     => __( 'Related Areas', 'ctp-core' ),
				'all_items'     => __( 'All Related Areas', 'ctp-core' ),
			),
			'public'            => false,
			'publicly_queryable' => false,
			'show_ui'           => true,
			'show_in_menu'      => false,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => true,
			'rewrite'           => false,
		)
	);
}
add_action( 'init', 'ctp_register_taxonomies', 5 );

/**
 * Keep a matching term alongside every service and area, so the editor can tag
 * projects and articles without anyone having to maintain two lists by hand.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 */
function ctp_sync_link_term( $post_id, $post ) {
	if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
		return;
	}

	$map = array(
		'ctp_service' => 'ctp_service_link',
		'ctp_area'    => 'ctp_area_link',
	);

	if ( ! isset( $map[ $post->post_type ] ) ) {
		return;
	}

	$taxonomy = $map[ $post->post_type ];
	$slug     = $post->post_name;
	$title    = $post->post_title;

	if ( ! $slug || ! $title || 'publish' !== $post->post_status ) {
		return;
	}

	$term = get_term_by( 'slug', $slug, $taxonomy );

	if ( $term ) {
		if ( $term->name !== $title ) {
			wp_update_term( $term->term_id, $taxonomy, array( 'name' => $title ) );
		}
		return;
	}

	wp_insert_term( $title, $taxonomy, array( 'slug' => $slug ) );
}
add_action( 'save_post', 'ctp_sync_link_term', 10, 2 );

/**
 * Show every service and area on its archive rather than paginating at ten.
 *
 * @param WP_Query $query Main query.
 */
function ctp_archive_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_post_type_archive( 'ctp_service' ) || $query->is_post_type_archive( 'ctp_area' ) ) {
		$query->set( 'posts_per_page', 100 );
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
	}

	if ( $query->is_post_type_archive( 'ctp_project' ) ) {
		$query->set( 'posts_per_page', 12 );
	}
}
add_action( 'pre_get_posts', 'ctp_archive_query' );
