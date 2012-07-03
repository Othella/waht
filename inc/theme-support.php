<?php
/**
 * @description: WP Theme support
 * @name       : inc/theme-support.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

if (!function_exists('waht_theme_support')
):
    /**
     * Theme support
     */
    function waht_theme_support()
    {
        // add support for custom header
        add_theme_support('custom-header', array(
                                                'default-image'          => get_template_directory_uri() . '/assets/img/logo.png',
                                                'random-default'         => false,
                                                'width'                  => 245,
                                                'height'                 => 145,
                                                'flex-height'            => true,
                                                'flex-width'             => true,
                                                'default-text-color'     => '',
                                                'header-text'            => false,
                                                'uploads'                => true,
                                                'wp-head-callback'       => '',
                                                'admin-head-callback'    => '',
                                                'admin-preview-callback' => '',
                                           ));

        // add support for custom backgrounds
        add_theme_support('custom-background', array(
                                                    'default-color' => '#ffffff',
                                                    'default-image' => get_template_directory_uri() .
                                                                       "/assets/img/white_paper_texture_background_seamless_pattern.jpg"
                                               ));

        // add support for WP menus
        add_theme_support('menus');
    }
endif;
add_action('after_setup_theme', 'waht_theme_support');