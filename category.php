<?php
/**
 * @description: The category template. Used when a category is queried.
 * @name       : category.php
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
		<?php waht_loop_before(); ?>
		<?php if (have_posts()) : ?>
		<?php the_post(); ?>
		<?php waht_post_before(); ?>
        <header class="content-header">
            <h1 class="page-title"><?php
				printf(__('<span>%s</span> Archive', 'waht'), single_cat_title('', false));
				?></h1>
			<?php
			$category_description = category_description();
			if (!empty($category_description))
				echo apply_filters('category_archive_meta',
					'<div class="category-archive-meta">' . $category_description . '</div>');
			?>
        </header>
		<?php rewind_posts(); ?>
		<?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> xmlns="http://www.w3.org/1999/html">
                <header class="entry-header">
                    <time class="updated" datetime="<?php the_time(); ?>" pubdate><span><?php the_date(); ?></span>
                    </time>
                    <h2 class="entry-title"><a href="<?php the_permalink()?>"
                                              title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                </header>
                <section class="entry-content">
					<?php get_template_part('content', get_post_format()); ?>
                </section>
                <footer class="entry-footer">
                </footer>
				<?php waht_post_inside_after(); ?>
            </article>
			<?php endwhile; ?>
        <footer class="content-footer">
            <nav class="pager post-nav">
                <div class="previous"><?php next_posts_link(__('&larr; Older Articles',
					'waht')); ?></div>
                <div class="next"><?php previous_posts_link(__('Newer Articles &rarr;',
					'waht'));
					?></div>
            </nav>
        </footer>
		<?php waht_post_after(); ?>
		<?php else : ?>
		<?php waht_no_posts_div() ?>
		<?php endif; ?>
		<?php waht_loop_after(); ?>
    </section>
    <!-- /#main -->
	<?php waht_main_after(); ?>
	<?php if (waht_has_right_main_sidebar()) get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer(); ?>