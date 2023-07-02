<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

if ( soleil_sidebar_present() ) {
	
	$soleil_sidebar_type = soleil_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $soleil_sidebar_type && ! soleil_is_layouts_available() ) {
		$soleil_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $soleil_sidebar_type ) {
		// Default sidebar with widgets
		$soleil_sidebar_name = soleil_get_theme_option( 'sidebar_widgets' );
		soleil_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $soleil_sidebar_name ) ) {
			dynamic_sidebar( $soleil_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$soleil_sidebar_id = soleil_get_custom_sidebar_id();
		do_action( 'soleil_action_show_layout', $soleil_sidebar_id );
	}
	$soleil_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $soleil_out ) ) {
		$soleil_sidebar_position    = soleil_get_theme_option( 'sidebar_position' );
		$soleil_sidebar_position_ss = soleil_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $soleil_sidebar_position );
			echo ' sidebar_' . esc_attr( $soleil_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $soleil_sidebar_type );

			$soleil_sidebar_scheme = apply_filters( 'soleil_filter_sidebar_scheme', soleil_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $soleil_sidebar_scheme ) && ! soleil_is_inherit( $soleil_sidebar_scheme ) && 'custom' != $soleil_sidebar_type ) {
				echo ' scheme_' . esc_attr( $soleil_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="soleil_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'soleil_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $soleil_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$soleil_title = apply_filters( 'soleil_filter_sidebar_control_title', 'float' == $soleil_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'soleil' ) : '' );
				$soleil_text  = apply_filters( 'soleil_filter_sidebar_control_text', 'above' == $soleil_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'soleil' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $soleil_title ); ?>"><?php echo esc_html( $soleil_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'soleil_action_before_sidebar', 'sidebar' );
				soleil_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $soleil_out ) );
				do_action( 'soleil_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'soleil_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
