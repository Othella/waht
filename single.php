<?php
/**
 * @description: The single post template. Used when a single post is queried.
 * @name       : single.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
<?php get_header(); ?>
<div id="content" class="<?php echo waht_container_classes(); ?>">
	<?php if (waht_has_left_main_sidebar()) get_sidebar(); ?>
    <?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php echo waht_main_section_classes(); ?>">
        <?php get_template_part('loop', 'single'); ?>
    </section>
    <!-- /#main -->
    <?php waht_main_after(); ?>
	<?php if (waht_has_right_main_sidebar()) get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer();