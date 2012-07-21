<?php
/**
 * @description: Main loop template to display posts
 * @name       : loop.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
waht_loop_before();
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
    <article class="post-<?php the_ID(); ?>">
        <header>
            <h1><?php the_title(); ?></h1>
        </header>
        <section>
            <?php the_content(); ?>
        </section>
        <footer>
            <?php the_meta(); ?>
        </footer>
    </article>
    <?php endwhile; ?>
<?php else : ?>
<?php // ToDo no posts founds ?>
<?php _e('No posts found', 'waht'); ?>
<?php endif;
waht_loop_after();