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
function waht_register_nav_menus() {
    register_nav_menus(
        array(
            'main_nav_menu'       => __('Main Navigation Menu', 'waht'),
            'additional_nav_menu' => __('Additional Navigation Menu', 'waht')
        )
    );
}

add_action('after_setup_theme', 'waht_register_nav_menus');


/**
 * Main Man Menu
 */
function waht_main_nav_menu() {
    // select the walker depending on framework
    $walker = WAHT_NAVBAR ? new Waht_NavBar_Walker_Nav_Menu() :
        (WAHT_CLEANED_MENU ? new Waht_Walker_Nav_Menu() : new Walker_Nav_Menu());
    wp_nav_menu(
        array(
            'container'       => false, // remove nav container
            'container_class' => 'menu clearfix', // class of container (should you choose to use it)
            'menu'            => 'main_nav_menu', // nav name
            'menu_class'      => 'nav top-nav clearfix', // adding custom nav class
            'theme_location'  => 'main_nav_menu', // where it's located in the theme
            'walker'          => $walker, // our cleaner walker
            'before'          => '', // before the menu
            'after'           => '', // after the menu
            'link_before'     => '', // before each link
            'link_after'      => '', // after each link
            'depth'           => 0, // limit the depth of the nav
            'fallback_cb'     => 'waht_main_nav_menu_fallback' // fallback function
        ));
}


/**
 * Additional Nav Menu
 */
function waht_additional_nav_menu() {
    $walker = WAHT_NAVBAR ? new Waht_NavBar_Walker_Nav_Menu() :
        (WAHT_CLEANED_MENU ? new Waht_Walker_Nav_Menu() : new Walker_Nav_Menu());
    wp_nav_menu(
        array(
            'container'       => false, // remove nav container
            'container_class' => 'additional-nav-menu clearfix', // class of container (should you choose to use it)
            'menu'            => 'additional_nav_menu', // nav name
            'menu_class'      => 'nav nav-pills additional-nav clearfix', // adding custom nav class
            'theme_location'  => 'additional_nav_menu', // where it's located in the theme
            'walker'          => $walker, // our cleaner walker
            'before'          => '', // before the menu
            'after'           => '', // after the menu
            'link_before'     => '', // before each link
            'link_after'      => '', // after each link
            'depth'           => 0, // limit the depth of the nav
            'fallback_cb'     => 'waht_footer_nav_menu_fallback' // fallback function
        ));
}

/**
 * Fallback for the Main Nav Menu
 */
function waht_main_nav_menu_fallback() {
    wp_page_menu(array('show_home' => __('Home', 'waht')));
}


/**
 * Fallback for the Footer Nav Menu
 */
function waht_additional_nav_menu_fallback() {
    wp_page_menu();
}

/**
 * Replace WP generated state for current nav item by "active"
 *
 * @param $text
 *
 * @return mixed
 */
