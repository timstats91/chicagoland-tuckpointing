<?php
/**
 * Search form.
 *
 * @package CTP
 */

defined( 'ABSPATH' ) || exit;

$ctp_search_id = 'search-' . wp_unique_id();
?>
<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $ctp_search_id ); ?>">
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'ctp' ); ?></span>
		<input
			type="search"
			id="<?php echo esc_attr( $ctp_search_id ); ?>"
			name="s"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			placeholder="<?php esc_attr_e( 'Search services and articles', 'ctp' ); ?>" />
	</label>
	<button class="btn btn--dark" type="submit"><?php esc_html_e( 'Search', 'ctp' ); ?></button>
</form>
