<?php
/**
 * @description: Loop template to display a single post
 * @name       : loop-single.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 * @used_in    : single.php
 */
global $multipage, $numpages, $page;
?>
<?php waht_loop_before(); ?>
<?php while (have_posts()) : the_post(); ?>
<?php waht_post_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
    <?php waht_post_inside_before(); ?>
    <header class="post-header">
        <h1 class="post-title">
            <?php the_title(); ?>
            <?php if ($multipage) : ?>
            <span class="page-number">(<?php printf(esc_attr('Page %s of %s', 'waht'), $page, $numpages); ?>)</span>
            <?php endif ?>
        </h1>
    </header>
    <section class="post-content">
        <?php the_content(); ?>
    </section>
    <footer class="post-footer">
        <?php waht_link_pages(); ?>
        <?php waht_meta(); ?>
    </footer>
    <?php comments_template(); ?>
    <?php waht_post_inside_after(); ?>
</article>
<?php waht_post_after(); ?>
<?php endwhile; ?>
<?php waht_loop_after();