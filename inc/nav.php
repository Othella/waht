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
    // select the walker depending on framework
    $walker = WAHT_NAVBAR ? new Waht_NavBar_Walker_Nav_Menu() : (WAHT_CLEANED_MENU ? new Waht_Walker_Nav_Menu() : new Walker_Nav_Menu());
    wp_nav_menu(
        array(
             'container'        => false, // remove nav container
             'container_class'  => 'menu clearfix', // class of container (should you choose to use it)
             'menu'             => 'main_nav_menu', // nav name
             'menu_class'       => 'nav top-nav clearfix', // adding custom nav class
             'theme_location'   => 'main_nav_menu', // where it's located in the theme
             'walker'           => $walker, // our cleaner walker
             'before'           => '', // before the menu
             'after'            => '', // after the menu
             'link_before'      => '', // before each link
             'link_after'       => '', // after each link
             'depth'            => 0, // limit the depth of the nav
             'fallback_cb'      => 'waht_main_nav_menu_fallback' // fallback function
        ));
}

/**
 * Footer Nav Menu
 */
function waht_footer_nav_menu()
{
    $walker = WAHT_CLEANED_MENU ? new Waht_Walker_Nav_Menu() : new Walker_Nav_Menu();
    wp_nav_menu(
        array(
             'container'        => false, // remove nav container
             'container_class'  => 'footer-nav-menu clearfix', // class of container (should you choose to use it)
             'menu'             => 'footer_nav_menu', // nav name
             'menu_class'       => 'nav footer-nav clearfix', // adding custom nav class
             'theme_location'   => 'footer_nav_menu', // where it's located in the theme
             'walker'           => $walker, // our cleaner walker
             'before'           => '', // before the menu
             'after'            => '', // after the menu
             'link_before'      => '', // before each link
             'link_after'       => '', // after each link
             'depth'            => 1, // limit the depth of the nav
             'fallback_cb'      => 'waht_footer_nav_menu_fallback' // fallback function
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
    wp_page_menu();
}

/**
 * Replace WP generated state for current nav item by "active"
 *
 * @param $text
 *
 * @return mixed
 */
function waht_wp_nav_menu($text)
{
    $replace = array(
        'current-menu-item'     => 'active',
        'current-menu-parent'   => 'active',
        'current-menu-ancestor' => 'active',
        'current_page_item'     => 'active',
        'current_page_parent'   => 'active',
        'current_page_ancestor' => 'active',
    );

    $text = str_replace(array_keys($replace), $replace, $text);
    $text = str_replace('active active', 'active', $text); // only one!
    return $text;
}

add_filter('wp_nav_menu', 'waht_wp_nav_menu');

/**
 * Cleaner Walker displaying only the slug in the class name
 * @uses Walker_Nav_Menu
 */
class Waht_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Check if the classes contain info about current state
     *
     * @param array $classes
     *
     * @return bool
     */
    function is_current($classes)
    {
        // search for occurrences of "current" in the classes
        return preg_match('/(current[-_])/', $classes);
    }

    /**
     * Start the element output (list item <li>)
     * @see /wp-includes/class-wp-walker.php
     * @see wp-includes/nav-menu-template.php
     *
     * @param string $output
     * @param object $item
     * @param int    $depth
     * @param array  $args
     * @param int    $id
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $slug      = sanitize_title($item->title);
        $menu_name = 'menu-' . $slug;

        $classes = empty($item->classes) ? array() : (array)$item->classes;

        $classes = array_filter($classes, array(&$this, 'is_current'));

        // custom classes
        if ($custom_classes = get_post_meta($item->ID, '_menu_item_classes', true)) {
            foreach ($custom_classes as $custom_class) {
                $classes[] = $custom_class;
            }
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . $menu_name . ' ' . esc_attr($class_names) . '"' : ' class="' . $menu_name . '"';

        $output .= $indent . '<li' . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

/**
 * Cleaner Walker optimized for the Bootstrap NavBar
 * @uses Walker_Nav_Menu
 */
class Waht_NavBar_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Check if the classes contain info about current state
     *
     * @param $classes
     *
     * @return int
     */
    function check_current($classes)
    {
        // search for occurrences of "current", "active" or "dropdown"
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }

    /**
     * Starts the list before the elements are added. (list <ul>)
     * @see /wp-includes/class-wp-walker.php
     * @see wp-includes/nav-menu-template.php
     *
     * @param string $output
     * @param int    $depth
     * @param array  $args
     */
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        // set class to "dropdown-menu" instead of "sub-menu"
        $output .= "\n" . $indent . "<ul class=\"dropdown-menu\">\n";
    }

    /**
     * Start the element output (list item <li>)
     * @see      /wp-includes/class-wp-walker.php
     * @see      /wp-includes/nav-menu-template.php
     *
     * @param string       $output       Passed by reference. Used to append additional content.
     * @param object       $item         Menu item data object.
     * @param int          $depth        Depth of menu item. Used for padding.
     * @param array|object $args
     * @param int          $id
     *
     * @return void
     * @internal param int $current_page Menu item ID.
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $slug          = sanitize_title($item->title);
        $menu_name     = 'menu-' . $slug;
        $li_attributes = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;

        // dropdown
        if ($args->has_children) {
            $classes[] = 'dropdown';
            $li_attributes .= ' data-dropdown="dropdown"';
        }

        $classes = array_filter($classes, array(&$this, 'check_current'));

        // custom classes
        if ($custom_classes = get_post_meta($item->ID, '_menu_item_classes', true)) {
            foreach ($custom_classes as $custom_class) {
                $classes[] = $custom_class;
            }
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . $menu_name . ' ' . esc_attr($class_names) . '"' : ' class="' . $menu_name . '"'; // menu name in classes

        $output .= $indent . '<li' . $class_names . $li_attributes . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : ''; // dropdown

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= ($args->has_children) ? ' <b class="caret"></b>' : ''; // caret
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Traverse elements to create list from elements.
     * @see /wp-includes/class-wp-walker.php
     *
     * @param object $element           Data object
     * @param array  $children_elements List of elements to continue traversing.
     * @param int    $max_depth         Max depth to traverse.
     * @param int    $depth             Depth of current element.
     * @param array  $args
     * @param string $output            Passed by reference. Used to append additional content.
     *
     * @return null Null on failure with no changes to parameters.
     */
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        // add the "has_children" field (needed to display dropdown)
        if (is_array($args[0])) {
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        } elseif (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
            foreach ($children_elements[$id] as $child) {
                if (!isset($newlevel)) {
                    $newlevel = true;
                    $cb_args  = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) && $newlevel) {
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }

}

