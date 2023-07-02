<?php
/**
 * The template to display the widgets area in the header
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

// Header sidebar
$soleil_header_name    = soleil_get_theme_option( 'header_widgets' );
$soleil_header_present = ! soleil_is_off( $soleil_header_name ) && is_active_sidebar( $soleil_header_name );
if ( $soleil_header_present ) {
	soleil_storage_set( 'current_sidebar', 'header' );
	$soleil_header_wide = soleil_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $soleil_header_name ) ) {
		dynamic_sidebar( $soleil_header_name );
	}
	$soleil_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $soleil_widgets_output ) ) {
		$soleil_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $soleil_widgets_output );
		$soleil_need_columns   = strpos( $soleil_widgets_output, 'columns_wrap' ) === false;
		if ( $soleil_need_columns ) {
			$soleil_columns = max( 0, (int) soleil_get_theme_option( 'header_columns' ) );
			if ( 0 == $soleil_columns ) {
				$soleil_columns = min( 6, max( 1, soleil_tags_count( $soleil_widgets_output, 'aside' ) ) );
			}
			if ( $soleil_columns > 1 ) {
				$soleil_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $soleil_columns ) . ' widget', $soleil_widgets_output );
			} else {
				$soleil_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $soleil_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'soleil_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $soleil_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $soleil_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'soleil_action_before_sidebar', 'header' );
				soleil_show_layout( $soleil_widgets_output );
				do_action( 'soleil_action_after_sidebar', 'header' );
				if ( $soleil_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $soleil_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'soleil_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
