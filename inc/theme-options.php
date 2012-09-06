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

	// Register the general options field group
	add_settings_section(
		'layout', // Section unique identifier
		__('Layout', 'waht'), // Section title (none)
		'__return_false', // Section callback (none),
		'theme_options' // Menu slug
	);

	// Register the layout settings
	add_settings_field(
		'sidebar_position', // Field unique identifier
		__('Sidebar Position', 'waht'), // Field label
		'waht_settings_field_sidebar_position', // Function that renders the setting field
		'theme_options', // Menu slug
		'layout' // Section
	);

	// Register the SEO options field group
	add_settings_section(
		'seo', // Section unique identifier
		__('SEO (Search Engines Optimization)', 'waht'), // Section title
		'waht_settings_section_seo', // Section callback
		'theme_options' // Menu slug
	);

	// Register Google Analytics settings field
	add_settings_field(
		'google_analytics_id', // Field unique identifier
		__('Google Analytics ID', 'waht'), // Field label
		'waht_settings_field_google_analytics_id', // Function that renders the setting field
		'theme_options', // Menu slug
		'seo' // Section
	);

	// Register the SEO options field group
	add_settings_section(
		'responsive', // Section unique identifier
		__('Responsive Options', 'waht'), // Section title
		'waht_settings_section_responsive', // Section callback
		'theme_options' // Menu slug
	);

	// Register Apple icons settings field
	add_settings_field(
		'apple_icons', // Field unique identifier
		__('Apple Icons', 'waht'), // Field label
		'waht_settings_field_apple_icons', // Function that renders the setting field
		'theme_options', // Menu slug
		'responsive' // Section
	);
}

add_action('admin_init', 'waht_theme_options_init');

/**
 * Add the theme options page to the admin menu, including some help documentation.
 */
function waht_theme_options_add_page() {
	$theme_page = add_theme_page(
		sprintf(__('%s Theme Options', 'waht'), THEME_NAME), // Name of the theme options' page
		sprintf(__('%s Theme Options', 'waht'), THEME_NAME), // Label in menu
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
	?>
<div class="wrap">
	<?php screen_icon(); // Displays screen icon ?>
    <h2><?php printf(__('%s Theme Options', 'waht'), THEME_NAME); ?></h2>
	<?php settings_errors(); ?>
    <div class="waht-theme-options">
        <form method="post" action="options.php">
			<?php
			settings_fields('waht_options');
			do_settings_sections('theme_options');
			submit_button();
			?>
        </form>
    </div>
</div>
<?
}

/**
 * Renders the layout options section
 */
function waht_settings_section_layout() {
	?>
<p class="description"><?php _e('Settings for the layout', 'waht'); ?></p>
<?php
}

/**
 * Renders the sidebar position select option field
 */
function waht_settings_field_sidebar_position() {
	$waht_options             = waht_get_theme_options();
	$selected_position        = $waht_options['sidebar_position'];
	$sidebar_position_options = waht_sidebar_positions();?>
<select name="waht_theme_options[sidebar_position]" id="waht_sidebar_position">
	<?php foreach ($sidebar_position_options as $option) :
	$label    = $option['label'];
	$value    = $option['value'];
	$selected = ($selected_position == $value) ? ' selected="selected"' : '';
	?>
    <option value="<?php echo $value ?>"<?php echo $selected?>><?php echo $label; ?></option>
	<?php endforeach ?>
</select>
<label for="waht_sidebar_position" class="description"><?php _e('Select on which side you want to display your sidebar', 'waht'); ?></label>
<?php
}

/**
 * Returns an array of sidebar position options registered for waht
 *
 * @return mixed|void
 */
function waht_sidebar_positions() {
	$sidebar_position_options = array(
		'right' => array(
			'value' => 'right',
			'label' => __('On the right', 'waht')
		),
		'left'  => array(
			'value' => 'left',
			'label' => __('On the left', 'waht')
		),
		'none'  => array(
			'value' => 'none',
			'label' => __('No sidebar', 'waht')
		)
	);
	return apply_filters('waht_sidebar_positions', $sidebar_position_options);
}

/**
 * Renders the SEO options section
 */
function waht_settings_section_seo() {
	?>
<p class="description"><?php _e('Settings for a better SEO', 'waht'); ?></p>
<?php
}

/**
 * Renders a text field to enter the Google Analytics ID
 */
function waht_settings_field_google_analytics_id() {
	$waht_options = waht_get_theme_options(); ?>
<input type="text" name="waht_theme_options[google_analytics_id]" id="waht_google_analytics_id"
       value="<?php echo esc_attr($waht_options['google_analytics_id']); ?>" placeholder="UA-XXX-Y">
<label for="waht_google_analytics_id" class="description"><?php _e('Give your Google Analytics ID', 'waht'); ?></label>
<?php
}

/**
 * Renders the responsive options section
 */
function waht_settings_section_responsive() {

}

/**
 * Renders a text field to enter the apple icons folder's path
 */
function waht_settings_field_apple_icons() {
	$waht_options = waht_get_theme_options();
	?>
<input type="text" name="waht_theme_options[apple_icons_path]" id="waht_apple_icons_path"
       value="<?php echo esc_attr($waht_options['apple_icons_path']); ?>">
<label for="waht_apple_icons_path"
       class="description"><?php _e('Enter the path to the folder containing for images for Apple icons', 'waht'); ?></label>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function waht_theme_options_validate($input) {
	$output = $defaults = waht_get_default_theme_options();

	// TODO (a.h) The Google Analytics ID must be valid (begins wuth "UA-"
	if (isset($input['google_analytics_id']) && strpos($input['google_analytics_id'], 'UA-') == 0)
		$output['google_analytics_id'] = $input['google_analytics_id'];

	// TODO (a.h) The Apple icons folder's path
	if (isset($input['apple_icons_path']))
		$output['apple_icons_path'] = $input['apple_icons_path'];

	// The sidebar position must be in our array of theme layout option
	if (isset($input['sidebar_position']) && array_key_exists($input['sidebar_position'], waht_sidebar_positions()))
		$output['sidebar_position'] = $input['sidebar_position'];

	return apply_filters('waht_theme_options_validate', $output, $input, $defaults);
}

/**
 * Returns the default theme options
 *
 * @return mixed|void
 */
function waht_get_default_theme_options() {
	$default_theme_options = array(
		'google_analytics_id' => '',
		'apple_icons_path'    => get_template_directory_uri() . '/assets/img/ios/',
		'sidebar_position'    => 'right'
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
 * Enqueue own stylesheet and script file for the heme options page
 *
 * @param $hook_suffix
 */
function waht_admin_enqueue_scripts($hook_suffix) {
	wp_enqueue_style('waht-theme-options', get_template_directory_uri() . '/assets/css/theme-options.css');
	wp_enqueue_script('waht-theme-options', get_template_directory_uri() . '/assets/js/theme-options.min.js');
}

add_action('admin_print_styles-appearance_page_theme_options', 'waht_admin_enqueue_scripts');

/**
 * Displays credential on admin footer
 */
function waht_admin_footer() {
	$credentials = '<span class="footer-thanks">' . waht_credentials() . '</span>';
	$credentials .= ' - ' . __('Build using', 'waht') . ' <a href="https://github.com/Othella/waht" title="waht on GitHub" target="_blank">waht</a>';
	echo $credentials;
}

add_filter('admin_footer_text', 'waht_admin_footer');