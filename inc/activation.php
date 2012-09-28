<?php
/**
 * @description: Specific actions to run when activating the theme
 * @name       : inc/activation.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// TODO (a.h) Register settings in database and use relative paths


/**
 * Displays credential on admin footer
 */
function waht_admin_footer() {
	$credentials = '<span class="footer-thanks">' . waht_credentials() . '</span>';
	$credentials .= ' - ' . __('Build using', 'waht') . ' <a href="https://github.com/Othella/waht" title="waht on GitHub" target="_blank">waht</a>';
	echo $credentials;
}

add_filter('admin_footer_text', 'waht_admin_footer');

/**
 * Displays own favicon on admin pages
 */
function waht_admin_favicon() {
	echo '<link rel="shortcut icon" href="' . waht_get_assets_uri() . '/img/favicon.ico">';
}

add_action('admin_head', 'waht_admin_favicon');