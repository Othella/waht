<?php
/**
 * @description: Navigation and Menus
 * @name       : inc/nav.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Register out navigation menus
 * @require WP 3+
 */
function waht_register_nav_menus()
{
    register_nav_menus(
        array(
             'main_nav_menu'     => __('Main Navigation Menu', 'waht'),
             'footer_nav_menu'   => __('Footer Navigation Menu', 'waht')
        )
    );
}

add_action('after_setup_theme', 'waht_register_nav_menus');

function waht_main_nav_menu()
{
    wp_nav_menu(array(
                     'container'       => false, // remove nav container
                     'container_class' => 'menu clearfix', // class of container (should you choose to use it)
                     'menu'            => 'main_nav_menu', // nav name
                     'menu_class'      => 'nav top-nav clearfix', // adding custom nav class
                     'theme_location'  => 'main_nav_menu', // where it's located in the theme
                     'before'          => '', // before the menu
                     'after'           => '', // after the menu
                     'link_before'     => '', // before each link
                     'link_after'      => '', // after each link
                     'depth'           => 0, // limit the depth of the nav
                     'fallback_cb'     => 'waht_main_nav_menu_fallback' // fallback function
                ));
}

function waht_footer_nav_menu()
{
    wp_nav_menu(array(
                     'container'       => false, // remove nav container
                     'container_class' => 'footer-nav-menu clearfix', // class of container (should you choose to use it)
                     'menu'            => 'footer_nav_menu', // nav name
                     'menu_class'      => 'nav footer-nav clearfix', // adding custom nav class
                     'theme_location'  => 'footer_nav_menu', // where it's located in the theme
                     'before'          => '', // before the menu
                     'after'           => '', // after the menu
                     'link_before'     => '', // before each link
                     'link_after'      => '', // after each link
                     'depth'           => 1, // limit the depth of the nav
                     'fallback_cb'     => 'waht_footer_nav_menu_fallback' // fallback function
                ));
}

function waht_main_nav_menu_fallback()
{
    wp_page_menu(array('show_home' => __('Home', 'waht')));
}

// this is the fallback for footer menu
function waht_footer_nav_menu_fallback()
{
    /* you can put a default here if you like */
}

