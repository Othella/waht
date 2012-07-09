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
    <link rel="shortcut icon" href="<?php get_template_directory_uri(); ?>/favicon.ico">

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

<?php waht_page_header_before(); ?>
<header id="page-header" role="banner">
    <div class="<?php waht_container_class(); ?>">
        <hgroup>
            <h1>
                <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                    <img class="logo" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>">
                    <span class="title"><?php bloginfo('name'); ?></span>
                </a>
            </h1>

            <h2>
                <span class="subtitle"><?php bloginfo('description'); ?></span>
            </h2>
        </hgroup>

        <?php if (WAHT_NAVBAR && WAHT_BOOTSTRAP) { // Use a bootstrap navbar ?>
        <nav role="navigation" class="navbar<?php if (WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR) echo ' navbar-fixed-top';?>">
            <div class="navbar-inner">
                <div class="<?php waht_container_class(); ?>">
                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <!-- Everything you want hidden at 940px or less, place within here -->
                    <nav id="nav-main" class="nav-collapse" role="navigation">
                        <?php waht_main_nav_menu(); ?>
                        <!-- .nav, .navbar-search, .navbar-form, etc -->
                    </nav>
                </div>
            </div>
        </nav>
        <?php } else { // use a simple menu ?>
        <nav role="navigation">
            <?php waht_main_nav_menu(); ?>
        </nav>
        <?php } ?>
    </div>
</header>
<!-- #page-header -->
<?php waht_page_header_after(); ?>

<?php waht_page_wrap_before(); ?>
<div id="page-wrap" role="document">
    <div class="<?php waht_container_class(); ?>">