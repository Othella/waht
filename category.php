<?php
/**
 * @description: The category template. Used when a category is queried.
 * @name       : category.php
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
        <?php if (have_posts()) : ?>
        <?php the_post(); ?>
        <?php waht_post_before(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> xmlns="http://www.w3.org/1999/html">
            <header>
                <h1 class="page-title"><?php
                    printf(__('Category Archives: <span>%s</span>', 'waht'), single_cat_title('', false));
                    ?></h1>
                <?php
                $category_description = category_description();
                if (!empty($category_description))
                    echo apply_filters('category_archive_meta',
                        '<div class="category-archive-meta">' . $category_description . '</div>');
                ?>
            </header>
            <?php rewind_posts(); ?>
            <?php while (have_posts()) : the_post(); ?>
            <article>
                <header class="post-header">
                    <time class="updated" datetime="<?php the_time(); ?>" pubdate><?php the_date(); ?></time>
                    <h2><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                </header>
                <section class="post-content">
                    <?php the_excerpt(); ?>
                </section>
                <footer class="post-footer">
                    <p><?php _e('Posted in', 'waht') ?> <?php the_category(' | '); ?></p>
                </footer>
                <?php waht_post_inside_after(); ?>
            </article>
            <?php endwhile; ?>
            <nav class="pager post-nav">
                <div class="previous"><?php next_posts_link(__('&larr; Older Articles',
                    'waht')); ?></div>
                <div class="next"><?php previous_posts_link(__('Newer Articles &rarr;',
                    'waht'));
                    ?></div>
            </nav>
        </article>
        <?php waht_post_after(); ?>
        <?php else : ?>
        <?php // TODO (a.h) no posts founds ?>
        <?php _e('Sorry, no results match with your request! Maybe you could use the following search form :)', 'waht'); ?>
        <?php get_search_form(); ?>
        <?php endif; ?>
        <?php waht_loop_after(); ?>
    </section>
    <!-- /#main -->
    <?php waht_main_after(); ?>
    <?php get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer(); ?>