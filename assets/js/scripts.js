/**
 * Scripts made for the waht theme
 * Author:  Amélie Husson (http://ameliehusson.com)
 * Package: waht
 * URI:     https://github.com/Othella/waht
 */
jQuery('document').ready(function ($) {

    /* Use bootstrap styled list */
    var widgets = $('#page-wrap')
        .find('.widget_archive, .widget_categories, .widget_links, .widget_meta, .widget_pages, .widget_recent_entries, .widget_recent_comments, .widget_rss, .widget_nav_menu');
    widgets.addClass('nav');
    widgets.find('.widgettitle').addClass('nav-header');
    widgets.find('ul').addClass('nav nav-list');

    var addToHomeConfig = {
        animationIn: 'bubble',
        animationOut:'drop',
        lifespan:    10000,
        expire:      2,
        touchIcon:   true
    };

});