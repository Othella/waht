<?php
/**
 * @description: Navigation and Menus
 * @name       : inc/nav.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Register our navigation menus
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

/**
 * Main Man Menu
 */
function waht_main_nav_menu()
{
    wp_nav_menu(
        array(
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

/**
 * Footer Nav Menu
 */
function waht_footer_nav_menu()
{
    wp_nav_menu(
        array(
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

/**
 * Fallback for the Main Nav Menu
 */
function waht_main_nav_menu_fallback()
{
    wp_page_menu(array('show_home' => __('Home', 'waht')));
}

/**
 * Fallback for the Footer Nav Menu
 */
function waht_footer_nav_menu_fallback()
{
    /* you can put a default here if you like */
}

/**
 * Cleaner Walker displaying only the slug in the class name
 * @use Walker_Nav_Menu
 */
class Waht_Walker_Nav_Menu extends Walker_Nav_Menu {
    function is_current($classes)
    {
        return preg_match('/(current[-_])/', $classes);
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $slug  = sanitize_title($item->title);
        $class = 'menu-' . $slug;
        parent::start_el($output, $item, $depth, $args, $id);
    }

}

/**
 * Cleaner Walker optimized for the Bootstrap NavBar
 * @use Walker_Nav_Menu
 */
class Waht_NavBar_Walker_Nav_Menu extends Walker_Nav_Menu {
    function check_current($classes)
    {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        parent::end_lvl($output, $depth, $args);
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        parent::start_el($output, $item, $depth, $args, $id);
    }

    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        parent::end_el($output, $item, $depth, $args);
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function walk($elements, $max_depth)
    {
        return parent::walk($elements, $max_depth);
    }

    function paged_walk($elements, $max_depth, $page_num, $per_page)
    {
        return parent::paged_walk($elements, $max_depth, $page_num, $per_page);
    }

    function get_number_of_root_elements($elements)
    {
        return parent::get_number_of_root_elements($elements);
    }

    function unset_children($e, &$children_elements)
    {
        return parent::unset_children($e, $children_elements);
    }

}

