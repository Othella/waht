<?php
/**
 * @description: Theme options Responsive section in admin panel
 * @name       : inc/theme-options/responsive-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// Register the options for the responsive behavior
function waht_responsive_options_init() {

	// If the options don't exist, create them.
	if (false == get_option('waht_responsive_options')) {
		add_option('waht_responsive_options');
	}

	// Register the $waht_responsive_options array for our options
	register_setting(
		'waht_display_options', // Options group
		'waht_responsive_options', // Option name
		'waht_sanitize_responsive_options' //Sanitize callback
	);

	// Register the responsive options field group
	add_settings_section(
		'responsive_section', // ID
		__('Responsive Settings', 'waht'), // Title
		'waht_responsive_options_section_callback', // Callback
		'waht_display_options' // Page
	);

	// Register using responsive layout settings field
	add_settings_field(
		'responsive', // ID
		__('Use Responsive', 'waht'), // Title
		'waht_toggle_responsive_callback', // Callback
		'waht_display_options', // Page
		'responsive_section', // Section
		array(
			'description' => __('Set the theme as responsive', 'waht')
		)
	);

	// Register Apple icons settings field
	add_settings_field(
		'apple_icons_path',
		__('Apple Icons', 'waht'),
		'waht_change_apple_icons_path_callback',
		'waht_display_options',
		'responsive_section',
		array(
			'description' => __('Set the path to the Apple icons folder', 'waht')
		)
	);
}

/**
 * Renders the responsive options section
 */
function waht_responsive_options_section_callback() {
	echo '<p class="description">' . __('Settings for the responsive behavior', 'waht') . '</p>';
}

/**
 * Renders the checkbox to toggle the use of a responsive bahevior
 */
function waht_toggle_responsive_callback($args) {
	$waht_responsive_options = waht_get_responsive_options(); ?>
<input type="checkbox" id="waht_responsive_options[responsive]" name="waht_responsive_options[responsive]"
       value="1"<?php checked(true, $waht_responsive_options['responsive']); ?> />
<label for="waht_responsive_options[responsive]"
       class="description"><?php echo $args['description'] ?></label>
<?php
}

/**
 * Renders a text field to enter the apple icons folder's path
 */
function waht_change_apple_icons_path_callback($args) {
	$waht_responsive_options = waht_get_responsive_options(); ?>
<input type="text" name="waht_responsive_options[apple_icons_path]" id="waht_responsive_options[apple_icons_path]"
       value="<?php echo sanitize_text_field($waht_responsive_options['apple_icons_path']); ?>">
<label for="waht_responsive_options[apple_icons_path]"
       class="description"><?php echo $args['description']; ?></label>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function waht_sanitize_responsive_options($input) {
	$output = $defaults = waht_get_default_responsive_options();

	if (!isset($_GET['reset'])) :

		// The responsive option is either true or false
		if (!isset($input['responsive'])) $input['responsive'] = null;
		$output['responsive'] = ($input['responsive'] == '1') ? true : false;

		// Sanitize input
		// TODO (a.h) Check if folder exists
		if (isset($input['apple_icons_path']))
			$output['apple_icons_path'] = esc_url_raw(strip_tags(stripslashes($input['apple_icons_path'])));
	endif;

	return apply_filters('waht_sanitize_responsive_options', $output, $input, $defaults);
}

/**
 * Returns the default responsive theme options
 *
 * @return mixed|void
 */
function waht_get_default_responsive_options() {
	$default_responsive_options = array(
		'responsive'              => true, // true = enabled, true = not enabled
		'apple_icons_path'        => get_template_directory_uri() . '/assets/img/ios/'
	);

	return apply_filters('waht_get_default_responsive_options', $default_responsive_options);
}

/**
 * Returns the responsive behavior options array
 *
 * @return mixed|void
 */
function waht_get_responsive_options() {
	return get_option('waht_responsive_options', waht_get_default_responsive_options());
}
