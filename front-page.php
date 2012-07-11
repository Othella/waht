<?php
/**
 * @description: Template for the front page
 * @name       : front-page.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

get_header(); ?>
<div id="content">
    <section id="main" role="main">
        <?php get_template_part('loop'); ?>
    </section><!-- /#main -->
    <aside id="complementary">

    </aside><!-- /#compementary -->
</div><!-- /#content -->

<?php get_footer();