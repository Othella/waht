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
</div>
<!-- /#page-wrap -->
<?php waht_page_wrap_after(); ?>

<?php waht_page_footer_before(); ?>
<footer id="page-footer">
    <div class="<?php waht_container_class(); ?>">
        <section class="copyright">
            <?php waht_credentials(); ?>
        </section>

        <nav role="navigation">
            <?php waht_footer_nav_menu(); ?>
        </nav>
    </div>
</footer>
<!-- #page-footer -->
<?php waht_page_footer_after(); ?>

<?php waht_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>