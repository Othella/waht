<?php
/**
 * @description: The comments template.
 * @name       : comments.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
global $user_identity, $comment_author, $comment_author_email, $comment_author_url, $post;
$req = get_option('require_name_email');

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
<section id="comments" class="posts-comments">
    <header>
        <h3><?php printf(_n('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'waht'), number_format_i18n(get_comments_number()), get_the_title()); ?></h3>
        <nav class="pager comment-nav">
            <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'waht'));?></div>
            <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'waht'));?></div>
        </nav>
    </header>
    <section class="comments-list">
        <ol>
            <?php wp_list_comments(array('callback' => 'waht_comments')); // TODO (a.h) Separate comments from backlinks ?>
        </ol>
    </section>
    <footer>
        <nav class="pager comment-nav">
            <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'waht'));?></div>
            <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'waht'));?></div>
        </nav>
    </footer>
</section>
<?php waht_comments_after(); ?>
<?php else : ?>
<?php if (comments_open()) : ?>
    <p><?php _e('Be the first to leave a comment!', 'waht'); ?></p>
    <?php else : ?>
    <section id="post-comments">
        <div class="alert alert-block fade in">
            <a class="close" data-dismiss="alert">&times;</a>
            <p><?php _e('Comments are closed', 'waht'); ?></p>
        </div>
    </section>
    <?php endif; ?>
<?php endif; ?>

<?php if (comments_open()) : ?>
<?php waht_comment_form_before(); ?>
<section id="respond" class="post-respond">
    <header>
        <h3><?php comment_form_title(__('Leave a comment', 'waht'), __('Reply to %s', 'waht')); ?></h3>
        <p class="cancel-comment-reply"><?php cancel_comment_reply_link(__('Cancel comment', 'waht')); ?></p>
        <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
        <div class="alert alert-block fade in">
            <a class="close" data-dismiss="alert">&times;</a>
            <p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'waht'),
                '<a href="' . wp_login_url(get_permalink()) . '">', '</a>'); ?></p>
        </div>
        <?php else : ?>
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"
              class="form-horizontal">
            <?php if (is_user_logged_in()) : ?>
            <p class="comments-logged-in-as"><?php _e('Logged in as', 'waht')?> <a
                    href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"
                    title="<?php _e('Go to profile', 'waht'); ?>"><?php echo $user_identity; ?></a>. <a
                    href="<?php echo wp_logout_url(get_permalink()); ?>"
                    title="<?php _e('Log out', 'waht'); ?>"><?php _e('Log out', 'waht'); ?></a></p>
            <?php else : ?>
            <fieldset>
                <div class="control-group">
                    <label class="control-label"
                           for="author"><?php _e('Name', 'waht'); ?></label>
                    <div class="controls">
                        <input type="text" class="text input-xlarge" name="author" id="author"
                               value="<?php echo esc_attr($comment_author); ?>"
                               tabindex="1" <?php if ($req) echo 'aria-required="true"' ?>
                               placeholder="<?php _e('Eg.: John Doe', 'waht'); ?>">
                        <?php if ($req) : ?>
                        <p class="help-inline"><?php _e('(required)', 'waht'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"
                           for="email"><?php _e('Email', 'waht'); ?></label>
                    <div class="controls">
                        <input type="email" class="text input-xlarge" name="email" id="email"
                               value="<?php echo esc_attr($comment_author_email); ?>"
                               tabindex="2" <?php if ($req) echo 'aria-required="true"' ?>
                               placeholder="<?php _e('Eg.: name@your-company.com', 'waht'); ?>">
                        <?php if ($req) : ?>
                        <p class="help-inline"><?php _e('(required)', 'waht'); ?></p>
                        <?php endif; ?>
                        <p class="help-block"><?php _e('(Your email will not be published)', 'waht'); ?></p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"
                           for="url"><?php _e('Website', 'waht'); ?></label>
                    <div class="controls">
                        <input type="url" class="text input-xlarge" name="url" id="url"
                               value="<?php echo esc_attr($comment_author_url); ?>"
                               tabindex="3" <?php if ($req) echo 'aria-required="true"' ?>
                               placeholder="<?php _e('Eg. : http://www.my-company.com', 'waht'); ?>">
                        <?php if ($req) : ?>
                        <p class="help-inline"><?php _e('(required)', 'waht'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </fieldset>
            <?php endif; ?>
            <div class="control-group">
                <label class="control-label" for="comment"><?php _e('Comment', 'waht'); ?></label>
                <div class="controls">
                    <textarea name="comment" id="comment" class="input-xlarge" tabindex="4"
                              placeholder="<?php _e('Eg.: This post rocks!', 'waht'); ?>"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" id="submit" tabindex="5"
                       value="<?php _e('Submit Comment', 'waht'); ?>">
            </div>
            <?php comment_id_fields(); ?>
            <?php do_action('comemnt_form', $post->ID); ?>
        </form>
        <?php endif; ?>
    </header>
    <section>

    </section>
    <footer>

    </footer>
</section>
<?php waht_comment_form_after(); ?>
<?php endif; ?>