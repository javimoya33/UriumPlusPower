<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.10
 */

// Footer sidebar
$soleil_footer_name    = soleil_get_theme_option( 'footer_widgets' );
$soleil_footer_present = ! soleil_is_off( $soleil_footer_name ) && is_active_sidebar( $soleil_footer_name );
if ( $soleil_footer_present ) {
	soleil_storage_set( 'current_sidebar', 'footer' );
	$soleil_footer_wide = soleil_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $soleil_footer_name ) ) {
		dynamic_sidebar( $soleil_footer_name );
	}
	$soleil_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $soleil_out ) ) {
		$soleil_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $soleil_out );
		$soleil_need_columns = true;   //or check: strpos($soleil_out, 'columns_wrap')===false;
		if ( $soleil_need_columns ) {
			$soleil_columns = max( 0, (int) soleil_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $soleil_columns ) {
				$soleil_columns = min( 4, max( 1, soleil_tags_count( $soleil_out, 'aside' ) ) );
			}
			if ( $soleil_columns > 1 ) {
				$soleil_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $soleil_columns ) . ' widget', $soleil_out );
			} else {
				$soleil_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $soleil_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'soleil_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $soleil_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $soleil_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'soleil_action_before_sidebar', 'footer' );
				soleil_show_layout( $soleil_out );
				do_action( 'soleil_action_after_sidebar', 'footer' );
				if ( $soleil_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $soleil_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'soleil_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
