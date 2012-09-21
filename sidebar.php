<?php
/**
 * @description: The content template for the main sidebar.
 * @name       : sidebar.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */

if (waht_has_main_sidebar()) : // Only display if sidebar is allowed
	?>
<?php waht_sidebar_before(); ?>
<aside id="complementary" class="<?php echo waht_main_sidebar_classes(); ?>">
	<?php waht_sidebar_inside_before(); ?>
	<?php if (is_active_sidebar('sidebar-main')) : ?>
	<?php dynamic_sidebar('sidebar-main'); ?>
	<?php else : ?>
    <p class="help">
		<?php _e('Activate some widgets in the Main Sidebar!', 'waht'); ?>
    </p>
	<?php endif; ?>
	<?php waht_sidebar_inside_after(); ?>
</aside>
<!-- /#compementary -->
<?php waht_sidebar_after();
endif;
?>