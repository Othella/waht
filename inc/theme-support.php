<?php
/**
 * @description: WP Theme support
 * @name       : inc/theme-support.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Theme support
 * See http://codex.wordpress.org/Function_Reference/add_theme_support
 */
global $wp_version, $is_apache;

if (version_compare($wp_version, '3.4', '>='))
	// Add support for custom header
	// See http://codex.wordpress.org/Custom_Headers
	add_theme_support('custom-header', array(
		'default-image'          => get_template_directory_uri() . '/assets/img/logo.png',
		'random-default'         => false,
		'width'                  => 245,
		'height'                 => 145,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	));

if (version_compare($wp_version, '3.4', '>='))
	// Add support for custom backgrounds
	// See http://codex.wordpress.org/Custom_Backgrounds
	add_theme_support('custom-background', array(
		'default-color'          => '#ffffff',
		'default-image'          => get_template_directory_uri() .
			"/assets/img/white_paper_texture_background_seamless_pattern.jpg",
		'wp_head_callback'       => 'custom_background_cb', // TODO (a.h) Code wp_head callback
		'admin-head-callback'    => '', // TODO (a.h) Code admin-head callback
		'admin-preview-callback' => '' // TODO (a.h) Code admin-preview callback
	));

// Add support for WP menus
if (version_compare($wp_version, '3.0', '>='))
	add_theme_support('menus');

if (version_compare($wp_version, '3.1', '>='))
	// Add support for custom post format
	// See http://codex.wordpress.org/Post_Formats
	add_theme_support('post-formats', array(
		'aside',
		'gallery',
		'link',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat'
	));

if (version_compare($wp_version, '2.9', '>='))
	// Add support for custom post thumbnails
	// See http://codex.wordpress.org/Post_Thumbnails
	add_theme_support('post-thumbnails');

if (version_compare($wp_version, '3.0', '>='))
	// Add support for automatic feed links
	add_theme_support('automatic-feed-links');

if (WAHT_APPLE_ICONS) :
	$waht_responsive_options = waht_get_responsive_options();
	$waht_apple_icons_path = $waht_responsive_options['apple_icons_path'];
	add_theme_support('apple-touch-icons', array(
		'default'     => $waht_apple_icons_path . 'apple-touch-icon.png',
		'precomposed' => $waht_apple_icons_path . 'apple-touch-icon-precomposed.png',
		'57x57'       => $waht_apple_icons_path . 'apple-touch-icon-57x57-precomposed.png',
		'72x72'       => $waht_apple_icons_path . 'apple-touch-icon-72x72-precomposed.png',
		'114x114'     => $waht_apple_icons_path . 'apple-touch-icon-114x114-precomposed.png'
	)); // Apple Touch Icons
else :
	remove_theme_support('apple-touch-icons');
endif;

if (current_theme_supports('apple-touch-icons')) :
	/**
	 * Add links to Apple icons
	 */
	function waht_print_apple_icons() {
		$apple_icons     = get_theme_support('apple-touch-icons');
		$apple_icons_str = "";
		$apple_icons_str .= "\n\t<link rel=\"apple-touch-icon\" href=\"" . $apple_icons[0]['default'] . "\">";
		$apple_icons_str .=
			"\n\t<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"" . $apple_icons[0]['72x72'] . "\">";
		$apple_icons_str .= "\n\t<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"" .
			$apple_icons[0]['114x114'] . "\">";
		echo $apple_icons_str;
	}

	add_action('waht_head', 'waht_print_apple_icons');
endif;

if (current_theme_supports('html5-boilerplate-htaccess')) :
	/**
	 * Insert html5-boilerplate.htaccess content into .htaccess file
	 *
	 * @param $content
	 *
	 * @return mixed
	 */
	function waht_insert_html5_boilerplate_htaccess($content) {
		global $wp_rewrite;

		$home_path                      = get_home_path();
		$htaccess_file                  = $home_path . '.htaccess';
		$html5_boilerplate_htacess_file = dirname(__FILE__) . '/html5-boilerplate-htaccess';

		if ((!file_exists($htaccess_file) && is_writable($home_path) && $wp_rewrite->using_mod_rewrite_permalinks()) || is_writable($htaccess_file)) {
			if (got_mod_rewrite()) {
				$h5bp_rules = extract_from_markers($htaccess_file, 'HTML5-Boilerplate');
				if ($h5bp_rules === array())
					return insert_with_markers(
						$htaccess_file,
						'HTML5-Boilerplate',
						extract_from_markers($html5_boilerplate_htacess_file, 'HTML5-Boilerplate'));
			}
		}
		return $content;
	}

	if ($is_apache && !is_multisite() && !is_child_theme() && get_option('permalink_structure'))
		add_action('generate_rewrite_rules', 'waht_insert_html5_boilerplate_htaccess');

endif;

if (current_theme_supports('rewrite-urls')) :
	/**
	 * Rewrite URLs
	 *
	 * @param $content
	 *
	 * @return mixed
	 */
	function waht_generate_rewrite_rules($content) {
		global $wp_rewrite;
		$waht_non_wp_rules        = array(
			'css/(.*)'            => waht_get_assets_path() . '/css/$1',
			'js/(.*)'             => waht_get_assets_path() . '/js/$1',
			'img/(.*)'            => waht_get_assets_path() . '/img/$1',
			'fonts/(.*)'          => waht_get_assets_path() . '/fonts/$1',
			'frameworks/(.*)'     => waht_get_theme_path() . '/frameworks/$1',
			'plugins/(.*)'        => waht_get_relative_plugin_path() . '/$1'
		);
		$wp_rewrite->non_wp_rules = array_merge($wp_rewrite->non_wp_rules, $waht_non_wp_rules);
		return $content;
	}

	if ($is_apache && !is_multisite() && !is_child_theme() && get_option('permalink_structure'))
		add_action('generate_rewrite_rules', 'waht_generate_rewrite_rules');

	/**
	 * Clean URLs
	 *
	 * @param $content
	 *
	 * @return mixed
	 */
	function waht_clean_urls($content) {
		if (strpos($content, waht_get_full_relative_plugin_path()) === 0) :
			return str_replace(waht_get_full_relative_plugin_path(), WP_BASE . '/plugins', $content);
		else :
			return str_replace('/' . waht_get_theme_path(), '', $content);
		endif;
	}

	if ($is_apache && !is_admin()) {
		$urls = array(
			'plugins_url',
			'bloginfo',
			'stylesheet_directory_uri',
			'template_directory_uri',
			'script_loader_src',
			'style_loader_src'
		);
		waht_add_filters($urls, 'waht_clean_urls');
	}
endif;

// TODO (a.h) Code Theme support for relative URLs
if (current_theme_supports('use-relative-urls')) :
endif;

// TODO (a.h) Code Theme support for OpenGraph Facebook
if (current_theme_supports('og-facebook')) :
endif;