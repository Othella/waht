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
 * Retrieve theme options enabled in inc/config.php
 *
 * @return array
 */
function waht_get_enabled_theme_options() {
	$options_enabled = array();

	if (get_theme_support('waht-framework-options'))
		$options_enabled['framework'] = array(
			'tab_name' => 'framework',
			'title'    => __('Framework', 'waht')
		);

	if (get_theme_support('waht-layout-options'))
		$options_enabled['layout'] = array(
			'tab_name' => 'layout',
			'title'    => __('Layout', 'waht')
		);

	if (get_theme_support('waht-responsive-options'))
		$options_enabled['responsive'] = array(
			'tab_name' => 'responsive',
			'title'    => __('Responsive', 'waht')
		);

	if (get_theme_support('waht-seo-options'))
		$options_enabled['seo'] = array(
			'tab_name' => 'seo',
			'title'    => __('SEO', 'waht')
		);

	if (get_theme_support('waht-social-options'))
		$options_enabled['social'] = array(
			'tab_name' => 'social',
			'title'    => __('Social', 'waht')
		);

	return $options_enabled;
}

/**
 * Register the form settings for our waht_options array
 */
function waht_theme_options_init() {

	$options = waht_get_enabled_theme_options();
	if (array_key_exists('framework', $options))
		waht_framework_options_init(); // Framework options
	if (array_key_exists('layout', $options))
		waht_layout_options_init(); // Layout options
	if (array_key_exists('responsive', $options))
		waht_responsive_options_init(); // Responsive options
	if (array_key_exists('seo', $options))
		waht_seo_options_init(); // SEO options
	if (array_key_exists('social', $options))
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

	$options = waht_get_enabled_theme_options();
	foreach ($options as $option) :
		add_submenu_page(
			'waht_theme_options', // The ID of the top-level menu page to which this submenu item belongs
			$option['title'], // The value used to populate the browser's title bar when the menu page is active
			$option['title'], // The label of this submenu item displayed in the menu
			'edit_theme_options', // What roles are able to access this submenu item
			'waht_theme_' . $option['tab_name'] . '_options', // The ID used to represent this submenu item
			create_function(null, 'waht_theme_options_display("' . $option['tab_name'] .
				'");') // The callback function used to render the options for this submenu item
		);
	endforeach;

}

add_action('admin_menu', 'waht_theme_options_menu');

/**
 * Renders the theme options page
 */
function waht_theme_options_display($active_tab = '') {
	$options = waht_get_enabled_theme_options();
	if ($active_tab == '') $active_tab = reset($options)['tab_name']; // If no active tab was given, then it to the first tab available
	?>
<div class="wrap"><?php // Create a header in the default WordPress 'wrap' container ?>

    <div id="icon-themes" class="icon32"></div><?php // Displays screen icon ?>
    <h2><?php printf(__('%s Theme Options', 'waht'), waht_get_theme_name()); ?></h2>

	<?php settings_errors(); // Make a call to the WordPress function for rendering errors when settings are saved. ?>

	<?php

	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	else
		foreach ($options as $option) :
			if ($active_tab == $option['tab_name']) $active_tab = $option['tab_name'];
		endforeach;
	?>

    <h2 class="nav-tab-wrapper">
		<?php
		foreach ($options as $option) :
			$tab_class = 'nav-tab';
			$tab_class .= ($active_tab == $option['tab_name']) ? ' nav-tab-active' : '';
			$tab = '<a href="?page=waht_theme_options&tab=' . $option['tab_name'] . '" ';
			$tab .= 'class="' . $tab_class . '">';
			$tab .= $option['title'];
			$tab .= '</a>';
			echo $tab;
		endforeach;
		?>
    </h2>

    <div class="waht-theme-options">
        <form method="post" action="options.php"><?php // Create the form that will be used to render our options ?>
			<?php
			foreach ($options as $option) :
				if ($active_tab == $option['tab_name']) :
					settings_fields('waht_' . $option['tab_name'] . '_options');
					do_settings_sections('waht_' . $option['tab_name'] . '_options');
				endif;
			endforeach;
			submit_button(); ?>
        </form>
    </div>
</div>
<?php
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