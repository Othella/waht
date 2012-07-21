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
 * @used in header.php
 */
function waht_head() { do_action('waht_head'); }

/**
 * Page header before hook
 * @used in header.php
 */
function waht_page_header_before() { do_action('waht_page_header_before'); }

/**
 * Page header after hook
 * @used in header.php
 */
function waht_page_header_after() { do_action('waht_page_header_after'); }

/**
 * Page wrap before hook
 * @used in header.php
 */
function waht_page_wrap_before() { do_action('waht_page_wrap_before'); }

/**
 * Main section before hook
 */
function waht_main_before() { do_action('waht_main_before'); }

/**
 * Main section after hook
 */
function waht_main_after() { do_action('waht_main_after'); }

/**
 * Loop before hook
 * @used in loop.php
 */
function waht_loop_before() { do_action('waht_loop_before'); }

/**
 * Loop after hook
 * @used in loop.php
 */
function waht_loop_after() { do_action('waht_loop_after'); }

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
 * Page footer after hook
 * @used in footer.php
 */
function waht_page_footer_after() { do_action('waht_page_footer_after'); }

/**
 * Page footer hook: custom scripts
 * @used in footer.php
 */
function waht_footer() { do_action('waht_footer'); }