<?php
/**
 * @description: Some useful handy functions
 * @name       : inc/utils.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

if (!defined('waht_credentials')
):
    /**
     * Outputs a credential string
     */
    function waht_credentials()
    {
        $date = WAHT_CREATE_YEAR;
        $date .= (WAHT_CREATE_YEAR < date('Y')) ? "-" . date('Y') : '';

        $credentials = get_bloginfo('name') . " " . __('developed by', 'waht');
        $credentials .= " <a href=\"" . WAHT_AUTHOR_URI . "\" title=\"" . WAHT_AUTHOR_NAME . "\">";
        $credentials .= WAHT_AUTHOR_NAME;
        $credentials .= "</a> &copy; " . $date;
        echo $credentials;
    }
endif;

if (!function_exists('waht_container_class')
) :
    /**
     * Get the container class name
     */
    function waht_container_class()
    {
        echo (WAHT_FLUID_LAYOUT ? 'container-fluid' : 'container');
    }
endif;