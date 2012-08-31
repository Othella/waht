<?php
/**
 * @description: Loop template to display content of a page
 * @name       : loop-page.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 * @used_in    : page.php, page-fullwidth.php
 */
?>
<?php waht_loop_before(); ?>
<?php while (have_posts()) : the_post(); ?>
<?php waht_post_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
    <?php waht_post_inside_before(); ?>
    <header class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
    </header>
    <section class="post-content">
        <?php get_template_part( 'content', get_post_format() ); ?>
    </section>
    <footer class="post-footer">
        <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
    </footer>
    <?php comments_template(); ?>
    <?php waht_post_inside_after(); ?>
</article>
<?php waht_post_after(); ?>
<?php endwhile; ?>
<?php waht_loop_after();