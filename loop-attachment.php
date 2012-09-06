<?php
/**
 * @description: Attachment loop template. Used when viewing a single attachment.
 * @name       : ${FILE_NAME}
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
global $multipage, $numpages, $page;
?>
<?php waht_loop_before(); ?>
<?php while (have_posts()) : the_post(); ?>
<?php waht_post_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('attachment'); ?>>
	<?php waht_post_inside_before(); ?>
    <header class="entry-header">
        <h1 class="entry-title">
			<?php the_title(); ?>
			<?php if ($multipage) : ?>
            <span class="page-number">(<?php printf(esc_attr('Page %s of %s', 'waht'), $page, $numpages); ?>)</span>
			<?php endif ?>
        </h1>
    </header>
    <section class="entry-content">
		<?php get_template_part('content', get_post_type()) ?>
    </section>
    <footer class="entry-footer">
		<?php waht_link_pages(); ?>
		<?php waht_meta(); ?>
    </footer>
	<?php comments_template(); ?>
	<?php waht_post_inside_after(); ?>
</article>
<?php waht_post_after(); ?>
<?php endwhile; ?>
<?php waht_loop_after();