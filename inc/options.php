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
define('WRAP_CLASSES',              'container');
define('CONTAINER_CLASSES',         'row');
define('MAIN_CLASSES',              'span8');
define('SIDEBAR_CLASSES',           'span4');
define('FULLWIDTH_CLASSES',         'span12');
define('GOOGLE_ANALYTICS_ID',       '');

/* Navigation and menus */
define('WAHT_NAVBAR', true); // Use a navbar for the main navigation
define('WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR', true); // Use the top-fixed Bootstrap's navbar. Only relevant if WAHT_BOOTSTRAP and WAHT_NAVBAR set to true.
define('WAHT_CLEANED_MENU', false); // Use cleanup functions menu's walkers
