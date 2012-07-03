<?php
/**
 * @description: Site layout customization
 * @name       : inc/layout.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

if (!function_exists('waht_register_sidebars')
) :
    /*
    * Register our sidebars
    */
    function waht_register_sidebars()
    {
        register_sidebar(array(
                              'id'            => 'sidebar-main',
                              'name'          => __('Main Sidebar', 'waht'),
                              'description'   => __('The main sidebar', 'waht'),
                              'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                              'after_widget'  => '</aside>',
                              'before_title'  => '<h3 class="widgettitle">',
                              'after_title'   => '</h3>',
                         ));
        register_sidebar(array(
                              'id'            => 'sidebar-left',
                              'name'          => __('Left Sidebar', 'waht'),
                              'description'   => __('The left sidebar', 'waht'),
                              'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                              'after_widget'  => '</aside>',
                              'before_title'  => '<h3 class="widgettitle">',
                              'after_title'   => '</h3>',
                         ));
        register_sidebar(array(
                              'id'            => 'sidebar-right',
                              'name'          => __('Right Sidebar', 'waht'),
                              'description'   => __('The right sidebar', 'waht'),
                              'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                              'after_widget'  => '</aside>',
                              'before_title'  => '<h3 class="widgettitle">',
                              'after_title'   => '</h3>',
                         ));
        register_sidebar(array(
                              'id'            => 'sidebar-footer',
                              'name'          => __('Footer Sidebar', 'waht'),
                              'description'   => __('The footer sidebar', 'waht'),
                              'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                              'after_widget'  => '</aside>',
                              'before_title'  => '<h3 class="widgettitle">',
                              'after_title'   => '</h3>',
                         ));
    }
endif;

if (!function_exists('waht_widgets_init')
) :
    /*
    * Initialize our widgets
    */
    function waht_widgets_init()
    {
        waht_register_sidebars();
    }

    add_action('widgets_init', 'waht_widgets_init');
endif;

if (!function_exists('waht_enqueue_scripts')
):
    /**
     * Enqueue our scripts
     */
    function waht_enqueue_scripts()
    {
        switch (WAHT_FRAMEWORK) {
            case "bootstrap":
                wp_enqueue_style('waht_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(),
                                 false, 'all');
                if (WAHT_RESPONSIVE) {
                    wp_enqueue_style('what_bootstrap_responsive',
                                     get_template_directory_uri() . '/assets/css/bootstrap-responsive.css',
                                     array('waht_bootstrap'), false, 'all');
                }
                break;
            default:
                break;
        }
    }

    add_action('wp_enqueue_scripts', 'waht_enqueue_scripts', 100);
endif;

if (!function_exists('waht_container_class')) :
    /**
     * Get the container class name
     */
    function waht_container_class()
    {
        echo (WAHT_FLUID_LAYOUT ? 'container-fluid' : 'container');
    }
endif;