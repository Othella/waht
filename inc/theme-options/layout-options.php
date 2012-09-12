<?php
/**
 * @description: Theme options layout section in admin panel
 * @name       : inc/theme-options/layout-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// Register the options for the layout
function waht_layout_options_init() {

	// If the options don't exist, create them.
	if (false == get_option('waht_layout_options')) {
		add_option('waht_layout_options');
	}

	// Register the $waht_array for our options
	register_setting(
		'waht_layout_options', // Options name
		'waht_layout_options', // Option group
		'waht_sanitize_layout_options' //Sanitize callback TODO (a.h)
	);

	// Register the layout options field group
	add_settings_section(
		'layout_section',
		__('Layout Settings', 'waht'),
		'waht_layout_options_section_callback',
		'waht_layout_options'
	);

	// Register the sidebar position settings field
	add_settings_field(
		'sidebar_position',
		__('Sidebar Position', 'waht'),
		'waht_change_sidebar_position_callback',
		'waht_layout_options',
		'layout_section',
		array(
			'description' => __('Select on which side you want to display your sidebar', 'waht')
		)
	);

	// Register the fluid layout setting field
	add_settings_field(
		'fluid',
		__('Fluid Layout', 'waht'),
		'waht_toggle_fluid_callback',
		'waht_layout_options',
		'layout_section',
		array(
			'description' => __('Use a fluid layout', 'waht')
		)
	);

	// Register the use of navbar settings field
	add_settings_field(
		'navbar',
		__('Navigation', 'waht'),
		'waht_toggle_navbar_callback',
		'waht_layout_options',
		'layout_section',
		array(
			'description' => __('Use navbars for the navigation', 'waht')
		)
	);

	// Register the use of a top-fixed navigation settings field
	add_settings_field(
		'top_fixed_nav',
		__('Main navigation', 'waht'),
		'waht_toggle_top_fixed_nav_callback',
		'waht_layout_options',
		'layout_section',
		array(
			'description' => __('Use a top-fixed main navigation', 'waht')
		)
	);
}

/**
 * Renders the layout options section
 */
function waht_layout_options_section_callback() {
	echo '<p class="description">' . __('Settings for the theme layout', 'waht') . '</p>';
}

/**
 * Renders the sidebar position select option field
 */
function waht_change_sidebar_position_callback($args) {
	$waht_layout_options      = waht_get_layout_options();
	$sidebar_position_options = waht_sidebar_positions();?>
<select name="waht_layout_options[sidebar_position]" id="waht_layout_options[sidebar_position]">
	<?php foreach ($sidebar_position_options as $option) : ?>
    <option value="<?php echo $option['value'] ?>"<?php selected($waht_layout_options['sidebar_position'], $option['value'])?>><?php echo $option['label']; ?></option>
	<?php endforeach; ?>
</select>
<label for="waht_layout_options[sidebar_position]" class="description"><?php echo $args['description']; ?></label>
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
 * Renders the fluid layout settings field
 */
function waht_toggle_fluid_callback($args) {
	$waht_layout_options = waht_get_layout_options();
	?>
<input type="checkbox" id="waht_layout_options[fluid]" name="waht_layout_options[fluid]"
       value="1"<?php checked(true, $waht_layout_options['fluid']); ?> />
<label for="waht_layout_options[fluid]"
       class="description"><?php echo $args['description']; ?></label>
<?php
}

/**
 * Renders the use of navbar settings field
 */
function waht_toggle_navbar_callback($args) {
	$waht_layout_options = waht_get_layout_options();
	?>
<input type="checkbox" id="waht_layout_options[navbar]" name="waht_layout_options[navbar]"
       value="1"<?php checked(true, $waht_layout_options['navbar']); ?> />
<label for="waht_layout_options[navbar]"
       class="description"><?php echo $args['description']; ?></label>
<?php
}

/**
 * Renders the use of a top-fixed navbar settings field
 */
function waht_toggle_top_fixed_nav_callback($args) {
	$waht_layout_options = waht_get_layout_options();
	?>
<input type="checkbox" id="waht_layout_options[top_fixed_nav]" name="waht_layout_options[top_fixed_nav]"
       value="1"<?php checked(true, $waht_layout_options['top_fixed_nav']); ?> />
<label for="waht_layout_options[top_fixed_nav]"
       class="description"><?php echo $args['description']; ?></label>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function waht_sanitize_layout_options($input) {
	$output = $defaults = waht_get_default_layout_options();

	// The sidebar position must be in our array of theme layout option
	if (isset($input['sidebar_position']) && array_key_exists($input['sidebar_position'], waht_sidebar_positions()))
		$output['sidebar_position'] = $input['sidebar_position'];

	// The fluid option is either true or false
	if (!isset($input['fluid'])) $input['fluid'] = null;
	$output['fluid'] = ($input['fluid'] == '1') ? true : false;

	// The navbar option is either true or false
	if (!isset($input['navbar'])) $input['navbar'] = null;
	$output['navbar'] = ($input['navbar'] == '1') ? true : false;

	// The top-fixed nav option is either true or false
	if (!isset($input['top_fixed_nav'])) $input['top_fixed_nav'] = null;
	$output['top_fixed_nav'] = ($input['top_fixed_nav'] == '1') ? true : false;

	return apply_filters('waht_sanitize_layout_options', $output, $input, $defaults);
}

/**
 * Returns the default layout theme options
 *
 * @return mixed|void
 */
function waht_get_default_layout_options() {
	$default_layout_options = array(
		'sidebar_position'    => 'right',
		'fluid'               => true, // true = enabled, false = not enabled
		'navbar'              => true, // true = enabled, false = not enabled
		'top_fixed_nav'       => true // true = enabled, false = not enabled
	);
	if (is_rtl())
		$default_layout_options['sidebar_position'] = 'left';
	return apply_filters('waht_get_default_layout_options', $default_layout_options);
}

/**
 * Returns the layout options array
 *
 * @return mixed|void
 */
function waht_get_layout_options() {
	return get_option('waht_layout_options', waht_get_default_layout_options());
}