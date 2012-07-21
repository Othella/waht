<?php
/**
 * @description: Template for the front page
 * @name       : front-page.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

get_header(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php echo MAIN_CLASSES; ?>">
        <?php get_template_part('loop'); ?>
    </section>
    <!-- /#main -->
    <?php waht_main_after(); ?>
    <?php waht_sidebar_before(); ?>
    <aside id="complementary" class="<?php echo SIDEBAR_CLASSES; ?>">

    </aside>
    <!-- /#compementary -->
    <?php waht_sidebar_after(); ?>
</div><!-- /#content -->

<?php get_footer();