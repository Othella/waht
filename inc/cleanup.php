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
     *
     * @param $classes
     *
     * @return array
     */
    function waht_body_class($classes)
    {
        if (WAHT_BOOTSTRAP) {
            $classes[] = 'bootstrap';
            if (WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR)
                $classes[] = 'waht-navbar-fixed-top';
        }
        return $classes;
    }

    add_filter('body_class', 'waht_body_class');
endif;

if (!defined('waht_clean_head')
):
    /**
     * Clean the head : remove unused links and tags
     * @see http://wpengineer.com/1438/wordpress-header/
     */
    function waht_clean_head()
    {
        remove_action('wp_head', 'feed_links_extra', 3); // Remove the links to the extra feeds such as category feeds
        remove_action('wp_head', 'feed_links', 2); // Remove the links to the general feeds: Post and Comment Feed
        remove_action('wp_head', 'rsd_link'); // Remove the link to the Really Simple Discovery service endpoint, EditURI link
        remove_action('wp_head', 'wlwmanifest_link'); // Remove the link to the Windows Live Writer manifest file.
        remove_action('wp_head', 'index_rel_link'); // Remove the index link
        remove_action('wp_head', 'parent_post_rel_link_wp_head', 10, 0); // Remove the prev link
        remove_action('wp_head', 'start_post_rel_link_wp_head', 10, 0); // Remove the start link
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Remove relational links for the posts adjacent to the current post.
        remove_action('wp_head', 'wp_generator'); // Remove the XHTML generator that is generated on the wp_head hook, WP version
    }

    add_filter('init', 'waht_clean_head');
endif;