<?php
/**
 * @description: The comments template.
 * @name       : comments.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

/**
 * Comments layout
 */
function waht_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="clearfix">
        <header class="comment-author vcard">
            <?php $avatar_size = ('0' != $comment->comment_parent) ? 32 : 48; ?>
            <?php echo get_avatar($comment, $avatar_size); ?>
            <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
            <time pubdate datetime="<?php comment_date('c'); ?>"><a href="<?php comment_link($comment->comment_ID); ?>"
                                                                    title="<?php _e('Open comment', 'waht'); ?>"><?php printf('%1$s', get_comment_date(), get_comment_time()); ?></a>
            </time>
            <?php edit_comment_link(__('Edit', 'waht'), '<span class="btn"><i class="icon-edit"></i> ', '</span>'); ?>
        </header>

        <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-block fade in">
            <a class="close" data-dismiss="alert">&times;</a>
            <p><?php _e('Your comment is awaiting moderation..', 'waht'); ?></p>
        </div>
        <?php endif; ?>

        <section class="comment">
            <?php comment_text(); ?>
        </section>

        <footer>
            <?php comment_reply_link(array_merge($args, array(
            'before'     => '<span class="btn">',
            'after'      => '</span>',
            'reply_text' => __('<i class="icon-pencil"></i> Reply', 'waht'),
            'depth'      => $depth,
            'max_depth'  => $args['max_depth']))); ?>
        </footer>
    </article>
</li>
<?php } ?>

<?php if (post_password_required()) : ?>
<section id="post-comments">
    <div class="alert alert-block fade in">
        <a class="close" data-dismiss="alert">&times;</a>
        <p><?php _e('This post is password protected. Please enter the password to view comments.', 'waht'); ?></p>
    </div>
</section>
<?php return; ?>
<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
<section id="post-comments">
    <div class="alert alert-block fade in">
        <a class="close" data-dismiss="alert">&times;</a>
        <p><?php _e('Comments are closed', 'waht'); ?></p>
    </div>
    <?php return; ?>
</section>
<?php endif; ?>

<?php if (have_comments()) : ?>
<?php waht_comments_before(); ?>
<section id="post-comments">
    <header>
        <h3><?php printf(_n('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'waht'), number_format_i18n(get_comments_number()), get_the_title()); ?></h3>
        <nav class="pager">
            <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'waht'));?></div>
            <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'waht'));?></div>
        </nav>
    </header>
    <section class="comments-list">
        <ol>
            <?php wp_list_comments(array('callback' => 'waht_comments')); ?>
        </ol>
    </section>
    <footer>
        <nav class="pager">
            <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'waht'));?></div>
            <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'waht'));?></div>
        </nav>
    </footer>
</section>
<?php waht_comments_after(); ?>
<p><?php _e('', 'waht'); ?></p>
<?php endif; ?>

<?php if (comments_open()) : ?>
<?php waht_comment_form_before(); ?>
<?php waht_comment_form_after(); ?>
<?php endif; ?>