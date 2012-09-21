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
 * Displays post meta info in a compact
 *
 * @param $post_ID int The ID of the post
 */
function waht_meta_compact($post_ID = null) {
	$categories = waht_get_the_category_list('label label-info', ' ');
	$edit_url   = get_edit_post_link($post_ID);
	$meta       = '<p class="post-meta compact">';
	echo '<time class="updated" datetime="' . get_the_date('c') . '" pubdate><i class="icon-calendar"></i> ' . get_the_date() . '</time>';
	echo ' | <span class="author vcard"><i class="icon-user"></i> <a href="' .
		get_author_posts_url(get_the_author_meta('ID')) . '" rel="author" class="fn">' . get_the_author() . '</a></span>';
	echo ($categories != '') ? (' | ' . $categories) : '';
	if (comments_open($post_ID) && !post_password_required($post_ID)) :
		echo ' | <i class="icon-comment"></i> ';
		comments_popup_link(__('No Comment', 'waht'), _x('1 Comment', 'comments number', 'waht'), _x('% Comments', 'comments number', 'waht'));
	endif;
	echo ($edit_url != '') ? (' | <i class="icon-pencil"></i> <a href="' . $edit_url . '">' . __('Edit', 'waht') . '</a>') : '';
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

/**
 * Returns the theme name
 * Note: it is the same as the theme folder's name!
 *
 * @return mixed
 */
function waht_get_theme_name() {
	$get_theme_name = explode('/themes/', get_template_directory());
	return next($get_theme_name);
}

/**
 * Returns the WordPress subdirectory
 *
 * @return string
 */
function waht_wp_base_dir() {
	preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
	if (count($matches) === 3) {
		return end($matches);
	}
	else {
		return '';
	}
}

/**
 * Return the current theme path
 *
 * @return string
 */
function waht_get_theme_path() {
	return waht_get_relative_content_path() . '/themes/' . waht_get_theme_name();
}

/**
 * Return the current theme's version
 *
 * @return mixed
 */
function waht_get_theme_version() {
	$theme = wp_get_theme();
	return $theme['Version'];
}

/**
 * Return the URI where our theme assets are located
 *
 * @return string
 */
function waht_get_assets_uri() {
	global $is_apache;
	$waht_assets_uri = get_template_directory_uri();
	if (is_admin() || !$is_apache || is_multisite() || is_child_theme() || !get_option('permalink_structure') ||
		!current_theme_supports('rewrite-urls')
	)
		$waht_assets_uri .= '/assets';
	return $waht_assets_uri;
}

/**
 * Return the path to the current theme assets
 *
 * @return string
 */
function waht_get_assets_path() {
	return waht_get_theme_path() . '/assets';
}

/**
 * Return the relative path to the plugins folder
 *
 * @return mixed
 */
function waht_get_relative_plugin_path() {
	return str_replace(site_url() . '/', '', plugins_url());
}

/**
 * Return the complete relative path to the plugin folder
 *
 * @return string
 */
function waht_get_full_relative_plugin_path() {
	// TODO (a.h) waht_get_full_relative_plugin_path completely breaks theme!
	//return ABSPATH . '/' . waht_get_relative_plugin_path();
}

/**
 * Return the relative path to content
 *
 * @return mixed
 */
function waht_get_relative_content_path() {
	return str_replace(site_url() . '/', '', content_url());
}

/**
 * Display a div with an alert and a search form when no posts were found
 */
function waht_no_posts_div() {
	echo '<div class="' . waht_alert_classes() . '">';
	echo '<a href="#" class="close" data-dismiss="alert" >&times;</a>';
	echo '<span>' . __('Sorry, no results match with your request! Maybe you could use the following search form?', 'waht') . '</span>';
	echo '</div>';
	get_search_form();
}

/**
 * Retrieve category list in either HTML list or custom format.
 *
 * @param string   $label_class Optional, default is empty string. Class for label wrapping a category string.
 * @param string   $separator   Optional, default is empty string. Separator for between the categories.
 * @param string   $parents     Optional. How to display the parents.
 * @param bool|int $post_id     Optional. Post ID to retrieve categories.
 *
 * @return string
 */
function waht_get_the_category_list($label_class = '', $separator = '', $parents = '', $post_id = false) {
	global $wp_rewrite;
	if (!is_object_in_taxonomy(get_post_type($post_id), 'category'))
		return apply_filters('the_category', '', $separator, $parents);

	$categories = get_the_category($post_id);
	if (empty($categories))
		return apply_filters('the_category', __('Uncategorized', 'waht'), $separator, $parents);

	$rel = (is_object($wp_rewrite) && $wp_rewrite->using_permalinks()) ? 'rel="category tag"' : 'rel="category"';

	if (waht_use_foundation_framework()) $label_class .= ' radius';

	$thelist = '';
	if ('' == $separator) {
		$thelist .= '<ul class="post-categories">';
		foreach ($categories as $category) {
			$thelist .= "\n\t<li>";
			switch (strtolower($parents)) {
				case 'multiple':
					if ($category->parent)
						$thelist .= get_category_parents($category->parent, true, $separator);
					$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' .
						esc_attr(sprintf(__("View all posts in %s", 'waht'), $category->name)) . '" ' . $rel . '><span class="' . $label_class .
						'">' .
						$category->name . '</span></a></li>';
					break;
				case 'single':
					$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' .
						esc_attr(sprintf(__("View all posts in %s", 'waht'), $category->name)) . '" ' . $rel . '><span class="' . $label_class .
						'">';
					if ($category->parent)
						$thelist .= get_category_parents($category->parent, false, $separator);
					$thelist .= $category->name . '</span></a></li>';
					break;
				case '':
				default:
					$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' .
						esc_attr(sprintf(__("View all posts in %s", 'waht'), $category->name)) . '" ' . $rel . '><span class="' . $label_class .
						'">' .
						$category->name . '</span></a></li>';
			}
		}
		$thelist .= '</ul>';
	}
	else {
		$i = 0;
		foreach ($categories as $category) {
			if (0 < $i)
				$thelist .= $separator;
			switch (strtolower($parents)) {
				case 'multiple':
					if ($category->parent)
						$thelist .= get_category_parents($category->parent, true, $separator);
					$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' .
						esc_attr(sprintf(__("View all posts in %s", 'waht'), $category->name)) . '" ' . $rel . '><span class="' . $label_class .
						'">' .
						$category->name . '</span></a>';
					break;
				case 'single':
					$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' .
						esc_attr(sprintf(__("View all posts in %s", 'waht'), $category->name)) . '" ' . $rel . '><span class="' . $label_class .
						'">';
					if ($category->parent)
						$thelist .= get_category_parents($category->parent, false, $separator);
					$thelist .= "$category->name</span></a>";
					break;
				case '':
				default:
					$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' .
						esc_attr(sprintf(__("View all posts in %s", 'waht'), $category->name)) . '" ' . $rel . '><span class="' . $label_class .
						'">' .
						$category->name . '</span></a>';
			}
			++$i;
		}
	}
	return apply_filters('the_category', $thelist, $separator, $parents);
}

