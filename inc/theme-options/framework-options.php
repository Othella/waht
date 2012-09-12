<?php
/**
 * @description: Theme options Framework section in admin panel
 * @name       : inc/theme-options/framework-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// Register the options for the framework
function waht_framework_options_init() {

	// If the options don't exist, create them.
	if (false == get_option('waht_framework_options')) {
		add_option('waht_framework_options');
	}

	// Register the $waht_array for our options
	register_setting(
		'waht_framework_options', // Options name
		'waht_framework_options', // Option group
		'waht_sanitize_framework_options' //Sanitize callback TODO (a.h)
	);

	// Register the framework options field group
	add_settings_section(
		'framework_section', // ID used to identify this section and with which to register options
		__('Framework Settings', 'waht'), // Title to be displayed on the administration page
		'waht_framework_section_callback', // Callback used to render the description of the section
		'waht_framework_options'// Page on which to add this section of options
	);

	// Register the sidebar position settings field
	add_settings_field(
		'framework_name',
		__('Framework Name', 'waht'),
		'waht_change_framework_name_callback',
		'waht_framework_options',
		'framework_section',
		array(
			'description' => __('Select the framework you want to use', 'waht')
		)
	);
}


/**
 * Renders the framework settings section
 */
function waht_framework_section_callback() {
	echo '<p class="description">' . __('Settings for the framework to use', 'waht') . '</p>';
}

/**
 * Renders the framework name settings field
 */
function waht_change_framework_name_callback($args) {
	$framework_options      = waht_get_framework_options();
	$framework_name_options = waht_framework_names(); ?>
<select name="waht_framework_options[framework_name]" id="waht_framework_options_framework_name">
	<?php foreach ($framework_name_options as $name_option) : ?>
    <option value="<?php echo $name_option['value'] ?>"<?php selected($framework_options['framework_name'], $name_option['value']); ?>><?php echo $name_option['label']; ?></option>
	<?php endforeach ?>
</select>
<label for="waht_framework_options_framework_name" class="description"><?php echo $args['description']; ?></label>
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
			'label' => __('Do not use any framework', 'waht')
		)
	);
	return apply_filters('waht_framework_names', $framework_name_options);
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function waht_sanitize_framework_options($input) {
	$output = $defaults = waht_get_default_framework_options();

	// The framework name must be in our array of framework option
	if (isset($input['framework_name']) && array_key_exists($input['framework_name'], waht_framework_names()))
		$output['framework_name'] = sanitize_text_field($input['framework_name']);

	return apply_filters('waht_sanitize_framework_options', $output, $input, $defaults);
}

/**
 * Returns the default framework options
 *
 * @return mixed|void
 */
function waht_get_default_framework_options() {
	$default_framework_options = array(
		'framework_name'    => 'bootstrap' // 'bootstrap', 'h5bp', 'foundation' or 'none'
	);
	return apply_filters('waht_get_default_framework_options', $default_framework_options);

}

/**
 * Returns the framework options array
 *
 * @return mixed|void
 */
function waht_get_framework_options() {
	return get_option('waht_framework_options', waht_get_default_framework_options());
}