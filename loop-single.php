<?php
/**
 * @description: Loop template to display a single post
 * @name       : loop-single.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 * @used_in    : single.php
 */
?>
<?php waht_loop_before(); ?>
<?php while (have_posts()) : the_post(); ?>
<?php waht_post_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
    <?php waht_post_inside_before(); ?>
    <header class="post-header">
        <h1><?php the_title(); ?></h1>
    </header>
    <section class="post-content">
        <?php the_content(); ?>
    </section>
    <footer class="post-footer">
        <?php wp_link_pages(array('before' => '<nav id="page-nav" class="pagination"><p>' . __('Pages:', 'waht'),
                                  'after'  => '</p></nav>')); ?>
        <?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
    </footer>
    <?php comments_template(); ?>
    <?php waht_post_inside_after(); ?>
</article>
<?php waht_post_after(); ?>
<?php endwhile; ?>
<?php waht_loop_after();