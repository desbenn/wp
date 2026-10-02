<?php
/**
 * The template for displaying Hero Hover Slider.
 *
 * @package     Coworking Interface
 * @author      WPInterface Team
 * @since       1.0.0
 */

$coworking_interface_hero_categories = ! empty( $coworking_interface_hero_categories ) ? implode( ', ', $coworking_interface_hero_categories ) : '';

// Setup Hero posts.
$coworking_interface_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => coworking_interface_option( 'hero_hover_slider_post_number' ), // phpcs:ignore WordPress.WP.PostsPerPage.posts_per_page_posts_per_page
	'ignore_sticky_posts' => true,
	'tax_query'           => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote' ),
			'operator' => 'NOT IN',
		),
	),
);

$coworking_interface_hero_categories = coworking_interface_option( 'hero_hover_slider_category' );

if ( ! empty( $coworking_interface_hero_categories ) ) {
	$coworking_interface_args['category_name'] = implode( ', ', $coworking_interface_hero_categories );
}

$coworking_interface_args = apply_filters( 'coworking_interface_hero_hover_slider_query_args', $coworking_interface_args );

$coworking_interface_posts = new WP_Query( $coworking_interface_args );

// No posts found.
if ( ! $coworking_interface_posts->have_posts() ) {
	return;
}

$coworking_interface_hero_bgs_html   = '';
$coworking_interface_hero_items_html = '';

$coworking_interface_hero_elements = (array) coworking_interface_option( 'hero_hover_slider_elements' );
$coworking_interface_hero_readmore = isset( $coworking_interface_hero_elements['read_more'] ) && $coworking_interface_hero_elements['read_more'] ? ' si-hero-readmore' : '';

while ( $coworking_interface_posts->have_posts() ) :
	$coworking_interface_posts->the_post();

	// Background images HTML markup.
	$coworking_interface_hero_bgs_html .= '<div class="hover-slide-bg" data-background="' . esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) . '"></div>';

	// Post items HTML markup.
	ob_start();
	?>
	<div class="col-xs-<?php echo esc_attr( 12 / $coworking_interface_args['posts_per_page'] ); ?> hover-slider-item-wrapper<?php echo esc_attr( $coworking_interface_hero_readmore ); ?>">
		<div class="hover-slide-item">
			<div class="slide-inner">

				<?php if ( isset( $coworking_interface_hero_elements['category'] ) && $coworking_interface_hero_elements['category'] ) { ?>
					<div class="post-category">
						<?php coworking_interface_entry_meta_category( ' ', false ); ?>
					</div>
				<?php } ?>

				<?php if ( get_the_title() ) { ?>
					<h3><a href="<?php echo esc_url( coworking_interface_entry_get_permalink() ); ?>"><?php the_title(); ?></a></h3>
				<?php } ?>

				<?php if ( isset( $coworking_interface_hero_elements['meta'] ) && $coworking_interface_hero_elements['meta'] ) { ?>
					<div class="entry-meta">
						<div class="entry-meta-elements">
							<?php
							coworking_interface_entry_meta_author();

							coworking_interface_entry_meta_date(
								array(
									'show_modified'   => false,
									'published_label' => '',
								)
							);
							?>
						</div>
					</div><!-- END .entry-meta -->
				<?php } ?>

				<?php if ( $coworking_interface_hero_readmore ) { ?>
					<a href="<?php echo esc_url( coworking_interface_entry_get_permalink() ); ?>" class="read-more interface-button btn-small btn-outline btn-uppercase" role="button"><span><?php esc_html_e( 'Continue Reading', 'coworking-interface' ); ?></span></a>
				<?php } ?>

			</div><!-- END .slide-inner -->
		</div><!-- END .hover-slide-item -->
	</div><!-- END .hover-slider-item-wrapper -->
	<?php
	$coworking_interface_hero_items_html .= ob_get_clean();
endwhile;

// Restore original Post Data.
wp_reset_postdata();

// Hero container.
$coworking_interface_hero_container = coworking_interface_option( 'hero_hover_slider_container' );
$coworking_interface_hero_container = 'full-width' === $coworking_interface_hero_container ? 'interface-container interface-container__wide' : 'interface-container';

// Hero overlay.
$coworking_interface_hero_overlay = absint( coworking_interface_option( 'hero_hover_slider_overlay' ) );
?>

<div class="si-hover-slider slider-overlay-<?php echo esc_attr( $coworking_interface_hero_overlay ); ?>">
	<div class="hover-slider-backgrounds">

		<?php echo wp_kses_post( $coworking_interface_hero_bgs_html ); ?>

	</div><!-- END .hover-slider-items -->

	<div class="si-hero-container <?php echo esc_attr( $coworking_interface_hero_container ); ?>">
		<div class="si-flex-row hover-slider-items">

			<?php echo wp_kses_post( $coworking_interface_hero_items_html ); ?>

		</div><!-- END .hover-slider-items -->
	</div>

	<div class="si-spinner visible">
		<div></div>
		<div></div>
	</div>
</div><!-- END .si-hover-slider -->