function waht_wp_nav_menu($text) {
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
    function is_current($classes) {
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
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
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
        $class_names =
            $class_names ? ' class="' . $menu_name . ' ' . esc_attr($class_names) . '"' : ' class="' . $menu_name . '"';

        $output .= $indent . '<li' . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        /** @noinspection PhpUndefinedFieldInspection */
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        /** @noinspection PhpUndefinedFieldInspection */
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        /** @noinspection PhpUndefinedFieldInspection */
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
    function check_current($classes) {
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
    function start_lvl(&$output, $depth = 0, $args = array()) {
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
     * @param array        $args         Arguments
     * @param int          $id
     *
     * @return void
     * @internal param int $current_page Menu item ID.
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
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
        $class_names = $class_names ? ' class="' . $menu_name . ' ' . esc_attr($class_names) . '"' :
            ' class="' . $menu_name . '"'; // menu name in classes

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
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        if (!$element) return;

        $id_field = $this->db_fields['id'];

        //display this element
        // add the "has_children" field (needed to display dropdown)
        if (is_array($args[0])) {
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        }
        elseif (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are children for this element
        if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
            foreach ($children_elements[$id] as $child) {
                if (!isset($newlevel)) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) && $newlevel) {
            //end the child delimiter
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }

}

/**
 * Builds a breadcrumb
 * See http://bacsoftwareconsulting.com/blog/index.php/wordpress-cat/adding-wordpress-breadcrumbs-without-a-plugin/
 */
function waht_breadcrumb() {
    //Variable and can be styled separately.
    //Use / for different level categories (parent / child / grandchild)
    $delimiter = '<span class="divider"> / </span>';
    //Use bullets for same level categories ( parent . parent )
    $subdelimiter = '<span class="subdivider"> &bull; </span>';

    //text link for the 'Home' page
    $main = __('Home', 'waht');
    //Display only the first 30 characters of the post title.
    $maxLength = 30;

    //variable for archived year
    $arc_year = get_the_time('Y');
    //variable for archived month
    $arc_month = get_the_time('F');
    //variables for archived day number + full
    $arc_day      = get_the_time('d');
    $arc_day_full = get_the_time('l');

    //variable for the URL for the Year
    $url_year = get_year_link($arc_year);
    //variable for the URL for the Month
    $url_month = get_month_link($arc_year, $arc_month);

    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
        when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
        is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
        "A static page" and the "Front Page" value is the current Page being displayed. In this case
        no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */

    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page()) {
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
        echo '<ul class="breadcrumb">';

        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;
        //A safe way of getting values for a named option from the options database table.
        $homeLink = get_option('home'); //same as: $homeLink = get_bloginfo('url');
        echo '<li><a href="' . $homeLink . '">' . $main . '</a>' . $delimiter . '</li>';

        if (!is_page()) {
            if (!is_home()) {
                echo'<li><a href="' . get_permalink(get_option('page_for_posts', true)) . '">' .
                    get_the_title(get_option('page_for_posts', true)) . '</a>';
                echo $delimiter;
                echo '</li>';

            }
            else {
                echo '<li class="active">' . get_the_title(get_option('page_for_posts', true)) . '</li>';
            }
        }

        //Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $num_cat  = count($category); //counts the number of categories the post is listed in.

            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
            if ($num_cat <= 1) //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                echo '<li>' . get_category_parents($category[0], true, $delimiter) . '</li>';
                //Display the full post title.
                echo '<li class="active">' . get_the_title() . '</li>';
            } //then the post is listed in more than 1 category.
            else {
                echo '<li>';
                //Put bullets between categories, since they are at the same level in the hierarchy.
                the_category($subdelimiter);
                echo $delimiter . '</li>';
                //Display partial post title, in order to save space.
                if (strlen(get_the_title()) >= $maxLength) { //If the title is long, then don't display it all.
                    echo '<li class="active">' . trim(substr(get_the_title(), 0, $maxLength)) . ' ...</li>';
                }
                else { //the title is short, display all post title.
                    echo '<li class="active">' . get_the_title() . '</li>';
                }
            }
        } //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            echo
                '<li class="active">' . __('Category Archives:', 'waht') . ' ' . single_cat_title("", false) . '</li>';
        } //Display breadcrumb for tag archive
        elseif (is_tag()) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo '<li class="active">' . __('Tag Archives:', 'waht') . ' ' . single_tag_title("", false) . '</li>';
        } //Display breadcrumb for calendar (day, month, year) archive
        elseif (is_day()) { //Check if the page is a date (day) based archive page.
            echo '<li><a href="' . $url_year . '">' . $arc_year . '</a>' . $delimiter . '</li>';
            echo '<li><a href="' . $url_month . '">' . $arc_month . '</a>' . $delimiter . '</li>';
            echo '<li class="active">' . $arc_day . ' (' . $arc_day_full .
                ')';
            echo '</li>';
        }
        elseif (is_month()) { //Check if the page is a date (month) based archive page.
            echo'<li><a href="' . $url_year . '">' . $arc_year . '</a>' . $delimiter . '</li>';
            echo '<li class="active">' . $arc_month . '</li>';
        }
        elseif (is_year()) { //Check if the page is a date (year) based archive page.
            echo '<li class="active">' . $arc_year . '</li>';
        } //Display breadcrumb for search result page
        elseif (is_search()) { //Check if search result page archive is being displayed.
            echo '<li class="active">' . __('Search Results for:', 'waht') .  ' ' . get_search_query() . '</li>';
        } //Display breadcrumb for top-level pages (top-level menu)
        elseif (is_page() && !$post->post_parent) { //Check if this is a top Level page being displayed.
            echo '<li class="active">' . get_the_title() . '</li>';
        } //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif (is_page() && $post->post_parent) { //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.
            $post_array = get_post_ancestors($post);

            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array);

            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach ($post_array as $key=> $postid) {
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo'<li><a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter .
                    '</li>';
            }
            echo '<li class="active">' . the_title() . '</li>'; //returns the title of the current page.
        } //Display breadcrumb for author archive
        elseif (is_author()) { //Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo'<li class="active">' . __('Archived Article(s) by Author:', 'waht') . ' ' . $user_info->display_name .
                '</li>';
        } //Display breadcrumb for 404 Error
        elseif (is_404()) { //checks if 404 error is being displayed
            echo  '<li class="active"' > __('Error 404 - Not Found.', 'waht') . '</li>';
        }
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
        echo '</ul>';
    }
}

