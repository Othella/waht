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
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php waht_post_inside_before(); ?>
        <header class="post-header">
            <h2><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        </header>
        <section class="post-content">
            <?php if (is_archive() || is_search()) : ?>
            <?php the_excerpt(); ?>
            <?php else : ?>
            <?php the_content(); ?>
            <?php endif; ?>
        </section>
        <footer class="post-footer">
            <?php the_meta(); ?>
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
<?php // TODO (a.h) no posts founds ?>
<?php _e('Sorry, no results match with your request! Maybe you could use the following search form :)', 'waht'); ?>
<?php get_search_form(); ?>
<?php endif; ?>
<?php waht_loop_after();