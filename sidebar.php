<?php
/**
 * @description: The content sidebar template.
 * @name       : sidebar.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
<?php waht_sidebar_before(); ?>
<aside id="complementary" class="<?php echo SIDEBAR_CLASSES; ?>">
    <?php waht_sidebar_inside_before(); ?>
    <?php if (is_active_sidebar('sidebar-main')) : ?>
    <?php dynamic_sidebar('sidebar-main'); ?>
    <?php else : ?>
    <p class="help">
        <?php _e('Activate some widgets!', 'waht'); ?>
    </p>
    <?php endif; ?>
    <?php waht_sidebar_inside_after(); ?>
</aside>
<!-- /#compementary -->
<?php waht_sidebar_after(); ?>