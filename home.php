<?php
/**
 * @description : The home page template, which is the front page by default.
 *              If you use a static front page this is the template for the page with the latest posts.
 * @name        : home.php
 * @package     : waht
 * @author      : Amélie Husson (http://ameliehusson.com)
 * @uri         : https://github.com/Othella/waht
 */

// TODO Code home.php
?>
<?php get_header(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php echo MAIN_CLASSES; ?>">
        <?php get_template_part('loop'); ?>
    </section>
    <!-- /#main -->
    <?php waht_main_after(); ?>
    <?php get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer();