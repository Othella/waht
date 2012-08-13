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
     * Improve page layout if using bootstrap's top navbar
     */
    function wahtPositionBody() {
        $('body.waht-navbar-fixed-top').css('padding-top', $navbarFixedTop.height());
    }

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

        wahtPositionBody();
    });

    $win.load(function () {
        $win.resize(wahtPositionBody);
    });
    $win.on('scroll', wahtSubNavScroll);

});