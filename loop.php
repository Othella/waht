<?php
/**
 * @description: Main loop template to display posts
 * @name       : loop.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 * @used_in    : home.php, index.php, front-page.php
 */
?>
<?php waht_loop_before(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	<?php waht_post_before(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> xmlns="http://www.w3.org/1999/html">
		<?php waht_post_inside_before(); ?>
        <header class="entry-header">
            <hgroup>
                <h2 class="entry-title"><a href="<?php the_permalink()?>"
                                           title="<?php printf(esc_attr__('Permalink to %s', 'waht'), the_title_attribute('echo=0')); ?>"
                                           rel="bookmark"><?php the_title(); ?></a></h2>

                <h3 class="entry-format"><?php echo ucfirst(get_post_format()); ?></h3>
            </hgroup>

            <time class="updated" datetime="<?php the_time(); ?>" pubdate><?php the_date(); ?></time>
			<?php if (comments_open() && !post_password_required()) : ?>
            <span class="comments-link">
                <?php comments_popup_link('<span class="leave-comment">' . __('Leave a comment', 'waht') .
				'</span>', _x('1', 'comments number', 'waht'), _x('%', 'comments number', 'waht')); ?>
            </span>
			<?php endif; ?>
        </header>
        <section class="entry-content">
			<?php if (is_archive() || is_search()) : ?>
			<?php the_excerpt(); ?>
			<?php else : ?>
			<?php get_template_part('content', get_post_format()); ?>
			<?php endif; ?>
        </section>
        <footer class="entry-footer">
            <span class="entry-classes"><?php _e('Posted in', 'waht') ?> <?php the_category(' | '); ?></span>
			<?php if (comments_open()) : ?>
            <span class="comments-link"><?php comments_popup_link(
				'<span class="leave-comment">' . __('Comment', 'waht') .
					'</span>', __('<b>1</b> Comment', 'waht'), __('<b>%</b> Comments', 'waht')); ?></span>
			<?php endif; ?>
			<?php edit_post_link(__('Edit', 'waht'), '<span class="edit-link">', '</span>'); ?>
        </footer>
		<?php waht_post_inside_after(); ?>
    </article>
	<?php waht_post_after(); ?>
	<?php endwhile; ?>
<nav class="pager post-nav">
    <div class="previous"><?php next_posts_link(__('&larr; Older Articles',
		'waht')); ?></div>
    <div class="next"><?php previous_posts_link(__('Newer Articles &rarr;',
		'waht'));
		?></div>
</nav>
<?php else : ?>
<?php waht_no_posts_div(); ?>
<?php endif; ?>
<?php waht_loop_after();