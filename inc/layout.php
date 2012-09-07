<?php
/**
 * @description: Site layout customization
 * @name       : inc/layout.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Registers our sidebars
 */
function waht_register_sidebars() {
	$widget_class       = 'widget';
	$widget_title_class = 'widgettitle';

	// The main sidebar
	register_sidebar(array(
		'id'            => 'sidebar-main',
		'name'          => __('Main Sidebar', 'waht'),
		'description'   => __('The main sidebar', 'waht'),
		'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="' . $widget_title_class . '">',
		'after_title'   => '</h3>',
	));

	// The 3 footer sidebars
	register_sidebar(array(
		'id'            => 'sidebar-footer-left',
		'name'          => __('Left Footer Sidebar', 'waht'),
		'description'   => __('The left footer sidebar', 'waht'),
		'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="' . $widget_title_class . '">',
		'after_title'   => '</h3>',
	));
	register_sidebar(array(
		'id'            => 'sidebar-footer-center',
		'name'          => __('Center Footer Sidebar', 'waht'),
		'description'   => __('The center footer sidebar', 'waht'),
		'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="' . $widget_title_class . '">',
		'after_title'   => '</h3>',
	));
	register_sidebar(array(
		'id'            => 'sidebar-footer-right',
		'name'          => __('Right Footer Sidebar', 'waht'),
		'description'   => __('The right footer sidebar', 'waht'),
		'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="' . $widget_title_class . '">',
		'after_title'   => '</h3>',
	));
}

/**
 * Initializes our widgets
 */
function waht_widgets_init() {
	waht_register_sidebars();
}

add_action('widgets_init', 'waht_widgets_init');

/**
 * Returns weather if the current template has to display the main sidebar
 *
 * @return bool
 */
function waht_has_main_sidebar() {
	$waht_options = waht_get_theme_options();
	if ($waht_options['sidebar_position'] == 'none' || is_page_template('page-fullwidth.php'))
		return false;
	else
		return true;
}

/**
 * Returns the classes of the main section
 *
 * @return string
 */
function waht_main_section_classes() {
	$main_classes = '';
	if (waht_use_bootstrap_framework()) :
		$main_classes .= waht_has_main_sidebar() ? 'span8' : 'span12';
	elseif (waht_use_h5bp_framework()) :
		$main_classes .= waht_has_main_sidebar() ? 'span8' : 'span12';
	elseif (waht_use_foundation_framework()) :
		$main_classes .= waht_has_main_sidebar() ? 'eight columns' : 'twelve columns';
	endif;
	if (waht_has_left_main_sidebar())
		$main_classes .= ' pull-right';
	elseif (waht_has_right_main_sidebar())
		$main_classes .= ' pull-left';
	echo $main_classes;
}

/**
 * Returns the classes of the main sidebar
 *
 * @return string
 */
function waht_sidebar_classes() {
	$sidebar_classes = '';
	if (waht_use_bootstrap_framework()) :
		$sidebar_classes .= 'span4';
	elseif (waht_use_h5bp_framework()) :
		$sidebar_classes .= 'span4';
	elseif (waht_use_foundation_framework()) :
		$sidebar_classes .= 'four columns';
	endif;
	if (waht_has_left_main_sidebar())
		$sidebar_classes .= ' pull-left';
	elseif (waht_has_right_main_sidebar())
		$sidebar_classes .= ' pull-right';
	echo $sidebar_classes;
}

/**
 * Returns the class of the main wrapper
 *
 * @return string
 */
function waht_wrapper_classes() { // TODO (a.h) Code waht_wrapper_classes()
	$wrapper_classes = '';
	if (waht_use_bootstrap_framework()) :
		$wrapper_classes .= 'container';
	elseif (waht_use_h5bp_framework()) :
		$wrapper_classes .= '';
	elseif (waht_use_foundation_framework()) :
		$wrapper_classes .= 'row';
	endif;
	return $wrapper_classes;
}

/**
 * Returns the class of the containers
 *
 * @return string
 */
function waht_container_classes() { // TODO (a.h) Code waht_container_classes()
	$container_classes = '';
	if (waht_use_bootstrap_framework()) :
		if (waht_use_fluid_layout())
			$container_classes .= 'row-fluid';
		else
			$container_classes .= 'row';
	elseif (waht_use_h5bp_framework()) :
		$container_classes .= 'row';
	elseif (waht_use_foundation_framework()) :
		$container_classes .= 'row';
	endif;
	return $container_classes;
}

/**
 * Returns true if the main sidebar has to be displayed on the left
 *
 * @return bool
 */
function waht_has_left_main_sidebar() {
	$waht_options = waht_get_theme_options();
	return ($waht_options['sidebar_position'] == 'left');
}


/**
 * Returns true if the main sidebar has to be displayed on the right
 *
 * @return bool
 */
function waht_has_right_main_sidebar() {
	$waht_options = waht_get_theme_options();
	return ($waht_options['sidebar_position'] == 'right');
}

/**
 * Returns true if we use a framework
 *
 * @return bool
 */
function waht_use_framework() {
	$waht_options = waht_get_theme_options();
	return ($waht_options['framework_name'] != 'none');
}

/**
 * Returns true if we use the Twitter Bootstrap framework
 *
 * @return bool
 */
function waht_use_bootstrap_framework() {
	$waht_options = waht_get_theme_options();
	return ($waht_options['framework_name'] == 'bootstrap');
}

/**
 * Returns true if we use theHTML5 Boilerplate framework
 *
 * @return bool
 */
function waht_use_h5bp_framework() {
	$waht_options = waht_get_theme_options();
	return ($waht_options['framework_name'] == 'h5bp');
}

/**
 * Returns true if we use the Foundation 3 framework
 *
 * @return bool
 */
function waht_use_foundation_framework() {
	$waht_options = waht_get_theme_options();
	return ($waht_options['framework_name'] == 'foundation');
}

/**
 * Returns the framework name (if using one)
 *
 * @return string
 */
function waht_get_framework() {
	if (!waht_use_framework()) :
		return '';
	else :
		$waht_options = waht_get_theme_options();
		return $waht_options['framework_name'];
	endif;
}

/**
 * Returns true if the layout has to be responsive
 *
 * @return bool
 */
function waht_is_responsive() {
	$waht_options = waht_get_theme_options();
	return $waht_options['responsive'];
}

/**
 * Returns true if teh layout has to be fluid
 *
 * @return bool
 */
function waht_use_fluid_layout() {
	$waht_options = waht_get_theme_options();
	return $waht_options['fluid'];
}