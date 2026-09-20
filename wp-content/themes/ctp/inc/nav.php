<?php
/**
 * Navigation walker: accessible dropdowns and mega panels.
 *
 * Two menu items get a mega panel instead of a plain dropdown — the ones
 * pointing at the Services and Service Areas archives. They are matched on URL
 * rather than on a hard-coded title, so renaming "Service Areas" to "Areas" in
 * the admin does not break anything.
 *
 * Everything follows the WAI-ARIA disclosure pattern: the parent stays a real
 * link to its landing page, and a separate toggle button owns the panel. A
 * parent that is only a toggle strands anyone who wanted the landing page.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

/**
 * Adds disclosure buttons and mega panels to the primary menu.
 */
class CTP_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * ID of the item currently being opened, so start_lvl can label the
	 * submenu it is about to emit.
	 *
	 * @var int
	 */
	private $parent_id = 0;

	/**
	 * Menu children captured from a mega item before they were removed from
	 * the walk, so the panel can render them itself.
	 *
	 * @var array<int,WP_Post>
	 */
	private $mega_children = array();

	/**
	 * Which mega panel, if any, a top-level item should render.
	 *
	 * @param WP_Post $item Menu item.
	 * @return string 'services', 'areas', or an empty string.
	 */
	private function mega_type( $item ) {
		if ( empty( $item->url ) ) {
			return '';
		}

		$url = untrailingslashit( (string) $item->url );

		if ( $url === untrailingslashit( ctp_url( 'services' ) ) ) {
			return 'services';
		}

		if ( $url === untrailingslashit( ctp_url( 'areas' ) ) ) {
			return 'areas';
		}

		return '';
	}

	/**
	 * Intercept mega items: take their children out of the walk so WordPress
	 * does not also emit a plain <ul>, and keep them for the panel.
	 *
	 * @param WP_Post  $element           Menu item.
	 * @param array    $children_elements Children keyed by parent ID.
	 * @param int      $max_depth         Max depth.
	 * @param int      $depth             Current depth.
	 * @param array    $args              Menu arguments.
	 * @param string   $output            Accumulated markup, by reference.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$type = ( 0 === $depth ) ? $this->mega_type( $element ) : '';

		$element->ctp_mega   = $type;
		$this->mega_children = array();

		if ( $type ) {
			$id = (int) $element->ID;

			if ( ! empty( $children_elements[ $id ] ) ) {
				$this->mega_children = $children_elements[ $id ];
				unset( $children_elements[ $id ] );
			}

			$element->classes   = (array) $element->classes;
			$element->classes[] = 'menu-item--mega';

			if ( ! in_array( 'menu-item-has-children', $element->classes, true ) ) {
				$element->classes[] = 'menu-item-has-children';
			}
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Open a plain submenu, giving it the id its toggle button points at.
	 *
	 * @param string   $output Accumulated markup, by reference.
	 * @param int      $depth  Current depth.
	 * @param stdClass $args   Menu arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= sprintf(
			"\n<ul id=\"%s\" class=\"sub-menu\">\n",
			esc_attr( 'ctp-submenu-' . $this->parent_id )
		);
	}

	/**
	 * Render one menu item, appending a toggle and, for mega items, the panel.
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

		if ( 0 !== $depth ) {
			return;
		}

		$mega = isset( $data_object->ctp_mega ) ? $data_object->ctp_mega : '';

		if ( ! $mega && ! in_array( 'menu-item-has-children', (array) $data_object->classes, true ) ) {
			return;
		}

		$panel_id = ( $mega ? 'ctp-mega-' : 'ctp-submenu-' ) . $data_object->ID;

		$output .= sprintf(
			'<button type="button" class="nav__toggle" aria-expanded="false" aria-controls="%1$s"><span class="screen-reader-text">%2$s</span>%3$s</button>',
			esc_attr( $panel_id ),
			/* translators: %s: parent menu item name. */
			esc_html( sprintf( __( 'Show %s menu', 'ctp' ), wp_strip_all_tags( $data_object->title ) ) ),
			ctp_get_icon( 'chevron', 16, 'nav__chevron' )
		);

		if ( $mega ) {
			$output .= $this->render_mega( $mega, $panel_id );
		}
	}

	/**
	 * Resolve a menu item to the post it points at.
	 *
	 * @param WP_Post $menu_item Menu item.
	 * @return WP_Post|null
	 */
	private function resolve_post( $menu_item ) {
		if ( 'post_type' === $menu_item->type && ! empty( $menu_item->object_id ) ) {
			return get_post( (int) $menu_item->object_id );
		}

		$id = url_to_postid( (string) $menu_item->url );

		return $id ? get_post( $id ) : null;
	}

	/**
	 * Build a mega panel.
	 *
	 * @param string $type     'services' or 'areas'.
	 * @param string $panel_id Element id the toggle controls.
	 * @return string
	 */
	private function render_mega( $type, $panel_id ) {
		ob_start();
		?>
		<div id="<?php echo esc_attr( $panel_id ); ?>" class="mega mega--<?php echo esc_attr( $type ); ?>">
			<div class="container mega__inner">
				<?php
				if ( 'services' === $type ) {
					$this->render_services_panel();
				} else {
					$this->render_areas_panel();
				}
				?>
			</div>
		</div>
		<?php
		return (string) ob_get_clean();
	}

	/**
	 * Services panel: the curated menu children when they exist, otherwise
	 * every published service.
	 */
	private function render_services_panel() {
		$services = array();

		foreach ( $this->mega_children as $child ) {
			$post = $this->resolve_post( $child );

			if ( $post && 'ctp_service' === $post->post_type ) {
				$services[] = $post;
			}
		}

		if ( ! $services ) {
			$services = ctp_get_services();
		}

		if ( ! $services ) {
			return;
		}
		?>
		<div class="mega__main">
			<ul class="mega__grid">
				<?php foreach ( $services as $service ) : ?>
					<?php $tagline = (string) ctp_meta( 'tagline', $service->ID, '' ); ?>
					<li>
						<a href="<?php echo esc_url( (string) get_permalink( $service ) ); ?>">
							<span class="mega__icon"><?php ctp_icon( ctp_service_icon_name( $service->ID ), 20 ); ?></span>
							<span class="mega__body">
								<span class="mega__title"><?php echo esc_html( get_the_title( $service ) ); ?></span>
								<?php if ( $tagline ) : ?>
									<span class="mega__desc"><?php echo esc_html( $tagline ); ?></span>
								<?php endif; ?>
							</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="mega__aside">
			<p class="mega__aside-title"><?php esc_html_e( 'Not sure which you need?', 'ctp' ); ?></p>
			<p class="mega__aside-text">
				<?php esc_html_e( 'Describe what you are seeing, or send a photo. If it does not need fixing yet, we will tell you that.', 'ctp' ); ?>
			</p>
			<a class="btn btn--primary btn--block" href="<?php echo esc_url( ctp_url( 'contact' ) ); ?>">
				<?php esc_html_e( 'Get a free estimate', 'ctp' ); ?>
			</a>
			<a class="mega__aside-link" href="<?php echo esc_url( ctp_url( 'services' ) ); ?>">
				<?php esc_html_e( 'All services', 'ctp' ); ?>
				<?php ctp_icon( 'arrow', 15 ); ?>
			</a>
		</div>
		<?php
	}

	/**
	 * Areas panel: every service-area page, flowed into columns.
	 *
	 * Generated from the content type rather than from menu children, so
	 * nobody has to maintain twenty-odd duplicate menu entries by hand.
	 */
	private function render_areas_panel() {
		$areas = ctp_get_areas();

		if ( ! $areas ) {
			return;
		}

		$radius = ctp_business( 'radius_miles', '45' );
		$city   = ctp_business( 'city', 'Wood Dale' );
		?>
		<div class="mega__main">
			<ul class="mega__list">
				<?php foreach ( $areas as $area ) : ?>
					<li>
						<a href="<?php echo esc_url( (string) get_permalink( $area ) ); ?>">
							<?php echo esc_html( get_the_title( $area ) ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="mega__aside">
			<p class="mega__aside-title"><?php esc_html_e( 'About an hour in every direction', 'ctp' ); ?></p>
			<p class="mega__aside-text">
				<?php
				printf(
					/* translators: 1: home city, 2: radius in miles. */
					esc_html__( 'Roughly %2$s miles from %1$s: all of DuPage, most of Cook, and into Kane, Lake, Will, McHenry and Kendall.', 'ctp' ),
					esc_html( $city ),
					esc_html( $radius )
				);
				?>
			</p>
			<a class="mega__aside-link" href="<?php echo esc_url( ctp_url( 'areas' ) ); ?>">
				<?php esc_html_e( 'Full coverage list', 'ctp' ); ?>
				<?php ctp_icon( 'arrow', 15 ); ?>
			</a>
		</div>
		<?php
	}
}

/**
 * Mark the archive parent as current when viewing a single service, area or
 * project, so the active state does not disappear on the detail pages.
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
