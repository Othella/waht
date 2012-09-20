<?php
/**
 * @description: Theme options Social Networks section in admin panel
 * @name       : inc/theme-options/social-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// Register the options for the social networks
function waht_social_options_init() {

	// If the options don't exist, create them.
	if (false == get_option('waht_social_options')) {
		add_option('waht_social_options', waht_get_default_social_options());
	}

	// Register the $waht_array for our options
	register_setting(
		'waht_social_options', // Options name
		'waht_social_options', // Option group
		'waht_sanitize_social_options' //Sanitize callback
	);

	// Register the social settings groups
	add_settings_section(
		'social_section',
		__('Social Networks Settings', 'waht'),
		'waht_social_options_section_callback',
		'waht_social_options'
	);

	if (get_theme_support('og-facebook')) :
		// Register the Facebook Open Graph settings field
		add_settings_field(
			'facebook_og',
			__('Facebook Open Graph', 'waht'),
			'waht_change_facebook_og_callback',
			'waht_social_options',
			'social_section'
		);
	endif;

	// Register the Twitter Cards settings field
	add_settings_field(
		'twitter_cards',
		__('Twitter Cards', 'waht'),
		'waht_change_twitter_cards_callback',
		'waht_social_options',
		'social_section'
	);
}

/**
 * Renders the social settings section
 */
function waht_social_options_section_callback() {
	echo '<p class="description">' . __('Settings for the social networks', 'waht') . '</p>';
}

/**
 * Renders the Facebook Open Graph settings field
 */
function waht_change_facebook_og_callback() { }

/**
 * Renders the Twitter Cards settings field
 */
function waht_change_twitter_cards_callback() { }

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function waht_sanitize_social_options($input) {
	$output = $defaults = waht_get_default_social_options();

	return apply_filters('waht_sanitize_social_options', $output, $input, $defaults);
}

/**
 * Returns the default social options
 *
 * @return mixed|void
 */
function waht_get_default_social_options() {
	$default_social_options = array(
		'facebook_og'      => '',
		'twitter_cards'    => ''
	);
	return apply_filters('waht_get_default_seo_options', $default_social_options);

}

/**
 * Returns the social options array
 *
 * @return mixed|void
 */
function waht_get_social_options() {
	return get_option('waht_social_options', waht_get_default_social_options());
}