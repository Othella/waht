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
        $navbarFixedTop = $('body.has-top-fixed-navbar nav.main-navigation'),
        $stickyAdditionalNav = $('nav.additional-navigation.sticky'),
        navTop = $stickyAdditionalNav.length && $stickyAdditionalNav.offset().top - ($navbarFixedTop.height() + $adminBar.height()),
        isFixed = false;

    /**
     * Fix the additional navbar under the main navbar on scroll
     */
    function wahtSubNavScroll() {
        var scrollTop = $win.scrollTop();
        if ((scrollTop >= navTop) && !isFixed) {
            isFixed = true;
            $stickyAdditionalNav.addClass('additional-navigation-fixed');
            $stickyAdditionalNav.css('top', $navbarFixedTop.height() + $adminBar.height());
        } else if ((scrollTop < navTop) && isFixed) {
            isFixed = false;
            $stickyAdditionalNav.removeClass('additional-navigation-fixed');
            $stickyAdditionalNav.css('top', '0');
        }
    }

    // TODO (a.h) Dynamically set padding-top of body

    function wahtEnableFoundationScripts() {

        if (!$('body').hasClass('foundation')) {
            return; // We only need the following script if we use the Foundation framework!
        }
        $(document).foundationAccordion(); // Enables accordions
        $(document).foundationAlerts(); // Enables alert boxes
        $(document).foundationButtons(); // Enables dropdown buttons
        $(document).foundationCustomForms(); // Enables custom form elements
        $(document).foundationMediaQueryViewer(); // Adds the ability to show which media query you are currently viewing
        $(document).foundationNavigation(); // Enables the navigation
        $(document).foundationTabs(); // Enables tabs
        $(document).foundationTooltips(); // Enables tooltips
        $(document).foundationTopBar(); // Enables top bar. TODO: Add a breakpoint for the responsive version: $(document).foundationTopBar( {breakPoint: [width]} );
    }

    $(document).ready(function () {
        wahtEnableFoundationScripts();

    });

    $win.on('scroll', wahtSubNavScroll);
});