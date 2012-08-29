<?php
/**
 * @description: Default template for content
 * @name       : content.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> xmlns="http://www.w3.org/1999/html">
    <?php waht_post_inside_before(); ?>
    <header class="post-header">
        <time class="updated" datetime="<?php the_time(); ?>" pubdate><?php the_date(); ?></time>
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
        <p><?php _e('Posted in', 'waht') ?> <?php the_category(' | '); ?></p>
    </footer>
    <?php waht_post_inside_after(); ?>
</article>