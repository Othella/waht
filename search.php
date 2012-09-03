<?php
/**
 * @description: The search results template. Used when a search is performed.
 * @name       : search.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
<?php get_header(); ?>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php echo MAIN_CLASSES; ?>">
		<?php waht_loop_before(); ?>
		<?php if (have_posts()) : ?>
		<?php the_post(); ?>
		<?php waht_post_before(); ?>
        <header class="content-header">
            <h1 class="page-title"><?php
				printf(__('Search Results for: <span>%s</span>', 'waht'), esc_attr(get_search_query()));
				?></h1>
        </header>
		<?php rewind_posts(); ?>
		<?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> xmlns="http://www.w3.org/1999/html">
                <header class="post-header">
                    <time class="updated" datetime="<?php the_time(); ?>" pubdate><span><?php the_date(); ?></span>
                    </time>
                    <h2 class="post-title"><a href="<?php the_permalink()?>"
                                              title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                </header>
                <section class="post-content">
					<?php get_template_part('content', get_post_format()); ?>
                </section>
                <footer class="post-footer">
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
        <div class="alert alert-block fade in">
            <a class="close" data-dismiss="alert">&times;</a>
            <p><?php _e('Sorry, no results match with your request! Maybe you could use the following search form?', 'waht'); ?></p>
        </div>
		<?php get_search_form(); ?>
		<?php endif; ?>
		<?php waht_loop_after(); ?>
    </section>
    <!-- /#main -->
	<?php waht_main_after(); ?>
	<?php get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer(); ?>