<?php
/**
 * @description: Some useful handy functions
 * @name       : inc/utils.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Outputs a credential string
 *
 * @return string
 */
function waht_credentials() {
	$date = WAHT_CREATE_YEAR;
	$date .= (WAHT_CREATE_YEAR < date('Y')) ? '-' . date('Y') : '';

	$credentials = get_bloginfo('name') . ' ' . __('developed by', 'waht');
	$credentials .= ' <a href="' . WAHT_AUTHOR_URI . '" title="' . WAHT_AUTHOR_NAME . '" target="_blank">';
	$credentials .= WAHT_AUTHOR_NAME;
	$credentials .= '</a> &copy; ' . $date;
	return $credentials;
}

/**
 * Get the container class name
 */
function waht_container_class() {
	echo (WAHT_FLUID_LAYOUT ? 'container-fluid' : 'container');
}

/**
 * Display a dynamic title tag
 *
 * @link http://css-tricks.com/snippets/wordpress/dynamic-title-tag/
 */
function waht_dynamic_title() {
	global $paged, $s;
	if (function_exists('is_tag') && is_tag()) {
		single_tag_title(__("Tag Archive for &quot;", 'waht'));
		echo '&quot; - ';
	}
	elseif (is_archive()) {
		wp_title('');
		echo ' ' . __('Archive', 'waht') . ' | ';
	}
	elseif (is_search()) {
		echo __('Search for', 'waht') . ' &quot;' . esc_html($s) . '&quot; - ';
	}
	elseif (!is_404() && !is_front_page() && (is_single() || is_page() || is_home())) {
		wp_title('');
		echo ' | ';
	}
	elseif (is_404()) {
		echo __('Not Found', 'waht') . ' | ';
	}
	if (is_front_page()) {
		bloginfo('name');
		echo ' | ';
		bloginfo('description');
	}
	else {
		bloginfo('name');
	}
	if ($paged > 1) {
		echo ' - ' . __('page', 'waht') . ' ' . $paged;
	}
}

/**
 * Insert a clearfix div
 */
function waht_add_clearfix_div() {
	echo '<div class="clearfix"></div>';
}

/**
 * Display post meta info
 */
function waht_meta() {
	$time       = '<time class="updated" datetime="' . get_the_date('c') . '" pubdate>' .
		sprintf(__('Posted on %s at %s.', 'waht'), get_the_date(), get_the_time()) . '</time>';
	$author     = '<p class="author vcard">' . __('Written by', 'waht') . ' <a href="' .
		get_author_posts_url(get_the_author_meta('ID')) . '" rel="author" class="fn">' . get_the_author() . '</a></p>';
	$categories = '<p class="categories">' . __('Posted in', 'waht') . ' ' . get_the_category_list(' | ') . '</p>';
	echo $time . $author . $categories;
}

/**
 * Call many filters at once
 *
 * @param $tags
 * @param $function
 */
function waht_add_filters($tags, $function) {
	foreach ($tags as $tag) {
		add_filter($tag, $function);
	}
}

function waht_get_theme_name() {
	// TODO (a.h)
}

/**
 * Return the current theme's version
 * @return mixed
 */
function waht_get_theme_version() {
	$theme = wp_get_theme();
	return $theme['Version'];
}

/**
 * Return the URI where our theme assets are located
 * @return string
 */
function waht_get_assets_uri() {
	global $is_apache;
	$waht_assets_uri = get_template_directory_uri();
	if (!$is_apache || is_multisite() || is_child_theme() || !get_option('permalink_structure') || !current_theme_supports('rewrite-urls'))
		$waht_assets_uri .= '/assets';
	return $waht_assets_uri;
}