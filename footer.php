<?php
/**
 * @description: File called by get_footer()
 * @name       : footer.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>

</div><!-- /#page-wrap -->
<?php waht_page_wrap_after(); ?>

<?php waht_page_footer_before(); ?>
<footer id="page-footer" class="<?php waht_container_class(); ?>">
    <?php waht_page_footer_inside_before(); ?>
    <section class="footer-sidebars row-fluid">
        <section class="sidebar-footer-left span4">
            <?php if (is_dynamic_sidebar('sidebar-footer-left')) : ?>
            <?php dynamic_sidebar('sidebar-footer-left'); ?>
            <?php endif; ?>
        </section>
        <section class="sidebar-footer-center span4">
            <?php if (is_dynamic_sidebar('sidebar-footer-center')) : ?>
            <?php dynamic_sidebar('sidebar-footer-center'); ?>
            <?php endif; ?>
        </section>
        <section class="sidebar-footer-right span4">
            <?php if (is_dynamic_sidebar('sidebar-footer-right')) : ?>
            <?php dynamic_sidebar('sidebar-footer-right'); ?>
            <?php endif; ?>
        </section>
    </section>
    <section class="copyright">
        <?php waht_credentials(); ?>
    </section>
    <?php waht_page_footer_inside_after(); ?>
</footer><!-- #page-footer -->
<?php waht_page_footer_after(); ?>

<?php waht_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>