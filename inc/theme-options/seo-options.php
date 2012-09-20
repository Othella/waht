<?php
/**
 * @description: Theme options SEO section in admin panel
 * @name       : inc/theme-options/seo-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// Register the options for the SEO
function waht_seo_options_init() {

	// If the options don't exist, create them.
	if (false == get_option('waht_seo_options')) {
		add_option('waht_seo_options', waht_get_default_seo_options());
	}

	// Register the $waht_array for our options
	register_setting(
		'waht_seo_options', // Options name
		'waht_seo_options', // Option group
		'waht_sanitize_seo_options' //Sanitize callback TODO (a.h)
	);

	// Register the SEO options field group
	add_settings_section(
		'seo_section', // Section unique identifier
		__('SEO (Search Engines Optimization) Settings', 'waht'),
		'waht_seo_options_section_callback',
		'waht_seo_options'
	);

	// Register Google Analytics settings field
	add_settings_field(
		'google_analytics_id',
		__('Google Analytics ID', 'waht'),
		'waht_change_google_analytics_id_callback',
		'waht_seo_options',
		'seo_section',
		array(
			'description' => __('Give your Google Analytics ID', 'waht')
		)
	);

}

/**
 * Renders the SEO options section
 */
function waht_seo_options_section_callback() {
	echo '<p class="description">' . __('Settings for a better SEO', 'waht') . '</p>';
}

/**
 * Renders a text field to enter the Google Analytics ID
 */
function waht_change_google_analytics_id_callback($args) {
	$waht_seo_options = waht_get_seo_options(); ?>
<input type="text" name="waht_seo_options[google_analytics_id]" id="waht_seo_options[google_analytics_id]"
       value="<?php echo sanitize_text_field($waht_seo_options['google_analytics_id']); ?>" placeholder="UA-XXX-Y">
<label for="waht_seo_options[google_analytics_id]" class="description"><?php echo $args['description'] ?></label>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function waht_sanitize_seo_options($input) {
	$output = $defaults = waht_get_default_seo_options();

	// TODO (a.h) The Google Analytics ID must be valid (begins wuth "UA-"
	if (isset($input['google_analytics_id']))// && strpos($input['google_analytics_id'], 'UA-') == 0)
		$output['google_analytics_id'] = $input['google_analytics_id'];

	return apply_filters('waht_sanitize_seo_options', $output, $input, $defaults);
}

/**
 * Returns the default SEO options
 *
 * @return mixed|void
 */
function waht_get_default_seo_options() {
	$default_seo_options = array(
		'google_analytics_id'    => ''
	);
	return apply_filters('waht_get_default_seo_options', $default_seo_options);

}

/**
 * Returns the SEO options array
 *
 * @return mixed|void
 */
function waht_get_seo_options() {
	return get_option('waht_seo_options', waht_get_default_seo_options());
}
