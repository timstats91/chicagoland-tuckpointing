<?php
/**
 * Plugin Name:       CTP Core
 * Plugin URI:        https://chicagolandtuckpointing.com
 * Description:       Content engine for Chicagoland Tuckpointing: services, service areas, projects, business info, and local SEO schema. Kept in a plugin so this content survives a theme change.
 * Version:           1.0.0
 * Requires at least: 6.4
 * Requires PHP:      8.0
 * Author:            Chicagoland Tuckpointing
 * License:           GPL-2.0-or-later
 * Text Domain:       ctp-core
 *
 * @package CTP_Core
 */

defined( 'ABSPATH' ) || exit;

define( 'CTP_CORE_VERSION', '1.0.0' );
define( 'CTP_CORE_FILE', __FILE__ );
define( 'CTP_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'CTP_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once CTP_CORE_DIR . 'inc/helpers.php';
require_once CTP_CORE_DIR . 'inc/post-types.php';
require_once CTP_CORE_DIR . 'inc/meta.php';
require_once CTP_CORE_DIR . 'inc/settings.php';
require_once CTP_CORE_DIR . 'inc/schema.php';
require_once CTP_CORE_DIR . 'inc/shortcodes.php';
require_once CTP_CORE_DIR . 'inc/seed.php';

/**
 * Register everything up front on activation and flush rewrite rules once, so
 * /services/, /service-areas/ and /projects/ resolve immediately.
 */
function ctp_core_activate() {
	ctp_register_post_types();
	ctp_register_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ctp_core_activate' );

/**
 * Clean up rewrite rules when the plugin is switched off.
 */
function ctp_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ctp_core_deactivate' );