add_action('waht_loop_before', 'waht_breadcrumb');

/**
 * Build custom navigation for pages inside posts
 * See http://bavotasan.com/2012/a-better-wp_link_pages-for-wordpress/
 *
 * @param array $args
 *
 * @return string
 */
function waht_link_pages($args = array()) {
    if (WAHT_BOOTSTRAP) :
        $defaults = array(
            'before'           => '<nav class="page-nav">' . __('Pages:', 'waht'),
            'after'            => '</nav>',
            'text_before'      => '',
            'text_after'       => '',
            'next_or_number'   => 'number',
            'nextpagelink'     => __('Next page', 'waht'),
            'previouspagelink' => __('Previous page', 'waht'),
            'pagelink'         => '%',
            'echo'             => 1
        );

        $r = wp_parse_args($args, $defaults);
        $r = apply_filters('wp_link_pages_args', $r);
        extract($r, EXTR_SKIP);

        global $page, $numpages, $multipage, $more;

        $output = '';
        if ($multipage) {
            if ('number' == $next_or_number) {
                $output .= $before . '<div class="pagination pagination-centered"><ul>';
                for ($i = 1; $i < ($numpages + 1); $i = $i + 1) {
                    $j = str_replace('%', $i, $pagelink);
                    if ($i != $page || ((!$more) && ($page == 1))) :
                        $output .= '<li>';
                        $output .= _wp_link_page($i);
                    else :
                        $output .= '<li class="active">';
                        $output .= '<a href="#" title="' . __('Current page', 'waht') . '">';
                    endif;
                    $output .= $text_before . $j . $text_after;
                    $output .= '</a></li>';
                }
                $output .= '</ul>' . $after;
            }
            else {
                if ($more) {
                    $output .= $before . '<ul>';
                    $i = $page - 1;
                    if ($i && $more) {
                        $output .= '<li>';
                        $output .= _wp_link_page($i);
                        $output .= $text_before . $previouspagelink . $text_after . '</a></li>';
                    }
                    $i = $page + 1;
                    if ($i <= $numpages && $more) {
                        $output .= '<li>';
                        $output .= _wp_link_page($i);
                        $output .= $text_before . $nextpagelink . $text_after . '</a></li>';
                    }
                    $output .= '</ul>' . $after;
                }
            }
        }
        if ($echo)
            echo $output;

        return $output;
    else:
        wp_link_pages($args);
    endif;
}