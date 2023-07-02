<?php
/**
 * The template to display default site footer
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$soleil_footer_scheme = soleil_get_theme_option( 'footer_scheme' );
if ( ! empty( $soleil_footer_scheme ) && ! soleil_is_inherit( $soleil_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $soleil_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
