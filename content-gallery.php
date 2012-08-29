<?php
/**
 * @description: Template for gallery content
 * @name       : content-gallery.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
global $post;
// Get all images of the gallery
$images = get_children(array(
    'post_parent'    => $post->ID,
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
));
if ($images) :
    $images_count = count($images);
    $image        = array_shift($images);
    $image_thumb  = wp_get_attachment_image($image->ID, 'thumbnail'); ?>
<figure class="gallery-thumb">
    <a href="<?php the_permalink(); ?>"
       title="<?php printf(esc_attr('Permalink to %s', 'waht'), the_title_attribute('echo=0')); ?>"><?php echo $image_thumb ?></a>
</figure>
<p>
    <em><?php printf(_n('This gallery contains <a %1$s>%2$s photo</a>', 'This gallery contains <a %1$s>%2$s photos</a>', $images_count, 'waht'),
        'href="' . esc_url(get_permalink()) . '" title="' .
            sprintf(esc_attr__('Permalink to %s', 'waht'), the_title_attribute('echo=0')) .
            '" rel="bookmark"', number_format_i18n($images_count)); ?></em></p>
<?php else : ?>
<?php _e('Add some photos to this gallery!', 'waht'); ?>
<?php endif; ?>
<?php the_excerpt(); ?>