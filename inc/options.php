<?php
/**
 * @description: Defines all variables and options to customize the theme
 * @name       : assets/inc/options
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/* Theme Author Information */
define('WAHT_AUTHOR_NAME', 'a.h'); // Put your name here
define('WAHT_AUTHOR_URI', 'http://ameliehusson.com'); // Put your uri here
define('WAHT_CREATE_YEAR', 2012); // Put the theme creation's year here

/* Layout Options */
define('WAHT_BOOTSTRAP', true); // Allow use of the Twitter Bootstrap framework
define('WAHT_RESPONSIVE', true); // Allow responsive layout
define('WAHT_FLUID_LAYOUT', false); // Fluid (true) ir fixed (false) layout

/* Classes */
define('WRAP_CLASSES', 'container'); // Class(es) for the wrapper
define('CONTAINER_CLASSES', 'row-fluid'); // Class(es) for the container divs
define('MAIN_CLASSES', 'span8'); // Class(es) for the main content area
define('SIDEBAR_CLASSES', 'span4'); // Class(es) for the sidebar area
define('FULLWIDTH_CLASSES', 'span12'); // Class(es) for full-width main content area
define('GOOGLE_ANALYTICS_ID', 'UA-XXX-Y'); // Set your own Google Analytics ID here!
define('SIDEBAR_POS', 'right'); // Sidebar position

/* Navigation and menus */
define('WAHT_NAVBAR', true); // Use a navbar for the navigation menus
define('WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR', true); // Use the top-fixed Bootstrap's navbar for the main navbar. Only relevant if WAHT_BOOTSTRAP and WAHT_NAVBAR set to true.
define('WAHT_CLEANED_MENU', true); // Use cleanup functions menu's walkers

/* Development to use non minified-script (easier for debugging) */
define('WAHT_DEV_MODE', false);

/* JavaScript plugins */
define('WAHT_USE_ADD2HOME', true); // Add To Home Screen. See http://cubiq.org/add-to-home-screen

/* Apple devices compatible icons */
define('WAHT_APPLE_ICONS', true);