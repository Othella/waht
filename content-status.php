<?php
/**
 * @description: Template for status content
 * @name       : content-status.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
<div class="avatar"><?php echo get_avatar(get_the_author_meta('ID'))?></div>
<?php the_content(); ?>