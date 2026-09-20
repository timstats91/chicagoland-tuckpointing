<?php
/**
 * Navigation walker with accessible dropdowns.
 *
 * Follows the WAI-ARIA disclosure navigation pattern: the parent stays a real
 * link (so "Services" still goes to the services page), and a separate toggle
 * button next to it opens the submenu. That separation matters — a parent that
 * is only a toggle strands keyboard and touch users who wanted the page itself.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Adds a disclosure button to menu items that have children.
 */
class CTP_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * ID of the item currently being opened, so start_lvl can label the
	 * submenu it is about to emit. start_el for a parent always runs
	 * immediately before start_lvl for that parent's children.
	 *
	 * @var int
	 */
	private $parent_id = 0;

	/**
	 * Open a submenu, giving it the id the toggle button points at.
	 *
	 * @param string   $output Accumulated markup, by reference.
	 * @param int      $depth  Current depth.
	 * @param stdClass $args   Menu arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= sprintf(
			"\n%s<ul id=\"%s\" class=\"sub-menu\">\n",
			$indent,
			esc_attr( 'ctp-submenu-' . $this->parent_id )
		);
	}

	/**
	 * Render one menu item, appending a toggle button when it has children.
	 *
	 * @param string   $output            Accumulated markup, by reference.
	 * @param WP_Post  $data_object       Menu item.
	 * @param int      $depth             Current depth.
	 * @param stdClass $args              Menu arguments.
	 * @param int      $current_object_id Current object ID.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$this->parent_id = (int) $data_object->ID;

		parent::start_el( $output, $data_object, $depth, $args, $current_object_id );

		$classes = (array) $data_object->classes;

		if ( ! in_array( 'menu-item-has-children', $classes, true ) ) {
			return;
		}

		$output .= sprintf(
			'<button type="button" class="nav__toggle" aria-expanded="false" aria-controls="%1$s"><span class="screen-reader-text">%2$s</span>%3$s</button>',
			esc_attr( 'ctp-submenu-' . $data_object->ID ),
			/* translators: %s: parent menu item name. */
			esc_html( sprintf( __( 'Show %s submenu', 'ctp' ), wp_strip_all_tags( $data_object->title ) ) ),
			ctp_get_icon( 'chevron', 16, 'nav__chevron' )
		);
	}
}

/**
 * Mark the "Services" parent as current when viewing any single service, so the
 * active state does not disappear the moment someone opens a service page.
 *
 * @param string[] $classes Menu item classes.
 * @param WP_Post  $item    Menu item.
 * @return string[]
 */
function ctp_nav_current_parent( $classes, $item ) {
	if ( ! is_singular( array( 'ctp_service', 'ctp_area', 'ctp_project' ) ) ) {
		return $classes;
	}

	$map = array(
		'ctp_service' => ctp_url( 'services' ),
		'ctp_area'    => ctp_url( 'areas' ),
		'ctp_project' => ctp_url( 'projects' ),
	);

	$post_type = get_post_type();

	if ( isset( $map[ $post_type ] ) && untrailingslashit( $item->url ) === untrailingslashit( $map[ $post_type ] ) ) {
		$classes[] = 'current-menu-ancestor';
	}

	return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'ctp_nav_current_parent', 10, 2 );
