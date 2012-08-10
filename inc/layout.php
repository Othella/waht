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
            'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' span4 %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="' . $widget_title_class . '">',
            'after_title'   => '</h3>',
        ));
        register_sidebar(array(
            'id'            => 'sidebar-footer-center',
            'name'          => __('Center Footer Sidebar', 'waht'),
            'description'   => __('The center footer sidebar', 'waht'),
            'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' span4 %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="' . $widget_title_class . '">',
            'after_title'   => '</h3>',
        ));
        register_sidebar(array(
            'id'            => 'sidebar-footer-right',
            'name'          => __('Right Footer Sidebar', 'waht'),
            'description'   => __('The right footer sidebar', 'waht'),
            'before_widget' => '<aside id="%1$s" class="' . $widget_class . ' span4 %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="' . $widget_title_class . '">',
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
        $theme = wp_get_theme();

        // Only for IE < 9
        wp_register_style('waht-ie', get_template_directory_uri() . 'assets/css/ie.css', false, $theme['Version'],
            'all');
        $GLOBALS['wp_styles']->add_data('waht-ie', 'conditional', 'lte IE 9');
        wp_enqueue_style('waht-ie');
        wp_register_script('waht-html5', 'http://html5shiv.googlecode.com/svn/trunk/html5.js', false, null, 'all');
        $GLOBALS['wp_styles']->add_data('waht-html5', 'conditional', 'lte IE 9');
        wp_enqueue_script('waht-html5');

        // Bootstrap style and scripts
        if (WAHT_BOOTSTRAP) {
            wp_enqueue_style('waht_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(),
                $theme['Version'], 'all');
            if (WAHT_RESPONSIVE) {
                wp_enqueue_style('waht_bootstrap_responsive',
                    get_template_directory_uri() . '/assets/css/bootstrap-responsive.css',
                    array('waht_bootstrap'), $theme['Version'], 'all');
            }
            wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js',
                array('jquery'), $theme['Version'], true);
        }

        // Custom script and style
        wp_enqueue_style('waht', get_template_directory_uri() . '/assets/css/waht.css', array(), $theme['Version'], 'all');
        if (WAHT_DEV_MODE)
            wp_enqueue_script('waht-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), $theme['Version'], true);
        else
            wp_enqueue_script('waht-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), $theme['Version'], true);

        // Comments
        // TODO check this
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');
    }

    add_action('wp_enqueue_scripts', 'waht_enqueue_scripts', 100);
endif;