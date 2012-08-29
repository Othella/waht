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
    <?php get_template_part('content', get_post_format()) ?>
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