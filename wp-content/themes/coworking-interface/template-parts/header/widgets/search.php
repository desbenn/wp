<?php
/**
 * The template for displaying theme header search widget.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

?>

<div aria-haspopup="true">
	<a href="#" class="si-search">
		<?php echo coworking_interface()->icons->get_svg('search', array('aria-label' => esc_html__('Search', 'coworking-interface'))); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a><!-- END .si-search -->

	<div class="si-search-simple si-search-container dropdown-item">
		<form aria-label="<?php esc_attr_e('Site Search', 'coworking-interface'); ?>" method="get"
			class="si-search-form" action="<?php echo esc_url(home_url('/')); ?>">

			<label class="si-form-label">
				<span class="screen-reader-text"><?php esc_html_e('Search for:', 'coworking-interface'); ?></span>
				<input type="search" class="si-input-search"
					placeholder="<?php esc_attr_e('Search', 'coworking-interface'); ?>"
					value="<?php echo esc_attr(get_query_var('s')); ?>" name="s" autocomplete="off">
			</label><!-- END .sinara-form-label -->

			<?php coworking_interface_animated_arrow('right', 'submit', true); ?>

		</form>
	</div><!-- END .si-search-simple -->
</div>