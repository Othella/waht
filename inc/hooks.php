<?php
/**
 * @description: Defines hooks for waht
 * @name       : inc/hooks.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// head (custom links and tags - in header.php)
function waht_head() { do_action('waht_head'); }

// page header hooks (in header.php)
function waht_page_header_before() { do_action('waht_page_header_before');}
function waht_page_header_after() { do_action('waht_page_header_after');}

// page wrap hooks (in header.php and footer.php)
function waht_page_wrap_before() { do_action('waht_page_wrap_before');}
function waht_page_wrap_after() { do_action('waht_page_wrap_after');}

// page footer hooks (in footer.php)
function waht_page_footer_before() { do_action('waht_page_footer_before');}
function waht_page_footer_after() { do_action('waht_page_footer_after');}

// footer (custom scripts - in footer.php)
function waht_footer() { do_action('waht_footer'); }