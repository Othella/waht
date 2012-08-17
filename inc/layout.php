<?php
/**
 * @description: Site layout customization
 * @name       : inc/layout.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Register our sidebars
 */
function waht_register_sidebars() {
    $widget_class       = 'widget';
    $widget_title_class = 'widgettitle';
    register_sidebar(array(
        'id'            => 'sidebar-main',
        'name'          => __('Main Sidebar', 'waht'),
        'description'   => __('The main sidebar', 'waht'),
        'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="' . $widget_title_class . '">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'id'            => 'sidebar-footer-left',
        'name'          => __('Left Footer Sidebar', 'waht'),
        'description'   => __('The left footer sidebar', 'waht'),
        'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="' . $widget_title_class . '">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'id'            => 'sidebar-footer-center',
        'name'          => __('Center Footer Sidebar', 'waht'),
        'description'   => __('The center footer sidebar', 'waht'),
        'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="' . $widget_title_class . '">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'id'            => 'sidebar-footer-right',
        'name'          => __('Right Footer Sidebar', 'waht'),
        'description'   => __('The right footer sidebar', 'waht'),
        'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="' . $widget_title_class . '">',
        'after_title'   => '</h3>',
    ));
}

/**
 * Initialize our widgets
 */
function waht_widgets_init() {
    waht_register_sidebars();
}

add_action('widgets_init', 'waht_widgets_init');