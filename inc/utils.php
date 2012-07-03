<?php
/**
 * @description: Some useful handy functions
 * @name       : inc/utils.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Outputs a credential string
 */
function waht_credentials() {
    $date = WAHT_CREATE_YEAR;
    $date .= (WAHT_CREATE_YEAR < date('Y')) ? "-" . date('Y') : '';

    $credentials = get_bloginfo('name') . " " . __('developed by', 'waht');
    $credentials .= " <a href=\"" . WAHT_AUTHOR_URI . "\" title=\"" . WAHT_AUTHOR_NAME . "\">";
    $credentials .= WAHT_AUTHOR_NAME;
    $credentials .= "</a> &copy; " . $date;
    echo $credentials;
}
