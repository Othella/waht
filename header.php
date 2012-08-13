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
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="shortcut icon" href="<?php get_template_directory_uri(); ?>/favicon.ico">

    <title><?php waht_dynamic_title(); ?></title>

    <!-- Dublin Core Metadata : http://dublincore.org/ -->
    <meta name="dcterms.title" content="<?php bloginfo('name'); ?> ?>">
    <meta name="dcterms.subject" content="<?php bloginfo('description'); ?>">
    <meta name="dcterms.creator" content="<?php echo WAHT_AUTHOR_NAME ?>">
    <meta name="dcterms.rights" content="Copyright <?php echo WAHT_AUTHOR_NAME ?> <?php date('Y'); ?>. All rights
    reserved">

    <?php if (WAHT_RESPONSIVE) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0"><?php } ?>

    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <?php waht_head(); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!--[if lt IE 7]>
<div class="alert">
    <p><a href="http://www.whatbrowser.org/" title="Meet your browser" target="_blank">Your browser</a> is
        <em>ancient!</em> <a href="http://browsehappy.com/" title="Upgrade your browser" target="_blank">Upgrade to a
            modern browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true"
                                     title="Install Google Chrome Frame" target="_blank">install Google Chrome Frame</a>
        to experience this site.</p>
</div><![endif]-->

<?php waht_page_header_before(); ?>
<header id="page-header" role="banner">
    <div class="<?php waht_container_class(); ?>">

        <hgroup class="row-fluid">
            <h1 class="title span4">
                <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                    <img class="logo" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>">
                    <span><?php bloginfo('name'); ?></span>
                </a>
            </h1>

            <h2 class="subtitle span8">
                <span><?php bloginfo('description'); ?></span>
            </h2>
        </hgroup>

        <?php if (WAHT_NAVBAR && WAHT_BOOTSTRAP) { // Use a bootstrap navbar ?>

        <nav role="navigation" class="navbar<?php if (WAHT_USE_BOOTSTRAP_FIXED_TOP_NAVBAR) echo ' navbar-fixed-top';?>">
            <div class="navbar-inner">
                <div class="<?php echo CONTAINER_CLASSES; ?>">
                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo home_url(); ?>/">
                        <?php bloginfo('name'); ?>
                    </a>

                    <!-- Everything you want hidden at 940px or less, place within here -->
                    <nav id="nav-main" class="nav-collapse" role="navigation">
                        <?php waht_main_nav_menu(); ?>
                        <!-- .nav, .navbar-search, .navbar-form, etc -->
                    </nav>
                </div>
            </div>
        </nav>

        <nav role="navigation" class="navbar">
            <div class="navbar-inner">
                <div class="<?php echo CONTAINER_CLASSES; ?>">
                    <?php waht_additional_nav_menu(); ?>
                </div>
            </div>
        </nav>

        <?php } else { // use a simple menu ?>

        <nav role="navigation" class="main-navigation">
            <?php waht_main_nav_menu(); ?>
        </nav>

        <nav role="navigation" class="additional-navigation">
            <?php waht_additional_nav_menu(); ?>
        </nav>
        <?php } ?>
    </div>

</header><!-- #page-header -->
<?php waht_page_header_after(); ?>

<?php waht_page_wrap_before(); ?>
<div id="page-wrap" role="document">
    <div class="<?php waht_container_class(); ?>">