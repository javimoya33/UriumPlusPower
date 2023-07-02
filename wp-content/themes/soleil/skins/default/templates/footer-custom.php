<?php
/**
 * The template to display default site footer
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.10
 */

$soleil_footer_id = soleil_get_custom_footer_id();
$soleil_footer_meta = get_post_meta( $soleil_footer_id, 'trx_addons_options', true );
if ( ! empty( $soleil_footer_meta['margin'] ) ) {
	soleil_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( soleil_prepare_css_value( $soleil_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $soleil_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $soleil_footer_id ) ) ); ?>
						<?php
						$soleil_footer_scheme = soleil_get_theme_option( 'footer_scheme' );
						if ( ! empty( $soleil_footer_scheme ) && ! soleil_is_inherit( $soleil_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $soleil_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'soleil_action_show_layout', $soleil_footer_id );
	?>
</footer><!-- /.footer_wrap -->
