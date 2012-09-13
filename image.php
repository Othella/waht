<?php
/**
 * @description: Image attachment template. Used when viewing a single image attachment.
 * @name       : image.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
global $multipage, $numpages, $page, $post; ?>
<?php get_header(); ?>
<div id="content" class="<?php echo waht_container_classes(); ?>">
	<?php if (waht_has_left_main_sidebar()) get_sidebar(); ?>
	<?php waht_main_before(); ?>
    <section id="main" role="main" class="<?php echo waht_main_section_classes(); ?>">
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
                </h1><!-- /.entry-title -->
                <div class="entry-meta">
					<?php $metadata = wp_get_attachment_metadata(); ?>
					<?php printf(__('<span class="meta-prep meta-prep-post-date">Published </span> <span class="post-date"><abbr class="published" title="%1$s">%2$s</abbr></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Go back to %7$s" rel="gallery">%8$s</a>', 'waht'),
					esc_attr(get_the_time()),
					get_the_date(),
					esc_url(wp_get_attachment_url()),
					$metadata['width'],
					$metadata['height'],
					esc_url(get_permalink($post->post_parent)),
					esc_attr(strip_tags(get_the_title($post->post_parent))),
					get_the_title($post->post_parent)
				); ?>
                </div><!-- /.entry-meta -->
            </header><!-- /.entry-header -->
            <section class="entry-content">
                <div class="entry-attachment">
                    <div class="attachment">
						<?php
						$attachments = array_values(get_children(array(
							'post_parent'    => $post->post_parent,
							'post_status'    => 'inherit',
							'post_type'      => 'attachment',
							'post_mime_type' => 'image',
							'order'          => 'ASC',
							'orderby'        => 'menu_order_ID'
						)));
						foreach ($attachments as $a => $attachment) :
							if ($attachment->ID == $post->ID)
								break;
						endforeach;
						if (count($attachments) > 1):
							if (isset($attachments[$a]))
								$next_attachment_url = get_attachment_link($attachments[$a]->ID);
							else
								$next_attachment_url = get_attachment_link($attachments[0]->ID);
						else :
							$next_attachment_url = wp_get_attachment_url();
						endif;
						$attachments_size = apply_filters('waht_attachment_size', 848);
						?>
                        <a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php the_title_attribute(); ?>"
                           rel="attachment"><?php echo wp_get_attachment_image($post->ID, array($attachments_size, 1024)); ?></a>
						<?php if (!empty($post->post_excerpt)) : ?>
                        <div class="entry-caption">
							<?php the_excerpt(); ?>
                        </div>
						<?php endif; ?>
                    </div><!-- /.attachment -->
                </div><!-- /.entry-attachment -->
                <div class="entry-description">
					<?php the_content(); ?>
                </div><!-- /.entry-description -->
            </section>
            <!-- /.entry-content -->
            <footer class="entry-footer">
				<?php waht_link_pages(); ?>
				<?php waht_meta(); ?>
            </footer><!-- /.entry-footer -->
			<?php comments_template(); ?>
			<?php waht_post_inside_after(); ?>
        </article><!-- /#post-<?php the_ID(); ?> -->
		<?php waht_post_after(); ?>
		<?php endwhile; ?>
		<?php waht_loop_after(); ?>
    </section>
    <!-- /#main -->
	<?php waht_main_after(); ?>
	<?php if (waht_has_right_main_sidebar()) get_sidebar(); ?>
</div><!-- /#content -->

<?php get_footer();