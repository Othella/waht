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
 * Page header inside before hook
 * @used_in header.php
 */
function waht_page_header_inside_before() { do_action('waht_page_header_inside_before'); }

/**
 * Page header inside after hook
 * @used_in header.php
 */
function waht_page_header_inside_after() { do_action('waht_page_header_inside_after'); }

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
 * Page wrap inside before hook
 * @used_in header.php
 */
function waht_page_wrap_inside_before() { do_action('waht_page_wrap_inside_before'); }

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
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_loop_after() { do_action('waht_loop_after'); }

/**
 * Post before hook
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_post_before() { do_action('waht_post_before'); }

/**
 * Post inside before hook
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_post_inside_before() { do_action('waht_post_inside_before'); }

/**
 * Post inside after hook
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_post_inside_after() { do_action('waht_post_inside_after'); }

/**
 * Post after hook
 * @used_in loop.php, loop-single.php, loop-page.php
 */
function waht_post_after() { do_action('waht_post_after'); }

/**
 * Comments before hook
 * @used_in comments.php
 */
function waht_comments_before() { do_action('waht_comments_before'); }

/**
 * Comments after hook
 * @used_in comments.php
 */
function waht_comments_after() { do_action('waht_comments_after'); }

/**
 * Comment form before hook
 * @used_in comments.php
 */
function waht_comment_form_before() { do_action('waht_comment_form_before'); }

/**
 * Comment form after hook
 * @used_in comments.php
 */
function waht_comment_form_after() { do_action('waht_comment_form_after'); }

/**
 * Sidebar aside before hook
 * @used_in sidebar.php
 */
function waht_sidebar_before() { do_action('waht_sidebar_before'); }

/**
 * Sidebar aside inside before hook
 * @used_in sidebar.php
 */
function waht_sidebar_inside_before() { do_action('waht_sidebar_inside_before'); }

/**
 * Sidebar aside inside after hook
 * @used_in sidebar.php
 */
function waht_sidebar_inside_after() { do_action('waht_sidebar_inside_after'); }

/**
 * Sidebar aside after hook
 * @used_in sidebar.php
 */
function waht_sidebar_after() { do_action('waht_sidebar_after'); }

/**
 * Page wrap inside after hook
 * @used_in footer.php
 */
function waht_page_wrap_inside_after() { do_action('waht_page_wrap_inside_after'); }

/**
 * Page wrap after hook
 * @used_in footer.php
 */
function waht_page_wrap_after() { do_action('waht_page_wrap_after'); }

/**
 * Page footer before hook
 * @used_in footer.php
 */
function waht_page_footer_before() { do_action('waht_page_footer_before'); }

/**
 * Page footer inside before hook
 * @used_in footer.php
 */
function waht_page_footer_inside_before() { do_action('waht_page_footer_inside_before'); }

/**
 * Page footer inside after hook
 * @used_in footer.php
 */
function waht_page_footer_inside_after() { do_action('waht_page_footer_inside_after'); }

/**
 * Page footer after hook
 * @used_in footer.php
 */
function waht_page_footer_after() { do_action('waht_page_footer_after'); }

/**
 * Page footer hook: custom scripts
 * @used_in footer.php
 */
function waht_footer() { do_action('waht_footer'); }