<?php
/**
 * @description: Theme options in admin panel
 * @name       : inc/theme-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Register the form settings for our waht_options array
 */
function waht_theme_options_init() {
	// Register the waht theme options settings
	register_setting(
		'waht_options',
		'waht_theme_options',
		'waht_theme_options_validate'
	);

	// Register the framework options field group
	add_settings_section(
		'framework',
		__('Framework', 'waht'),
		'waht_settings_section_framework',
		'theme_options'
	);

	// Register the sidebar position settings field
	add_settings_field(
		'framework_name',
		__('Framework Name', 'waht'),
		'waht_settings_field_framework_name',
		'theme_options',
		'framework'
	);

	// Register the layout options field group
	add_settings_section(
		'layout',
		__('Layout', 'waht'),
		'waht_settings_section_layout',
		'theme_options'
	);

	// Register the sidebar position settings field
	add_settings_field(
		'sidebar_position',
		__('Sidebar Position', 'waht'),
		'waht_settings_field_sidebar_position',
		'theme_options',
		'layout'
	);

	// Register the SEO options field group
	add_settings_section(
		'seo', // Section unique identifier
		__('SEO (Search Engines Optimization)', 'waht'),
		'waht_settings_section_seo',
		'theme_options'
	);

	// Register Google Analytics settings field
	add_settings_field(
		'google_analytics_id',
		__('Google Analytics ID', 'waht'),
		'waht_settings_field_google_analytics_id',
		'theme_options',
		'seo'
	);

	// Register the responsive options field group
	add_settings_section(
		'responsive',
		__('Responsive Options', 'waht'),
		'waht_settings_section_responsive',
		'theme_options'
	);

	// Register using responsive layout settings field
	add_settings_field(
		'responsive',
		__('Use Responsive', 'waht'),
		'waht_settings_field_responsive',
		'theme_options',
		'responsive'
	);

	// Register Apple icons settings field
	add_settings_field(
		'apple_icons',
		__('Apple Icons', 'waht'),
		'waht_settings_field_apple_icons',
		'theme_options',
		'responsive'
	);
}

add_action('admin_init', 'waht_theme_options_init');

/**
 * Add the theme options page to the admin menu, including some help documentation.
 */
function waht_theme_options_add_page() {
	$theme_page = add_theme_page(
		sprintf(__('%s Theme Options', 'waht'), waht_get_theme_name()), // Name of the theme options' page
		sprintf(__('%s Theme Options', 'waht'), waht_get_theme_name()), // Label in menu
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
    <h2><?php printf(__('%s Theme Options', 'waht'), waht_get_theme_name()); ?></h2>
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
<?php
}

function waht_settings_section_framework() {
	echo '<p class="description">' . __('Settings for the framework to use', 'waht') . '</p>';
}

function waht_settings_field_framework_name() {
	$waht_options           = waht_get_theme_options();
	$selected_framework     = $waht_options['framework_name'];
	$framework_name_options = waht_framework_names();?>
<select name="waht_theme_options[framework_name]" id="waht_framework_name">
	<?php foreach ($framework_name_options as $option) :
	?>
    <option value="<?php echo $option['value'] ?>"<?php selected($selected_framework, $option['value']); ?>><?php echo $option['label']; ?></option>
	<?php endforeach ?>
</select>
<label for="waht_framework_name" class="description"><?php _e('Select the framework you want to use', 'waht'); ?></label>
<?php
}

/**
 * Returns an array of framework names options registered for waht
 *
 * @return mixed|void
 */
function waht_framework_names() {
	$framework_name_options = array(
		'bootstrap'   => array(
			'value' => 'bootstrap',
			'label' => __('Twitter Bootstrap', 'waht')
		),
		'h5bp'        => array(
			'value' => 'h5bp',
			'label' => __('HTML5 Boilerplate', 'waht')
		),
		'foundation'  => array(
			'value' => 'foundation',
			'label' => __('Foundation 3', 'waht')
		),
		'none'        => array(
			'value' => 'none',
			'label' => __('Don\'t use any framework', 'waht')
		)
	);
	return apply_filters('waht_framework_names', $framework_name_options);
}

/**
 * Renders the layout options section
 */
function waht_settings_section_layout() {
	echo '<p class="description">' . __('Settings for the theme layout', 'waht') . '</p>';
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
	?>
    <option value="<?php echo $option['value'] ?>"<?php echo selected($selected_position, $option['value'])?>><?php echo $option['label']; ?></option>
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
	echo '<p class="description">' . __('Settings for a better SEO', 'waht') . '</p>';
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
	echo '<p class="description">' . __('Settings for the responsive behavior', 'waht') . '</p>';
}

function waht_settings_field_responsive() {
	$waht_options = waht_get_theme_options();
	?>
<input type="checkbox" id="waht_use_responsive" name="waht_theme_options[responsive]" value="true" <?php checked(true,
	$waht_options['responsive'])?>>
<label for="waht_use_responsive"
       class="description"><?php _e('Check this box if you want to make your theme responsive', 'waht'); ?></label>
<?php
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

	// The responsive option is a boolean
	if (isset($input['responsive']) && is_bool($input['responsive']))
		$output['responsive'] = $input['responsive'];
	// TODO (a.h) Debug responsivity!

	// The framework name must be in our array of framework option
	if (isset($input['framework_name']) && array_key_exists($input['framework_name'], waht_framework_names()))
		$output['framework_name'] = $input['framework_name'];

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
		'sidebar_position'    => 'right',
		'framework_name'      => 'bootstrap',
		'responsive'          => true
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