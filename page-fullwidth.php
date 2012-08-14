<?php
/**
 * @description: Template for full width pages
 * @name       : page-fullwidth.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

// TODO Code page-fullwidth.php
?>
<?php get_header(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php echo FULLWIDTH_CLASSES; ?>">
        <?php get_template_part('loop', 'page'); ?>
    </section>
    <!-- /#main -->
    <?php waht_main_after(); ?>
</div><!-- /#content -->

<?php get_footer();