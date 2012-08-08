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
     * See http://codex.wordpress.org/Function_Reference/add_theme_support
     */
    function waht_theme_support()
    {
        global $wp_version;

        if (version_compare($wp_version, '3.4', '>='))
            // Add support for custom header
            // See http://codex.wordpress.org/Custom_Headers
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

        if (version_compare($wp_version, '3.4', '>='))
            // Add support for custom backgrounds
            // See http://codex.wordpress.org/Custom_Backgrounds
            add_theme_support('custom-background', array(
                'default-color'          => '#ffffff',
                'default-image'          => get_template_directory_uri() .
                    "/assets/img/white_paper_texture_background_seamless_pattern.jpg",
                'wp_head_callback'       => 'custom_background_cb', // todo
                'admin-head-callback'    => '', // todo
                'admin-preview-callback' => '' // todo
            ));

        // Add support for WP menus
        if (version_compare($wp_version, '3.0', '>='))
            add_theme_support('menus');

        if (version_compare($wp_version, '3.1', '>='))
            // Add support for custom post format
            // See http://codex.wordpress.org/Post_Formats
            add_theme_support('post-formats', array(
                'aside',
                'gallery',
                'link',
                'image',
                'quote',
                'status',
                'video',
                'audio',
                'chat'
            ));

        if (version_compare($wp_version, '2.9', '>='))
            // Add support for custom post thumbnails
            // See http://codex.wordpress.org/Post_Thumbnails
            add_theme_support('post-thumbnails');

        if (version_compare($wp_version, '3.0', '>='))
            // add support for automatic feed links
            add_theme_support('automatic-feed-links');
    }
endif;
add_action('after_setup_theme', 'waht_theme_support');