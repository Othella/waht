<?php
/**
 * @description: Defines hooks for waht
 * @name       : inc/hooks.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Custom links and tags -
 * @used_in header.php
 */
function waht_head() { do_action('waht_head'); }

/**
 * Page header before hook
 * @used_in header.php
 */
function waht_page_header_before() { do_action('waht_page_header_before'); }

/**
 * Page header after hook
 * @used_in header.php
 */
function waht_page_header_after() { do_action('waht_page_header_after'); }

/**
 * Page wrap before hook
 * @used_in header.php
 */
function waht_page_wrap_before() { do_action('waht_page_wrap_before'); }

/**
 * Main section before hook
 * @used_in
 */
function waht_main_before() { do_action('waht_main_before'); }

/**
 * Main section after hook
 * @used_in
 */
function waht_main_after() { do_action('waht_main_after'); }

/**
 * Loop before hook
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_loop_before() { do_action('waht_loop_before'); }

/**
 * Loop after hook
 * @used in loop.php, loop-single.php, loop-page.php
 */
function waht_loop_after() { do_action('waht_loop_after'); }

/**
 * Post before hook
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_post_before() { do_action('waht_post_before'); }

/**
 * Post inside after hook
 * @used in loop.php, loop-single.php, loop-page.php
 */
function waht_post_inside_after() { do_action('waht_post_inside_after'); }

/**
 * Post inside before hook
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_post_inside_before() { do_action('waht_post_inside_before'); }

/**
 * Post after hook
 * @used in loop.php, loop-single.php, loop-page.php
 */
function waht_post_after() { do_action('waht_post_after'); }

/**
 * Sidebar aside before hook
 */
function waht_sidebar_before() { do_action('waht_sidebar_before'); }

/**
 * Sidebar aside after hook
 */
function waht_sidebar_after() { do_action('waht_sidebar_after'); }

/**
 * Page wrap after hook
 * @used in footer.php
 */
function waht_page_wrap_after() { do_action('waht_page_wrap_after'); }

/**
 * Page footer before hook
 * @used in footer.php
 */
function waht_page_footer_before() { do_action('waht_page_footer_before'); }

/**
 * Page footer inside hook
 * @used in footer.php
 */
function waht_page_footer_inside() { do_action('waht_page_footer_inside'); }
/**
 * Page footer after hook
 * @used in footer.php
 */
function waht_page_footer_after() { do_action('waht_page_footer_after'); }

/**
 * Page footer hook: custom scripts
 * @used in footer.php
 */
function waht_footer() { do_action('waht_footer'); }