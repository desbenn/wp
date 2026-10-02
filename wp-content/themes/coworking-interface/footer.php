<?php
/**
 * The template for displaying the footer in our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */
?>
<?php do_action('coworking_interface_main_end'); ?>
</div><!-- #main .site-main -->

<?php do_action('coworking_interface_after_main'); ?>
<?php do_action('coworking_interface_before_colophon'); ?>
<?php if (coworking_interface_is_colophon_displayed()) { ?>
    <footer id="colophon" class="site-footer" role="contentinfo" <?php coworking_interface_schema_markup('footer'); ?>>
        <?php do_action('coworking_interface_footer'); ?>
    </footer><!-- #colophon .site-footer -->
<?php } ?>
<?php do_action('coworking_interface_after_colophon'); ?>

</div><!-- END #page -->

<?php do_action('coworking_interface_after_page_wrapper'); ?>
<?php wp_footer(); ?>
</body>
</html>
