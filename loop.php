<?php
/**
 * @description:
 * @name: loop.php
 * @package: waht
 * @author: Amélie Husson (http://ameliehusson.com)
 * @uri: https://github.com/Othella/waht
 */

if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <section>
        <?php the_content(); ?>
    </section>
    <footer>
        <?php the_meta(); ?>
    </footer>
    <?php
    endwhile; else :
    // ToDo no posts founds
    _e('No posts found', 'waht');
endif;
