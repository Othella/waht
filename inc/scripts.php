<?php
/**
 * @description: Scripting and styling related functions
 * @name       : inc/scripts.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Enqueue our scripts
 */
function waht_enqueue_scripts() {

	// Only for IE < 9
	// See http://kuttler.eu/post/wordpress-style-version-conditional-comments/
	// and http://css-tricks.com/snippets/wordpress/html5-shim-in-functions-php/
	global $is_IE;
	if ($is_IE) {
		wp_register_style('waht-ie', waht_get_assets_uri() . '/css/ie.css', array(), waht_get_theme_version(), 'all');
		$GLOBALS['wp_styles']->add_data('waht-ie', 'conditional', 'lte IE 9');
		wp_enqueue_style('waht-ie');

		wp_register_script('waht-html5', 'http://html5shiv.googlecode.com/svn/trunk/html5.js', array(), null, 'all');
		$GLOBALS['wp_styles']->add_data('waht-html5', 'conditional', 'lte IE 9');
		wp_enqueue_script('waht-html5');
	}

	// jQuery is loaded in header.php using the same method from HTML5 Boilerplate:
	// Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline
	// It's kept in the header instead of footer to avoid conflicts with plugins.
	// See http://css-tricks.com/snippets/wordpress/include-jquery-in-wordpress-theme/
	if (!is_admin()) :
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") .
			"://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, false);
		wp_enqueue_script('jquery');
	endif;

	// Comments
	if (is_single() && comments_open() && get_option('thread_comments'))
		wp_enqueue_script('comment-reply');

	// Framework style and scripts
	waht_enqueue_framework_scripts();

	// Custom style
	wp_register_style('waht-style', waht_get_assets_uri() . '/css/style.css', array(), waht_get_theme_version(), 'all');
	wp_enqueue_style('waht-style');
	// TODO (a.h) Add a minified stylesheet

	// Custom scripts
	if (WAHT_DEV_MODE)
		wp_register_script('waht-scripts', waht_get_assets_uri() . '/js/scripts.js', array('jquery'), waht_get_theme_version(), true);
	else
		wp_register_script('waht-scripts', waht_get_assets_uri() . '/js/scripts.min.js', array('jquery'), waht_get_theme_version(), true);

	wp_enqueue_script('waht-scripts');

	// Add To Home Screen
	if (WAHT_USE_ADD2HOME)
		wp_register_script('add2home', waht_get_assets_uri() . '/js/lib/add2home.min.js', array(), null, true);
	wp_enqueue_script('add2home');
}

add_action('wp_enqueue_scripts', 'waht_enqueue_scripts', 100);

/**
 * Enqueue scripts files depending on the used framework
 */
function waht_enqueue_framework_scripts() {
	if (!waht_use_framework()):
		// do not enqueue anything
		return;
	elseif (waht_use_bootstrap_framework()):
		// enqueue Twitter Bootstrap's files
		waht_enqueue_bootstrap_framework_scripts();
	elseif (waht_use_h5bp_framework()):
		// enqueue HTML5 Boilerplate's files
		waht_enqueue_h5bp_framework_scripts();
	elseif (waht_use_foundation_framework()):
		// enqueue Foundation 3's files
		waht_enqueue_foundation_framework_scripts();
	endif;
}

/**
 * Enqueue all scripts needed for Twitter Bootstrap
 */
function waht_enqueue_bootstrap_framework_scripts() {
	wp_register_style('waht-bootstrap', get_template_directory_uri() . '/frameworks/bootstrap/css/bootstrap.min.css', array(), null, 'all');
	wp_enqueue_style('waht-bootstrap');

	if (WAHT_RESPONSIVE) :
		wp_register_style('waht-bootstrap-responsive', get_template_directory_uri() . '/frameworks/bootstrap/css/bootstrap-responsive.min.css',
			array('waht-bootstrap'), null, 'all');
		wp_enqueue_style('waht-bootstrap-responsive');
	endif;

	wp_register_script('waht-bootstrap', get_template_directory_uri() . '/frameworks/bootstrap/js/bootstrap.min.js', array('jquery'), null, true);
	wp_enqueue_script('waht-bootstrap');
}

/**
 * Enqueue all scripts needed for HTML5 Boilerplate
 */
function waht_enqueue_h5bp_framework_scripts() {
	wp_register_style('waht-h5bp-normalize',
		get_template_directory_uri() . '/frameworks/h5bp-html5-boilerplate/css/normalize.css', array(), null, 'all');
	wp_enqueue_style('waht-h5bp-normalize');

	wp_register_style('waht-h5bp',
		get_template_directory_uri() . '/frameworks/h5bp-html5-boilerplate/css/main.css', array('waht-h5bp-normalize'), null, 'all');
	wp_enqueue_style('waht-h5bp');

	wp_register_script('waht-h5bp-modernizr',
		get_template_directory_uri() . '/frameworks/h5bp-html5-boilerplate/js/vendor/modernizr-2.6.1.min.js', array(), '2.6.1', false);
	wp_enqueue_script('waht-h5bp-modernizr');

	wp_register_script('waht-h5bp', get_template_directory_uri() . '/frameworks/h5bp-html5-boilerplate/js/plugins.js', array('waht-h5bp-modernizr',
		'jquery'), null, true);
	wp_enqueue_script('waht-h5bp');
}

/**
 * Enqueue all scripts needed for Foundation 3
 */
function waht_enqueue_foundation_framework_scripts() {
	wp_register_style('waht-foundation',
		get_template_directory_uri() . '/frameworks/foundation-3/stylesheets/foundation.min.css', array(), null, 'all');
	wp_enqueue_style('waht-foundation');

	wp_register_script('waht-foundation',
		get_template_directory_uri() . '/frameworks/foundation-3/javascripts/foundation.min.js', array('jquery'), null, true);
	wp_enqueue_script('waht-foundation');
}

/**
 * Print JavaScript for Google Analytics
 * See https://developers.google.com/analytics/devguides/collection/gajs/
 */
function waht_google_analytics() {
	$waht_options             = waht_get_theme_options();
	$waht_google_analytics_id = $waht_options['google_analytics_id'];
	if ($waht_google_analytics_id !== '') {
		$script_str = "\n\t<script>\n";
		$script_str .= "\t\tvar _gaq=[['_setAccount','$waht_google_analytics_id'],['_trackPageview']];\n";
		$script_str .= "\t\t(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];\n";
		$script_str .= "\t\tg.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';\n";
		$script_str .= "\t\ts.parentNode.insertBefore(g,s)}(document,'script'));\n";
		$script_str .= "\t</script>\n";
		echo $script_str;
	}
}

add_action('waht_footer', 'waht_google_analytics');


/**
 * Configure Add To Homescreen plugin
 * Documentation: http://cubiq.org/add-to-home-screen
 * TODO (a.h) Stylesheet doesn't load
 */
function waht_add_to_homescreen_options() {
	if (!WAHT_USE_ADD2HOME) return;
	$conf_str = "\n\t<script>\n";
	$conf_str .= "\t\tvar addToHomeConfig = {\n";
	$conf_str .= "\t\t\tanimationIn: 'bubble',\n";
	$conf_str .= "\t\t\tanimationOut:'drop',\n";
	$conf_str .= "\t\t\tlifespan:    10000,\n";
	$conf_str .= "\t\t\texpire:      2,\n";
	$conf_str .= "\t\t\ttouchIcon:   true\n";
	$conf_str .= "\t\t};\n";
	$conf_str .= "\t</script>\n";
	echo $conf_str;
}

add_action('waht_footer', 'waht_add_to_homescreen_options');