<?php
/**
 * @description: Theme options in admin panel
 * @name       : inc/theme-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

require_once('theme-options/layout-options.php');
require_once('theme-options/framework-options.php');
require_once('theme-options/responsive-options.php');
require_once('theme-options/seo-options.php');
require_once('theme-options/social-options.php');

/**
 * Register the form settings for our waht_options array
 */
function waht_theme_options_init() {

	waht_layout_options_init(); // Layout options
	waht_framework_options_init(); // Framework options
	waht_seo_options_init(); // SEO options
	waht_responsive_options_init(); // Responsive options
	waht_social_options_init(); // Social options
}

add_action('admin_init', 'waht_theme_options_init');

/**
 * Add the theme options page to the admin menu, including some help documentation.
 */
function waht_theme_options_menu() {
	$theme_page = add_theme_page(
		sprintf(__('%s Theme Options', 'waht'), waht_get_theme_name()), // The title to be displayed in the browser window for this page.
		sprintf(__('%s Theme Options', 'waht'), waht_get_theme_name()), // The text to be displayed for this menu item
		'edit_theme_options', // Which type of users can see this menu item
		'waht_theme_options', // The unique ID - that is, the slug - for this menu item
		'waht_theme_options_display' // The name of the function to call when rendering this menu's page
	);
	if (!$theme_page) return;
	add_action("load-$theme_page", 'waht_theme_options_help');

	add_menu_page(
		sprintf(__('%s Theme Options', 'waht'), waht_get_theme_name()), // The value used to populate the browser's title bar when the menu page is active
		sprintf(__('%s Theme Options', 'waht'), waht_get_theme_name()), // The text of the menu in the administrator's sidebar
		'edit_theme_options', // What roles are able to access the menu
		'waht_theme_options', // The ID used to bind submenu items to this menu
		'waht_theme_options_display' // The callback function used to render this menu
	);

	add_submenu_page(
		'waht_theme_options', // The ID of the top-level menu page to which this submenu item belongs
		__('Framework', 'waht'), // The value used to populate the browser's title bar when the menu page is active
		__('Framework', 'waht'), // The label of this submenu item displayed in the menu
		'edit_theme_options', // What roles are able to access this submenu item
		'waht_theme_framework_options', // The ID used to represent this submenu item
		'waht_theme_options_display' // The callback function used to render the options for this submenu item
	);

	add_submenu_page(
		'waht_theme_options', // The ID of the top-level menu page to which this submenu item belongs
		__('Layout', 'waht'), // The value used to populate the browser's title bar when the menu page is active
		__('Layout', 'waht'), // The label of this submenu item displayed in the menu
		'edit_theme_options', // What roles are able to access this submenu item
		'waht_theme_layout_options', // The ID used to represent this submenu item
		create_function(null, 'waht_theme_options_display("layout");') // The callback function used to render the options for this submenu item
	);

	add_submenu_page(
		'waht_theme_options', // The ID of the top-level menu page to which this submenu item belongs
		__('Responsive', 'waht'), // The value used to populate the browser's title bar when the menu page is active
		__('Responsive', 'waht'), // The label of this submenu item displayed in the menu
		'edit_theme_options', // What roles are able to access this submenu item
		'waht_theme_responsive_options', // The ID used to represent this submenu item
		create_function(null, 'waht_theme_options_display("responsive");') // The callback function used to render the options for this submenu item
	);

	add_submenu_page(
		'waht_theme_options', // The ID of the top-level menu page to which this submenu item belongs
		__('SEO', 'waht'), // The value used to populate the browser's title bar when the menu page is active
		__('SEO', 'waht'), // The label of this submenu item displayed in the menu
		'edit_theme_options', // What roles are able to access this submenu item
		'waht_theme_seo_options', // The ID used to represent this submenu item
		create_function(null, 'waht_theme_options_display("seo");') // The callback function used to render the options for this submenu item
	);

	add_submenu_page(
		'waht_theme_options', // The ID of the top-level menu page to which this submenu item belongs
		__('Social', 'waht'), // The value used to populate the browser's title bar when the menu page is active
		__('Social', 'waht'), // The label of this submenu item displayed in the menu
		'edit_theme_options', // What roles are able to access this submenu item
		'waht_theme_social_options', // The ID used to represent this submenu item
		create_function(null, 'waht_theme_options_display("social");') // The callback function used to render the options for this submenu item
	);

}

add_action('admin_menu', 'waht_theme_options_menu');

/**
 * Renders the theme options page
 */
function waht_theme_options_display($active_tab = '') {
	?>
<div class="wrap"><?php // Create a header in the default WordPress 'wrap' container ?>

    <div id="icon-themes" class="icon32"></div><?php // Displays screen icon ?>
    <h2><?php printf(__('%s Theme Options', 'waht'), waht_get_theme_name()); ?></h2>

	<?php settings_errors(); // Make a call to the WordPress function for rendering errors when settings are saved. ?>

	<?php $active_tab = waht_theme_options_active_tab($active_tab); ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=waht_theme_options&tab=framework"
           class="nav-tab <?php echo $active_tab == 'framework' ? 'nav-tab-active' : ''; ?>">
			<?php _e('Framework', 'waht'); ?></a>
        <a href="?page=waht_theme_options&tab=layout"
           class="nav-tab <?php echo $active_tab == 'layout' ? 'nav-tab-active' : ''; ?>">
			<?php _e('Layout', 'waht'); ?></a>
        <a href="?page=waht_theme_options&tab=responsive"
           class="nav-tab <?php echo $active_tab == 'responsive' ? 'nav-tab-active' : ''; ?>">
			<?php _e('Responsive', 'waht'); ?></a>
        <a href="?page=waht_theme_options&tab=seo"
           class="nav-tab <?php echo $active_tab == 'seo' ? 'nav-tab-active' : ''; ?>">
			<?php _e('SEO', 'waht'); ?></a>
        <a href="?page=waht_theme_options&tab=social"
           class="nav-tab <?php echo $active_tab == 'social' ? 'nav-tab-active' : ''; ?>">
			<?php _e('Social', 'waht'); ?></a>
    </h2>

    <div class="waht-theme-options">
        <form method="post" action="options.php"><?php // Create the form that will be used to render our options ?>
			<?php

			if ($active_tab == 'framework') :
				// Display the Framework Options tab
				settings_fields('waht_framework_options');
				do_settings_sections('waht_framework_options');

			elseif ($active_tab == 'layout') :
				// Display the Layout Options tab
				settings_fields('waht_layout_options');
				do_settings_sections('waht_layout_options');

			elseif ($active_tab == 'responsive') :
				// Display the Responsive Options tab
				settings_fields('waht_responsive_options');
				do_settings_sections('waht_responsive_options');

			elseif ($active_tab == 'seo') :
				// Display the SEO Options tab
				settings_fields('waht_seo_options');
				do_settings_sections('waht_seo_options');

			elseif ($active_tab == 'social') :
				// Display the Social Options tab
				settings_fields('waht_social_options');
				do_settings_sections('waht_social_options');
			endif;

			submit_button(); ?>
        </form>
    </div>
</div>
<?php
}

/**
 * Retrieve the active tab of our options page
 *
 * @param $active_tab
 *
 * @return string
 */
function waht_theme_options_active_tab($active_tab) {
	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	elseif ($active_tab == 'layout') $active_tab = 'layout';
	elseif ($active_tab == 'responsive') $active_tab = 'responsive';
	elseif ($active_tab == 'seo') $active_tab = 'seo';
	elseif ($active_tab == 'social') $active_tab = 'social';
	else  $active_tab = 'framework';
	return $active_tab;
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