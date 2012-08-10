<?php
/**
 * @description: Some useful handy functions
 * @name       : inc/utils.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

if (!defined('waht_credentials')
):
    /**
     * Outputs a credential string
     */
    function waht_credentials()
    {
        $date = WAHT_CREATE_YEAR;
        $date .= (WAHT_CREATE_YEAR < date('Y')) ? "-" . date('Y') : '';

        $credentials = get_bloginfo('name') . " " . __('developed by', 'waht');
        $credentials .= " <a href=\"" . WAHT_AUTHOR_URI . "\" title=\"" . WAHT_AUTHOR_NAME . "\">";
        $credentials .= WAHT_AUTHOR_NAME;
        $credentials .= "</a> &copy; " . $date;
        echo $credentials;
    }
endif;

if (!function_exists('waht_container_class')
) :
    /**
     * Get the container class name
     */
    function waht_container_class()
    {
        echo (WAHT_FLUID_LAYOUT ? 'container-fluid' : 'container');
    }
endif;

if (!function_exists('waht_google_analytics')) {
    /**
     * Print JavaScript for Google Analytics
     */
    function waht_google_analytics()
    {
        $waht_google_analytics_id = GOOGLE_ANALYTICS_ID;
        if ($waht_google_analytics_id !== '') {
            echo "\n\t<script>\n";
            echo "\t\tvar _gaq=[['_setAccount','$waht_google_analytics_id'],['_trackPageview']];\n";
            echo "\t\t(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];\n";
            echo "\t\tg.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';\n";
            echo "\t\ts.parentNode.insertBefore(g,s)}(document,'script'));\n";
            echo "\t</script>\n";
        }
    }

    add_action('waht_footer', 'waht_google_analytics');
}