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
	if (waht_get_framework() != '') {
		// Set the framework name as class to body tag if using one
		$classes[] = waht_get_framework();
		if (WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR)
			// Add 'waht-navbar-fixed-top' class to body tag if using Bootstrap's top-fixed navbar
			$classes[] = 'waht-navbar-fixed-top';
	}
	return $classes;
}

add_filter('body_class', 'waht_body_class');

/**
 * Clean the head : remove unused links and tags
 *
 * @link http://wpengineer.com/1438/wordpress-header/
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

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 *
 * @link http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
 *
 * @param $params
 *
 * @return mixed
 */
function waht_widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id                = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	if (!$my_widget_num) // If the counter array doesn't exist, create it
		$my_widget_num = array();

	if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.

	if (isset($my_widget_num[$this_id])) // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id]++;
	else // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if ($my_widget_num[$this_id] == 1) // If this is the first widget
		$class .= 'widget-first ';
	elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) // If this is the last widget
		$class .= 'widget-last ';

	$params[0]['before_widget'] =
		preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1); // Insert our new classes into "before widget"

	return $params;
}

add_filter('dynamic_sidebar_params', 'waht_widget_first_last_classes');

/**
 * Enclose embedded media in a div with .entry-content-asset class
 *
 * @param        $cache
 * @param        $url
 * @param string $attr
 * @param string $post_ID
 *
 * @return string
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function waht_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
	return '<div class="embed entry-content-asset">' . $cache . '</div>';
}

add_filter('embed_oembed_html', 'waht_embed_wrap', 10, 4);
add_filter('embed_googlevideo', 'waht_embed_wrap', 10, 2);