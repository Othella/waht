/**
 * Scripts made for the waht theme
 * Author:  Amélie Husson (http://ameliehusson.com)
 * Package: waht
 * URI:     https://github.com/Othella/waht
 *
 * TODO This is a demo scripting for the waht package. Feel free to remove it or reuse its code!
 */
jQuery(function ($) {
    var $win = $(window),
        $adminBar = $('#wpadminbar'),
        $navbarFixedTop = $('nav.main-navigation.navbar-fixed-top'),
        $subNav = $('nav.additional-navigation'),
        navTop = $subNav.length && $subNav.offset().top - ($navbarFixedTop.height() + $adminBar.height()),
        isFixed = false;

    /**
     * Fix the additional navbar under the main navbar on scroll
     */
    function wahtSubNavScroll() {
        var scrollTop = $win.scrollTop();
        if ((scrollTop >= navTop) && !isFixed) {
            isFixed = true;
            $subNav.addClass('additional-navigation-fixed');
            $subNav.css('top', $navbarFixedTop.height() + $adminBar.height());
        } else if ((scrollTop < navTop) && isFixed) {
            isFixed = false;
            $subNav.removeClass('additional-navigation-fixed');
        }
    }

    // TODO (a.h) Dynamically set padding-top of body

    $('document').ready(function () {

    });

    $win.on('scroll', wahtSubNavScroll);
});