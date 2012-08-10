<?php
/**
 * @description: The single post template. Used when a single post is queried.
 * @name       : single.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// TODO Code single.php
?>
<?php get_header(); ?>
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