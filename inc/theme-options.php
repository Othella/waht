<?php
/**
 * @description: Theme options in admin panel
 * @name       : inc/theme-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Register the form setting for our waht_options array
 */
function waht_theme_options_init() {
	register_setting(
		'waht_options', // Options group
		'waht_theme_options', // Database option
		'waht_theme_options_validate' // sanitization callback
	);

	// Register the options field group
	add_settings_section(
		'general', // Section unique identifier
		'', // Section title (none)
		'__return_false', // Section callback (none),
		'theme_options' // Menu slug
	);

	// Register Google Analytics settings field
	add_settings_field(
		'google_analytics', // Field unique identifier
		__('Google Analitics', 'waht'), // Field label
		'waht_google_analytics_options', // Function that renders the setting field
		'theme_options', // Menu slug
		'general' // Section
	);

	// Register Apple icons settings field
	add_settings_field(
		'apple_icons', // Field unique identifier
		__('Apple Icons', 'waht'), // Field label
		'waht_apple_icons_options', // Function that renders the setting field
		'theme_options', // Menu slug
		'general' // Section
	);

	// Register the layout settings
	add_settings_field(
		'layout', // Field unique identifier
		__('Layout', 'waht'), // Field label
		'waht_layout_options', // Function that renders the setting field
		'theme_options', // Menu slug
		'general' // Section
	);
}

add_action('admin_init', 'waht_theme_options_init');

/**
 * Add the theme options page to the admin menu, including some help documentation.
 */
function waht_theme_options_add_page() {
	$theme_page = add_theme_page(
		THEME_NAME . ' ' . __('Theme Options', 'waht'), // Name of the theme options' page
		THEME_NAME . ' ' . __('Theme Options', 'waht'), // Label in menu
		'edit_theme_options', // Capability required
		'theme_options', // Menu slug
		'waht_theme_options_render_page' // Function rendering options page
	);
	if (!$theme_page) return;
	add_action("load-$theme_page", 'waht_theme_options_help');
}

add_action('admin_menu', 'waht_theme_options_add_page');

/**
 * Renders the theme options page
 */
function waht_theme_options_render_page() {

}


function waht_google_analytics_options() {
	// TODO (a.h) Code GA theme options
}

function waht_apple_icons_options() {
	// TODO (a.h) Code Apple icons theme options
	$apple_icons_options = array();
}

function waht_layout_options() {
	// TODO (a.h) Code layout theme options
}

/**
 * Returns the default theme options
 *
 * @return mixed|void
 */
function waht_get_default_theme_options() {
	$default_theme_options = array(
		'google_analytics' => '',
		'apple_icons_path' => get_template_directory_uri() . '/assets/img/ios/',
		'sidebar_position' => 'right'
	);
	if (is_rtl())
		$default_theme_options['sidebar_position'] = 'left';
	return apply_filters('waht_default_theme_options', $default_theme_options);
}

/**
 * Returns the options array
 *
 * @return mixed|void
 */
function waht_get_theme_options() {
	return get_option('waht_theme_options', waht_get_default_theme_options());
}

/**
 * Displays documentation
 */
function waht_theme_options_help() {
	// TODO (a.h) Code theme options help
}

/**
 * Displays credential on admin footer
 */
function waht_admin_footer() {
	$credentials = '<span class="footer-thanks">' . waht_credentials() . '</span>';
	$credentials .= ' - ' . __('Build using', 'waht') . ' <a href="https://github.com/Othella/waht" title="waht on GitHub" target="_blank">waht</a>';
	echo $credentials;
}

add_filter('admin_footer_text', 'waht_admin_footer');