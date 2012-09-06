<?php
/**
 * @description: Cleanup auto-generated WP outputs
 * @name       : inc/cleanup.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Add custom classes to body tag
 *
 * @param $classes
 *
 * @return array
 */
function waht_body_class($classes) {
	if (WAHT_BOOTSTRAP) {
		// Add 'bootstrap' class to body tag if using Bootstrap
		$classes[] = 'bootstrap';
		if (WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR)
			// Add 'waht-navbar-fixed-top' class to body tag if using Bootstrap's top-fixed navbar
			$classes[] = 'waht-navbar-fixed-top';
	}
	return $classes;
}

add_filter('body_class', 'waht_body_class');

/**
 * Clean the head : remove unused links and tags
 * @see http://wpengineer.com/1438/wordpress-header/
 */
function waht_clean_head() {
	remove_action('wp_head', 'feed_links_extra', 3); // Remove the links to the extra feeds such as category feeds
	remove_action('wp_head', 'feed_links', 2); // Remove the links to the general feeds: Post and Comment Feed
	remove_action('wp_head', 'rsd_link'); // Remove the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action('wp_head', 'wlwmanifest_link'); // Remove the link to the Windows Live Writer manifest file.
	remove_action('wp_head', 'index_rel_link'); // Remove the index link
	remove_action('wp_head', 'parent_post_rel_link_wp_head', 10, 0); // Remove the prev link
	remove_action('wp_head', 'start_post_rel_link_wp_head', 10, 0); // Remove the start link
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Remove relational links for the posts adjacent to the current post.
	remove_action('wp_head', 'wp_generator'); // Remove the XHTML generator that is generated on the wp_head hook, WP version
}

add_filter('init', 'waht_clean_head');

// TODO (a.h) Add classes into widgets (order and lists)
function waht_add_widget_classes() {

}

add_filter('dynamic_sidebar_params', 'waht_add_widget_classes');

/**
 * Wrap with a div tag with an .entry-content-asset class
 * @param        $cache
 * @param        $url
 * @param string $attr
 * @param string $post_ID
 *
 * @return string
 */
function waht_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
	return '<div class="entry-content-asset">' . $cache . '</div>';
}

add_filter('embed_oembed_html', 'waht_embed_wrap', 10, 4);
add_filter('embed_googlevideo', 'waht_embed_wrap', 10, 2);