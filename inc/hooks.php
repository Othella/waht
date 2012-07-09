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