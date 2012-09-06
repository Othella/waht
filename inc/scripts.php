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
	global $is_apache;

	$theme      = wp_get_theme();
	$assets_uri = get_template_directory_uri();
	if (!$is_apache || is_multisite() || is_child_theme() || !get_option('permalink_structure') || !current_theme_supports('rewrite-urls'))
		$assets_uri .= '/assets';

	// Only for IE < 9
	// See http://kuttler.eu/post/wordpress-style-version-conditional-comments/
	// and http://css-tricks.com/snippets/wordpress/html5-shim-in-functions-php/
	global $is_IE;
	if ($is_IE) {
		wp_register_style('waht-ie', $assets_uri . '/css/ie.css', array(), $theme['Version'], 'all');
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
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") .
			"://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, false);
		wp_enqueue_script('jquery');
	}

	// Comments
	if (is_single() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Bootstrap style and scripts
	if (WAHT_BOOTSTRAP) {
		wp_register_style('waht-bootstrap', $assets_uri . '/css/bootstrap.css', array(), null, 'all');
		wp_enqueue_style('waht-bootstrap');

		if (WAHT_RESPONSIVE) {
			wp_register_style('waht-bootstrap-responsive', $assets_uri . '/css/bootstrap-responsive.css',
				array('waht-bootstrap'), null, 'all');
			wp_enqueue_style('waht-bootstrap-responsive');
		}

		wp_register_script('waht-bootstrap', $assets_uri . '/js/bootstrap.min.js', array('jquery'), null, true);
		wp_enqueue_script('waht-bootstrap');
	}

	// Custom style
	wp_register_style('waht-style', $assets_uri . '/css/style.css', array(), $theme['Version'], 'all');
	wp_enqueue_style('waht-style');
	// TODO (a.h) Add a minified stylesheet

	// Custom scripts
	if (WAHT_DEV_MODE) :
		wp_register_script('waht-scripts', $assets_uri . '/js/scripts.js', array('jquery'), $theme['Version'], true);
	else :
		wp_register_script('waht-scripts', $assets_uri . '/js/scripts.min.js', array('jquery'), $theme['Version'], true);
	endif;

	wp_enqueue_script('waht-scripts');

	// Add To Home Screen
	if (WAHT_USE_ADD2HOME)
		wp_register_script('add2home', $assets_uri . '/js/lib/add2home.min.js', array(), null, true);
	wp_enqueue_script('add2home');
}

add_action('wp_enqueue_scripts', 'waht_enqueue_scripts', 100);


/**
 * Print JavaScript for Google Analytics
 * See https://developers.google.com/analytics/devguides/collection/gajs/
 */
function waht_google_analytics() {
	$waht_google_analytics_id = GOOGLE_ANALYTICS_ID;
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