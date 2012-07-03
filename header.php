<?php
/**
 * @description: File called by get_header()
 * @name       : header.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
<!doctype html>
<!-- TODO Add IEMobile support -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php get_template_directory_uri() ?>/favicon.ico">

    <title><?php wp_title('|', true, 'left'); bloginfo('name'); ?></title>

    <!-- Dublin Core Metadata : http://dublincore.org/ -->
    <meta name="dcterms.title" content="<?php bloginfo('name'); ?> ?>">
    <meta name="dcterms.subject" content="<?php bloginfo('description'); ?>">
    <meta name="dcterms.creator" content="<?php echo WAHT_AUTHOR_NAME ?>">
    <meta name="dcterms.rights" content="Copyright <?php echo WAHT_AUTHOR_NAME ?> <?php date('Y'); ?>. All rights
    reserved">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="page-header" role="banner">
    <div class="<?php waht_container_class(); ?>">
        <hgroup>
            <h1>
                <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name')?>">
                    <img class="logo" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>">
                    <span class="title"><?php bloginfo('name'); ?></span>
                </a>
            </h1>

            <h2>
                <span class="subtitle"><?php bloginfo('description'); ?></span>
            </h2>
        </hgroup>


        <nav role="navigation">
            <?php waht_main_nav_menu(); ?>
        </nav>
    </div>
</header>
<!-- #page-header -->

<div id="page-wrap" role="document">
    <div class="<?php waht_container_class(); ?>">