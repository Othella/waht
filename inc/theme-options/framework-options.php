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
		add_option('waht_framework_options', waht_get_default_framework_options());
	}

	// Register the $waht_framework_options array for our options
	register_setting(
		'waht_display_options', // Options group
		'waht_framework_options', // Option name
		'waht_sanitize_framework_options' //Sanitize callback TODO (a.h)
	);

	// Register the framework options field group
	add_settings_section(
		'framework_section', // ID used to identify this section and with which to register options
		__('Framework Settings', 'waht'), // Title to be displayed on the administration page
		'waht_framework_section_callback', // Callback used to render the description of the section
		'waht_display_options'// Page on which to add this section of options
	);

	// Register the sidebar position settings field
	add_settings_field(
		'framework_name',
		__('Framework Name', 'waht'),
		'waht_change_framework_name_callback',
		'waht_display_options',
		'framework_section',
		array(
			'description' => __('Select the framework you want to use', 'waht')
		)
	);

	// Register the wrapper classes settings field
	add_settings_field(
		'wrapper_classes',
		__('Wrapper Class(es)', 'waht'),
		'waht_change_wrapper_classes_callback',
		'waht_display_options',
		'framework_section',
		array(
			'description' => __('Enter the class(es) your want to use for the global wrapper', 'waht')
		)
	);

	// Register the container classes settings field
	add_settings_field(
		'container_classes',
		__('Containers Class(es)', 'waht'),
		'waht_change_container_classes_callback',
		'waht_display_options',
		'framework_section',
		array(
			'description' => __('Enter the class(es) your want to use for the containers', 'waht')
		)
	);

	// Register the main section classes settings field
	add_settings_field(
		'main_section_classes',
		__('Main Section Class(es)', 'waht'),
		'waht_change_main_section_classes_callback',
		'waht_display_options',
		'framework_section',
		array(
			'description' => __('Enter the class(es) your want to use for the main content section', 'waht')
		)
	);

	if (waht_has_main_sidebar()) :
		// Register the main sidebar classes settings field
		add_settings_field(
			'main_sidebar_classes',
			__('Main Sidebar Class(es)', 'waht'),
			'waht_change_main_sidebar_classes_callback',
			'waht_display_options',
			'framework_section',
			array(
				'description' => __('Enter the class(es) your want to use for the main sidebar', 'waht')
			)
		);
	endif;

	// Register the footer sidebars classes settings field
	add_settings_field(
		'footer_sidebar_classes',
		__('Footer Sidebars Class(es)', 'waht'),
		'waht_change_footer_sidebar_classes_callback',
		'waht_display_options',
		'framework_section',
		array(
			'description' => __('Enter the class(es) your want to use for the footer sidebars', 'waht')
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
 *
 * @param $args array An array of arguments
 */
function waht_change_framework_name_callback($args) {
	$framework_options      = waht_get_framework_options();
	$framework_name_options = waht_framework_names(); ?>
<select name="waht_framework_options[framework_name]" id="waht_framework_options_framework_name" onchange="actualizeClasses();">
	<?php foreach ($framework_name_options as $name_option) : ?>
    <option value="<?php echo $name_option['value'] ?>"<?php selected($framework_options['framework_name'], $name_option['value']); ?>><?php echo $name_option['label']; ?></option>
	<?php endforeach ?>
</select>
<label for="waht_framework_options_framework_name" class="description"><?php echo $args['description']; ?></label>

<script type="text/javascript">
    /**
     * Actualize values in inputs for classes depending on selected framework and fluidity behavior
     */
    function actualizeClasses() {
        var $selected_framework = jQuery('#waht_framework_options_framework_name').val();
        var $main_section = jQuery('#waht_framework_options_main_section_classes');
        var $main_sidebar = jQuery('#waht_framework_options_main_sidebar_classes');
        var $footer_sidebar = jQuery('#waht_framework_options_footer_sidebar_classes');
        if ($selected_framework == 'bootstrap') {
            $main_section.val('<?php echo waht_default_main_section_class('bootstrap'); ?>');
            $main_sidebar.val('<?php echo waht_default_main_sidebar_class('bootstrap'); ?>');
            $footer_sidebar.val('<?php echo waht_default_footer_sidebar_class('bootstrap'); ?>');
        } else if ($selected_framework == 'h5bp') {
            $main_section.val('<?php echo waht_default_main_section_class('h5bp'); ?>');
            $main_sidebar.val('<?php echo waht_default_main_sidebar_class('h5bp'); ?>');
            $footer_sidebar.val('<?php echo waht_default_footer_sidebar_class('h5bp'); ?>');
        } else if ($selected_framework == 'foundation') {
            $main_section.val('<?php echo waht_default_main_section_class('foundation'); ?>');
            $main_sidebar.val('<?php echo waht_default_main_sidebar_class('foundation'); ?>');
            $footer_sidebar.val('<?php echo waht_default_footer_sidebar_class('foundation'); ?>');
        } else {
            $main_section.val('<?php echo waht_default_main_section_class(); ?>');
            $main_sidebar.val('<?php echo waht_default_main_sidebar_class(); ?>');
            $footer_sidebar.val('<?php echo waht_default_footer_sidebar_class(); ?>');
        }
        var $cb_fluid = jQuery('#waht_layout_options_fluid');
        var $wrapper = jQuery('#waht_framework_options_wrapper_classes');
        var $container = jQuery('#waht_framework_options_container_classes');
        var use_fluid = ($cb_fluid.length > 0) ? ($cb_fluid.attr('checked') == 'checked') : null;
        if (use_fluid == true) {
            if ($selected_framework == 'bootstrap') {
                $wrapper.val('<?php echo waht_default_wrapper_class('bootstrap', true); ?>');
                $container.val('<?php echo waht_default_container_class('bootstrap', true); ?>');
            } else if ($selected_framework == 'h5bp') {
                $wrapper.val('<?php echo waht_default_wrapper_class('h5bp', true); ?>');
                $container.val('<?php echo waht_default_container_class('h5bp', true); ?>');
            } else if ($selected_framework == 'foundation') {
                $wrapper.val('<?php echo waht_default_wrapper_class('foundation', true); ?>');
                $container.val('<?php echo waht_default_container_class('foundation', true); ?>');
            } else {
                $wrapper.val('<?php echo waht_default_wrapper_class('', true); ?>');
                $container.val('<?php echo waht_default_container_class('', true); ?>');
            }
        } else if (use_fluid == false) {
            if ($selected_framework == 'bootstrap') {
                $wrapper.val('<?php echo waht_default_wrapper_class('bootstrap', false); ?>');
                $container.val('<?php echo waht_default_container_class('bootstrap', false); ?>');
            } else if ($selected_framework == 'h5bp') {
                $wrapper.val('<?php echo waht_default_wrapper_class('h5bp', false); ?>');
                $container.val('<?php echo waht_default_container_class('h5bp', false); ?>');
            } else if ($selected_framework == 'foundation') {
                $wrapper.val('<?php echo waht_default_wrapper_class('foundation', false); ?>');
                $container.val('<?php echo waht_default_container_class('foundation', false); ?>');
            } else {
                $wrapper.val('<?php echo waht_default_wrapper_class('', false); ?>');
                $container.val('<?php echo waht_default_container_class('', false); ?>');
            }
        } else {
            if ($selected_framework == 'bootstrap') {
                $wrapper.val('<?php echo waht_default_wrapper_class('bootstrap'); ?>');
                $container.val('<?php echo waht_default_container_class('bootstrap'); ?>');
            } else if ($selected_framework == 'h5bp') {
                $wrapper.val('<?php echo waht_default_wrapper_class('h5bp'); ?>');
                $container.val('<?php echo waht_default_container_class('h5bp'); ?>');
            } else if ($selected_framework == 'foundation') {
                $wrapper.val('<?php echo waht_default_wrapper_class('foundation'); ?>');
                $container.val('<?php echo waht_default_container_class('foundation'); ?>');
            } else {
                $wrapper.val('<?php echo waht_default_wrapper_class(''); ?>');
                $container.val('<?php echo waht_default_container_class(''); ?>');
            }
        }
    }
</script>
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
		'foundation'  => array(
			'value' => 'foundation',
			'label' => __('Foundation 3', 'waht')
		),
		'h5bp'        => array(
			'value' => 'h5bp',
			'label' => __('HTML5 Boilerplate', 'waht')
		),
		'none'        => array(
			'value' => 'none',
			'label' => __('Do not use any framework', 'waht')
		)
	);
	return apply_filters('waht_framework_names', $framework_name_options);
}

/**
 * Renders the wrapper classes field
 *
 * @param $args array An array of arguments
 */
function waht_change_wrapper_classes_callback($args) {
	$framework_options = waht_get_framework_options(); ?>
<input type="text" name="waht_framework_options[wrapper_classes]" id="waht_framework_options_wrapper_classes"
       value="<?php echo $framework_options['wrapper_classes']; ?>"/>
<label for="waht_framework_options_wrapper_classes" class="description"><?php echo $args['description']; ?></label>
<?php
}


/**
 * Renders the containers classes field
 *
 * @param $args array An array of arguments
 */
function waht_change_container_classes_callback($args) {
	$framework_options = waht_get_framework_options(); ?>
<input type="text" name="waht_framework_options[container_classes]" id="waht_framework_options_container_classes"
       value="<?php echo $framework_options['container_classes']; ?>"/>
<label for="waht_framework_options_container_classes" class="description"><?php echo $args['description']; ?></label>
<?php
}


/**
 * Renders the main section classes field
 *
 * @param $args array An array of arguments
 */
function waht_change_main_section_classes_callback($args) {
	$framework_options = waht_get_framework_options(); ?>
<input type="text" name="waht_framework_options[main_section_classes]" id="waht_framework_options_main_section_classes"
       value="<?php echo $framework_options['main_section_classes']; ?>"/>
<label for="waht_framework_options_main_section_classes" class="description"><?php echo $args['description']; ?></label>
<?php
}


/**
 * Renders the main sidebar classes field
 *
 * @param $args array An array of arguments
 */
function waht_change_main_sidebar_classes_callback($args) {
	$framework_options = waht_get_framework_options(); ?>
<input type="text" name="waht_framework_options[main_sidebar_classes]" id="waht_framework_options_main_sidebar_classes"
       value="<?php echo $framework_options['main_sidebar_classes']; ?>"/>
<label for="waht_framework_options_main_sidebar_classes" class="description"><?php echo $args['description']; ?></label>
<?php
}


/**
 * Renders the footer sidebar classes field
 *
 * @param $args array An array of arguments
 */
function waht_change_footer_sidebar_classes_callback($args) {
	$framework_options = waht_get_framework_options(); ?>
<input type="text" name="waht_framework_options[footer_sidebar_classes]" id="waht_framework_options_footer_sidebar_classes"
       value="<?php echo $framework_options['footer_sidebar_classes']; ?>"/>
<label for="waht_framework_options_footer_sidebar_classes" class="description"><?php echo $args['description']; ?></label>
<?php
}

/**
 * Returns the default class of the main wrapper
 *
 * @param string $framework
 *
 * @param bool   $fluid (Optional) Force fluid layout
 *
 * @return string
 */
function waht_default_wrapper_class($framework = '', $fluid = null) {
	if (!isset($fluid)) $fluid = waht_use_fluid_layout();
	return ($fluid == true) ? 'container-fluid' : 'container';
}

/**
 * Returns default classes of the containers
 *
 * @param string $framework
 *
 * @param bool   $fluid (Optional) Force fluid layout
 *
 * @return string
 */
function waht_default_container_class($framework = '', $fluid = null) {
	if (!isset($fluid)) $fluid = waht_use_fluid_layout();
	return ($framework == 'bootstrap' && $fluid == true) ? 'row-fluid' : 'row';
}


/**
 * Returns the default class of the main section
 *
 * @param string $framework
 *
 * @return string
 */
function waht_default_main_section_class($framework = '') {
	return ($framework == 'foundation') ?
		(waht_has_main_sidebar() ? 'eight columns' : 'twelve columns') :
		(waht_has_main_sidebar() ? 'span8' : 'span12');
}

/**
 * Returns the default class of the main sidebar
 *
 * @param string $framework
 *
 * @return string
 */
function waht_default_main_sidebar_class($framework = '') {
	return ($framework == 'foundation') ? 'four columns' : 'span4';
}

/**
 * Returns the default class of the footer sidebars
 *
 * @param string $framework
 *
 * @return string
 */
function waht_default_footer_sidebar_class($framework = '') {
	return ($framework == 'foundation') ? 'four columns' : 'span4';
}


/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function waht_sanitize_framework_options($input) {
	$output = $defaults = waht_get_default_framework_options();

	if (!isset($_POST['reset'])) :

		// The framework name must be in our array of framework option
		if (isset($input['framework_name']) && array_key_exists($input['framework_name'], waht_framework_names()))
			$output['framework_name'] = sanitize_text_field($input['framework_name']);

		if (isset($input['wrapper_classes']))
			$output['wrapper_classes'] = sanitize_text_field($input['wrapper_classes']);

		if (isset($input['container_classes']))
			$output['container_classes'] = sanitize_text_field($input['container_classes']);

		if (isset($input['main_section_classes']))
			$output['main_section_classes'] = sanitize_text_field($input['main_section_classes']);

		if (isset($input['main_sidebar_classes']))
			$output['main_sidebar_classes'] = sanitize_text_field($input['main_sidebar_classes']);

		if (isset($input['footer_sidebar_classes']))
			$output['footer_sidebar_classes'] = sanitize_text_field($input['footer_sidebar_classes']);

	endif;

	return apply_filters('waht_sanitize_framework_options', $output, $input, $defaults);
}

/**
 * Returns the default framework options
 *
 * @return mixed|void
 */
function waht_get_default_framework_options() {
	$default_framework         = 'bootstrap'; // 'bootstrap', 'h5bp', 'foundation' or 'none'
	$default_framework_options = array(
		'framework_name'           => $default_framework,
		'wrapper_classes'          => waht_default_wrapper_class($default_framework),
		'container_classes'        => waht_default_container_class($default_framework),
		'main_section_classes'     => waht_default_main_section_class($default_framework),
		'main_sidebar_classes'     => waht_default_main_sidebar_class($default_framework),
		'footer_sidebar_classes'   => waht_default_footer_sidebar_class($default_framework)
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