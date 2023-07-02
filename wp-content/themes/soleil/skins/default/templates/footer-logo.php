<?php
/**
 * The template to display the site logo in the footer
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.10
 */

// Logo
if ( soleil_is_on( soleil_get_theme_option( 'logo_in_footer' ) ) ) {
	$soleil_logo_image = soleil_get_logo_image( 'footer' );
	$soleil_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $soleil_logo_image['logo'] ) || ! empty( $soleil_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $soleil_logo_image['logo'] ) ) {
					$soleil_attr = soleil_getimagesize( $soleil_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $soleil_logo_image['logo'] ) . '"'
								. ( ! empty( $soleil_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $soleil_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'soleil' ) . '"'
								. ( ! empty( $soleil_attr[3] ) ? ' ' . wp_kses_data( $soleil_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $soleil_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $soleil_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
