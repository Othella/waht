<?php
/**
 * @description: Cleanup auto-generated WP outputs
 * @name       : inc/cleanup.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

if (!defined('waht_body_class')
):
    /**
     * Add custom classes to body tag
     * @param $classes
     *
     * @return array
     */
    function waht_body_class($classes)
    {
        if (WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR)
            $classes[] = 'navbar-fixed-top';
        return $classes;
    }
endif;
add_filter('body_class', 'waht_body_class');