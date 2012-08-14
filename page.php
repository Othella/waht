<?php
/**
 * @description: The page template. Used when an individual Page is queried.
 * @name       : page.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// TODO Code page.php
?>
<?php get_header(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php echo MAIN_CLASSES; ?>">
        <?php get_template_part('loop', 'page'); ?>
    </section>
    <!-- /#main -->
    <?php waht_main_after(); ?>
    <?php get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer();