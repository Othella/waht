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
    <link rel="shortcut icon" href="<?php echo waht_get_assets_uri(); ?>/img/favicon.ico">

    <title><?php waht_dynamic_title(); ?></title>
    <!-- TODO (a.h) Add SEO friendy meta tags (description, keywords, etc -->

    <!-- Dublin Core Metadata : http://dublincore.org/ -->
    <meta name="dcterms.title" content="<?php bloginfo('name'); ?> ?>">
    <meta name="dcterms.subject" content="<?php bloginfo('description'); ?>">
    <meta name="dcterms.creator" content="<?php echo WAHT_AUTHOR_NAME ?>">
    <meta name="dcterms.rights" content="Copyright <?php echo WAHT_AUTHOR_NAME ?> <?php date('Y'); ?>. All rights
    reserved">

	<?php if (waht_is_responsive()) { ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><?php } ?>

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
	<?php waht_page_header_inside_before(); ?>

    <!-- Main navigation -->
	<?php if (waht_use_navbar()) : /* Use a navbar for the main navigation */ ?>
	<?php waht_top_navbar(); ?>
	<?php else : /* use a simple menu */ ?>
    <nav role="navigation" class="main-navigation<?php if (waht_use_top_fixed_nav()) echo ' fixed';?>">
		<?php waht_main_nav_menu(); ?>
    </nav>
	<?php endif; ?>

    <div class="<?php echo waht_wrapper_classes(); ?>">
        <div class="<?php echo waht_container_classes(); ?>">
            <!-- Site logo, name, description, etc. -->
            <div class="<?php echo waht_use_foundation_framework() ? 'four columns' : 'span4'; ?>">
                <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" class="logo">
                    <img src="<?php header_image(); ?>" alt="<?php bloginfo('name');?>">
                </a>
            </div>

            <hgroup class="<?php echo waht_use_foundation_framework() ? 'eight columns' : 'span8'; ?>">
                <h1 class="title">
                    <span><?php bloginfo('name'); ?></span>
                </h1>

                <h2 class="subtitle <?php if (waht_use_foundation_framework()) echo 'subheader'; ?>">
                    <span><?php bloginfo('description'); ?></span>
                </h2>
            </hgroup>
        </div>

        <div class="<?php echo waht_container_classes(); ?>">
            <!-- Second navigation -->
            <nav role="navigation" class="additional-navigation <?php if (waht_use_sticky_additional_nav()) echo 'sticky' ?><?php echo waht_use_foundation_framework() ? 'twelve columns' : 'span12'; ?>">
				<?php waht_additional_nav_menu(); ?>
            </nav>
        </div>
    </div>

	<?php waht_page_header_inside_after(); ?>
</header><!-- #page-header -->
<?php waht_page_header_after(); ?>

<?php waht_page_wrap_before(); ?>
<div id="page-wrap" role="document">
	<?php waht_page_wrap_inside_before(); ?>
    <div class="<?php echo waht_wrapper_classes(); ?>">