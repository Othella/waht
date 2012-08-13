/**
 * Scripts made for the waht theme
 * Author:  Amélie Husson (http://ameliehusson.com)
 * Package: waht
 * URI:     https://github.com/Othella/waht
 */
jQuery(function ($) {

    /**
     *  Use bootstrap styled list in widget
     */
    function wahtBootstrapStyle() {
        var widgets = $('#page-wrap')
            .find('.widget_archive, .widget_categories, .widget_links, .widget_meta, .widget_pages, .widget_recent_entries, .widget_recent_comments, .widget_rss, .widget_nav_menu');
        widgets.addClass('nav');
        widgets.find('.widgettitle').addClass('nav-header');
        widgets.find('ul').addClass('nav nav-list');
    }

    /**
     * Improve page layout if using bootstrap's top navbar
     */
    function wahtPositionBody() {
        var navbar = $('nav.navbar-fixed-top'),
            body = $('body.waht-navbar-fixed-top');
        body.css('padding-top', navbar.height());
    }

    $('document').ready(function () {

        /**
         * Configure Add To Homescreen plugin
         * Documentation: http://cubiq.org/add-to-home-screen
         */
        var addToHomeConfig = {
            animationIn: 'bubble',
            animationOut:'drop',
            lifespan:    10000,
            expire:      2,
            touchIcon:   true
        };

        wahtBootstrapStyle();
        wahtPositionBody();
    });

    $(window).load(function () {
        $(window).resize(wahtPositionBody);
    });

});