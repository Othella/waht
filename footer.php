<?php
/**
 * @description: File called by get_footer()
 * @name       : footer.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
</div>
<?php waht_page_wrap_inside_after(); ?>
</div><!-- /#page-wrap -->
<?php waht_page_wrap_after(); ?>

<?php waht_page_footer_before(); ?>
<footer id="page-footer">
    <div class="<?php echo waht_wrapper_classes(); ?>">
		<?php waht_page_footer_inside_before(); ?>
        <section class="footer-sidebars <?php echo waht_container_classes(); ?>">
            <section class="sidebar-footer-left <?php echo waht_footer_sidebar_classes(); ?>">
				<?php if (is_dynamic_sidebar('sidebar-footer-left')) : ?>
				<?php dynamic_sidebar('sidebar-footer-left'); ?>
				<?php else : ?>
                <p class="help">
					<?php _e('Activate some widgets in the Left Footer Sidebar!', 'waht'); ?>
                </p>
				<?php endif; ?>
            </section>
            <section class="sidebar-footer-center <?php echo waht_footer_sidebar_classes(); ?>">
				<?php if (is_dynamic_sidebar('sidebar-footer-center')) : ?>
				<?php dynamic_sidebar('sidebar-footer-center'); ?>
				<?php else : ?>
                <p class="help">
					<?php _e('Activate some widgets in the Center Footer Sidebar!', 'waht'); ?>
                </p>
				<?php endif; ?>
            </section>
            <section class="sidebar-footer-right <?php echo waht_footer_sidebar_classes(); ?>">
				<?php if (is_dynamic_sidebar('sidebar-footer-right')) : ?>
				<?php dynamic_sidebar('sidebar-footer-right'); ?>
				<?php else : ?>
                <p class="help">
					<?php _e('Activate some widgets in the Right Footer Sidebar!', 'waht'); ?>
                </p>
				<?php endif; ?>
            </section>
        </section>
        <section class="copyright <?php echo waht_container_classes(); ?>"">
			<?php echo waht_credentials(); ?>
        </section>
		<?php waht_page_footer_inside_after(); ?>
    </div>
</footer><!-- #page-footer -->
<?php waht_page_footer_after(); ?>

<?php waht_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>