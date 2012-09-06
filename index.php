<?php
/**
 * @description: Main template file
 * @name       : index.php
 * @package    : waht
 * @author     : Amélie Husson
 * @uri        : https://github.com/Othella/waht
 */
?>
<?php get_header(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php if (waht_has_left_main_sidebar()) get_sidebar(); ?>
    <?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php waht_main_section_classes(); ?>">
        <?php get_template_part('loop'); ?>
    </section>
    <!-- /#main -->
    <?php waht_main_after(); ?>
	<?php if (waht_has_right_main_sidebar()) get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer();