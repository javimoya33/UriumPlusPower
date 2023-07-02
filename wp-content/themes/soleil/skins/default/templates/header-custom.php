<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.06
 */

$soleil_header_css   = '';
$soleil_header_image = get_header_image();
$soleil_header_video = soleil_get_header_video();
if ( ! empty( $soleil_header_image ) && soleil_trx_addons_featured_image_override( is_singular() || soleil_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$soleil_header_image = soleil_get_current_mode_image( $soleil_header_image );
}

$soleil_header_id = soleil_get_custom_header_id();
$soleil_header_meta = get_post_meta( $soleil_header_id, 'trx_addons_options', true );
if ( ! empty( $soleil_header_meta['margin'] ) ) {
	soleil_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( soleil_prepare_css_value( $soleil_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $soleil_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $soleil_header_id ) ) ); ?>
				<?php
				echo ! empty( $soleil_header_image ) || ! empty( $soleil_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $soleil_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $soleil_header_image ) {
					echo ' ' . esc_attr( soleil_add_inline_css_class( 'background-image: url(' . esc_url( $soleil_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( soleil_is_on( soleil_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight soleil-full-height';
				}
				$soleil_header_scheme = soleil_get_theme_option( 'header_scheme' );
				if ( ! empty( $soleil_header_scheme ) && ! soleil_is_inherit( $soleil_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $soleil_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $soleil_header_video ) ) {
		get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'soleil_action_show_layout', $soleil_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
