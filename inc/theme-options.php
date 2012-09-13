<?php
/**
 * @description: Theme options in admin panel
 * @name       : inc/theme-options.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 *
 * @see        http://wp.tutsplus.com/series/the-complete-guide-to-the-wordpress-settings-api/
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
function waht_theme_options_pages() {
	$options_pages = array();

	if (get_theme_support('waht-framework-options') ||
		get_theme_support('waht-layout-options') ||
		get_theme_support('waht-responsive-options')
	)
		$options_pages['display'] = array(
			'tab_name' => 'display',
			'title'    => __('Display', 'waht')
		);

	if (get_theme_support('waht-seo-options'))
		$options_pages['seo'] = array(
			'tab_name' => 'seo',
			'title'    => __('SEO', 'waht')
		);

	if (get_theme_support('waht-social-options'))
		$options_pages['social'] = array(
			'tab_name' => 'social',
			'title'    => __('Social', 'waht')
		);

	return $options_pages;
}

/**
 * Register the form settings for our waht_options array
 */
function waht_theme_options_init() {

	$options_pages = waht_theme_options_pages();
	if (array_key_exists('display', $options_pages)) :
		if (get_theme_support('waht-framework-options'))
			waht_framework_options_init(); // Framework options
		if (get_theme_support('waht-layout-options'))
			waht_layout_options_init(); // Layout options
		if (get_theme_support('waht-responsive-options'))
			waht_responsive_options_init(); // Responsive options
	endif;
	if (array_key_exists('seo', $options_pages))
		waht_seo_options_init(); // SEO options
	if (array_key_exists('social', $options_pages))
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
		'waht_theme_options_display', // The callback function used to render this menu
		waht_get_assets_uri() . '/img/logo-icon.png', // The url to the icon to be used for this menu
		61//The position in the menu order this one should appear
	);

	$options_pages = waht_theme_options_pages();
	foreach ($options_pages as $options_page) :
		add_submenu_page(
			'waht_theme_options', // The ID of the top-level menu page to which this submenu item belongs
			$options_page['title'], // The value used to populate the browser's title bar when the menu page is active
			$options_page['title'], // The label of this submenu item displayed in the menu
			'edit_theme_options', // What roles are able to access this submenu item
			'waht_theme_' . $options_page['tab_name'] . '_options', // The ID used to represent this submenu item
			create_function(null, 'waht_theme_options_display("' . $options_page['tab_name'] .
				'");') // The callback function used to render the options for this submenu item
		);
	endforeach;

}

add_action('admin_menu', 'waht_theme_options_menu');

/**
 * Renders the theme options page
 */
function waht_theme_options_display($active_tab = '') {
	$options_pages = waht_theme_options_pages();
	if ($active_tab == '') $active_tab = reset($options_pages)['tab_name']; // If no active tab was given, then it to the first tab available
	?>
<div class="wrap"><?php // Create a header in the default WordPress 'wrap' container ?>

    <div id="icon-themes" class="icon32"></div><?php // Displays screen icon ?>
    <h2><?php printf(__('%s Theme Options', 'waht'), waht_get_theme_name()); ?></h2>

	<?php settings_errors(); // Make a call to the WordPress function for rendering errors when settings are saved. ?>

	<?php

	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	else
		foreach ($options_pages as $options_page) :
			if ($active_tab == $options_page['tab_name']) $active_tab = $options_page['tab_name'];
		endforeach;
	?>

    <h2 class="nav-tab-wrapper">
		<?php
		foreach ($options_pages as $options_page) :
			$tab_class = 'nav-tab';
			$tab_class .= ($active_tab == $options_page['tab_name']) ? ' nav-tab-active' : '';
			$tab = '<a href="?page=waht_theme_options&tab=' . $options_page['tab_name'] . '" ';
			$tab .= 'class="' . $tab_class . '">';
			$tab .= $options_page['title'];
			$tab .= '</a>';
			echo $tab;
		endforeach;
		?>
    </h2>

    <div class="waht-theme-options">
        <form method="post" action="options.php"><?php // Create the form that will be used to render our options ?>
			<?php
			foreach ($options_pages as $options_page) :
				if ($active_tab == $options_page['tab_name']) :
					settings_fields('waht_' . $options_page['tab_name'] . '_options');
					do_settings_sections('waht_' . $options_page['tab_name'] . '_options');
				endif;
			endforeach;
			submit_button();
			submit_button(__('Reset to default values', 'waht'), 'delete', 'reset');
			?>
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
 * Enqueue own stylesheet and script file for the theme options page
 */
function waht_admin_enqueue_scripts() {
	wp_enqueue_style('waht-theme-options', get_template_directory_uri() . '/assets/css/theme-options.css');
	wp_enqueue_script('waht-theme-options', get_template_directory_uri() . '/assets/js/theme-options.min.js');
}

add_action("admin_enqueue_scripts", 'waht_admin_enqueue_scripts');

/**
 * Displays credential on admin footer
 */
function waht_admin_footer() {
	$credentials = '<span class="footer-thanks">' . waht_credentials() . '</span>';
	$credentials .= ' - ' . __('Build using', 'waht') . ' <a href="https://github.com/Othella/waht" title="waht on GitHub" target="_blank">waht</a>';
	echo $credentials;
}

add_filter('admin_footer_text', 'waht_admin_footer');