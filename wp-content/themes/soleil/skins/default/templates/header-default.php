<?php
/**
 * The template to display default site header
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

$soleil_header_css   = '';
$soleil_header_image = get_header_image();
$soleil_header_video = soleil_get_header_video();
if ( ! empty( $soleil_header_image ) && soleil_trx_addons_featured_image_override( is_singular() || soleil_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$soleil_header_image = soleil_get_current_mode_image( $soleil_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $soleil_header_image ) || ! empty( $soleil_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( soleil_is_on( soleil_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
