<?php
/**
 * @description: Customize the login page
 * @name       : inc/login.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// See http://css-tricks.com/snippets/wordpress/customize-login-page/

/**
 * Add our own styling to the login page
 */
function waht_login_style() {
    echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/assets/css/login.css">';
}

add_action('login_head', 'waht_login_style');


/**
 * Replace the URL of logo with the site's home page
 */
function waht_replace_login_url() {
    return home_url();
}

add_filter('login_headerurl', 'waht_replace_login_url');


/**
 * Replace the title on login page with the site's name
 */
function waht_replace_login_title() {
    return get_option('blogname');
}

add_filter('login_headertitle', 'waht_replace_login_title');