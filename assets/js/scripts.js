/**
 * Scripts made for the waht theme
 * Author:  Amélie Husson (http://ameliehusson.com)
 * Package: waht
 * URI:     https://github.com/Othella/waht
 */
jQuery(function ($) {
    var $win = $(window),
        $adminBar = $('#wpadminbar'),
        $navbarFixedTop = $('nav.navbar-fixed-top'),
        $subNav = $('.subnav'),
        navTop = $subNav.length && $subNav.offset().top - ($navbarFixedTop.height() + $adminBar.height()),
        isFixed = false;

    /**
     * Fix subnav on scroll
     */
    function wahtSubNavScroll() {
        var scrollTop = $win.scrollTop();
        if ((scrollTop >= navTop) && !isFixed) {
            isFixed = true;
            $subNav.addClass('subnav-fixed');
            $subNav.css('top', $navbarFixedTop.height() + $adminBar.height());
        } else if ((scrollTop < navTop) && isFixed) {
            isFixed = false;
            $subNav.removeClass('subnav-fixed');
        }
    }

    // TODO (a.h) Dynamically set padding-top of body

    $('document').ready(function () {

    });

    $win.on('scroll', wahtSubNavScroll);
});