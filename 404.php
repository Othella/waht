<?php
/**
 * @description: The 404 Not Found template. Used when WordPress cannot find a post or page that matches the query.
 * @name       : 404.php
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
		<?php waht_post_before(); ?>
		<?php waht_post_inside_before(); ?>
        <article id="post-0" class="hentry">
            <header class="post-header">
                <h1 class="post-title"><?php _e('Page not found!', 'waht'); ?></h1>
            </header>
            <section class="post-content">
                <div class="alert alert-block fade in">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <p><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'waht'); ?></p>
                </div>

                <p><?php _e('Please try the following:', 'waht'); ?></p>
                <ul>
                    <li><?php _e('Check your spelling', 'waht'); ?></li>
                    <li><?php printf(__('Return to the <a href="%s">home page</a>', 'waht'), home_url()); ?></li>
                    <li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'waht'); ?></li>
                </ul>

				<?php get_search_form(); ?>
            </section>
            <footer class="post-footer">
            </footer>
        </article>
		<?php waht_post_inside_after(); ?>
		<?php waht_post_after(); ?>
		<?php waht_loop_after(); ?>
    </section>
    <!-- /#main -->
	<?php waht_main_after(); ?>
	<?php get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer();