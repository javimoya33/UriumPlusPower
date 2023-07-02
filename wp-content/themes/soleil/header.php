<?php
/**
 * The Header: Logo and main menu
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( soleil_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'soleil_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'soleil_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('soleil_action_body_wrap_attributes'); ?>>

		<?php do_action( 'soleil_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'soleil_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('soleil_action_page_wrap_attributes'); ?>>

			<?php do_action( 'soleil_action_page_wrap_start' ); ?>

			<?php
			$soleil_full_post_loading = ( soleil_is_singular( 'post' ) || soleil_is_singular( 'attachment' ) ) && soleil_get_value_gp( 'action' ) == 'full_post_loading';
			$soleil_prev_post_loading = ( soleil_is_singular( 'post' ) || soleil_is_singular( 'attachment' ) ) && soleil_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $soleil_full_post_loading && ! $soleil_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="soleil_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to content", 'soleil' ); ?></a>
				<?php if ( soleil_sidebar_present() ) { ?>
				<a class="soleil_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to sidebar", 'soleil' ); ?></a>
				<?php } ?>
				<a class="soleil_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to footer", 'soleil' ); ?></a>

				<?php
				do_action( 'soleil_action_before_header' );

				// Header
				$soleil_header_type = soleil_get_theme_option( 'header_type' );
				if ( 'custom' == $soleil_header_type && ! soleil_is_layouts_available() ) {
					$soleil_header_type = 'default';
				}
				get_template_part( apply_filters( 'soleil_filter_get_template_part', "templates/header-" . sanitize_file_name( $soleil_header_type ) ) );

				// Side menu
				if ( in_array( soleil_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'soleil_action_after_header' );

			}
			?>

			<?php do_action( 'soleil_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( soleil_is_off( soleil_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $soleil_header_type ) ) {
						$soleil_header_type = soleil_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $soleil_header_type && soleil_is_layouts_available() ) {
						$soleil_header_id = soleil_get_custom_header_id();
						if ( $soleil_header_id > 0 ) {
							$soleil_header_meta = soleil_get_custom_layout_meta( $soleil_header_id );
							if ( ! empty( $soleil_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$soleil_footer_type = soleil_get_theme_option( 'footer_type' );
					if ( 'custom' == $soleil_footer_type && soleil_is_layouts_available() ) {
						$soleil_footer_id = soleil_get_custom_footer_id();
						if ( $soleil_footer_id ) {
							$soleil_footer_meta = soleil_get_custom_layout_meta( $soleil_footer_id );
							if ( ! empty( $soleil_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'soleil_action_page_content_wrap_class', $soleil_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'soleil_filter_is_prev_post_loading', $soleil_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( soleil_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'soleil_action_page_content_wrap_data', $soleil_prev_post_loading );
			?>>
				<?php
				do_action( 'soleil_action_page_content_wrap', $soleil_full_post_loading || $soleil_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'soleil_filter_single_post_header', soleil_is_singular( 'post' ) || soleil_is_singular( 'attachment' ) ) ) {
					if ( $soleil_prev_post_loading ) {
						if ( soleil_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'soleil_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$soleil_path = apply_filters( 'soleil_filter_get_template_part', 'templates/single-styles/' . soleil_get_theme_option( 'single_style' ) );
					if ( soleil_get_file_dir( $soleil_path . '.php' ) != '' ) {
						get_template_part( $soleil_path );
					}
				}

				// Widgets area above page
				$soleil_body_style   = soleil_get_theme_option( 'body_style' );
				$soleil_widgets_name = soleil_get_theme_option( 'widgets_above_page' );
				$soleil_show_widgets = ! soleil_is_off( $soleil_widgets_name ) && is_active_sidebar( $soleil_widgets_name );
				if ( $soleil_show_widgets ) {
					if ( 'fullscreen' != $soleil_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					soleil_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $soleil_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'soleil_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $soleil_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'soleil_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'soleil_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="soleil_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( soleil_is_singular( 'post' ) || soleil_is_singular( 'attachment' ) )
							&& $soleil_prev_post_loading 
							&& soleil_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'soleil_action_between_posts' );
						}

						// Widgets area above content
						soleil_create_widgets_area( 'widgets_above_content' );

						do_action( 'soleil_action_page_content_start_text' );
