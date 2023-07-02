<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

$soleil_args = get_query_var( 'soleil_logo_args' );

// Site logo
$soleil_logo_type   = isset( $soleil_args['type'] ) ? $soleil_args['type'] : '';
$soleil_logo_image  = soleil_get_logo_image( $soleil_logo_type );
$soleil_logo_text   = soleil_is_on( soleil_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$soleil_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $soleil_logo_image['logo'] ) || ! empty( $soleil_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $soleil_logo_image['logo'] ) ) {
			if ( empty( $soleil_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($soleil_logo_image['logo']) && (int) $soleil_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$soleil_attr = soleil_getimagesize( $soleil_logo_image['logo'] );
				echo '<img src="' . esc_url( $soleil_logo_image['logo'] ) . '"'
						. ( ! empty( $soleil_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $soleil_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $soleil_logo_text ) . '"'
						. ( ! empty( $soleil_attr[3] ) ? ' ' . wp_kses_data( $soleil_attr[3] ) : '' )
						. '>';
			}
		} else {
			soleil_show_layout( soleil_prepare_macros( $soleil_logo_text ), '<span class="logo_text">', '</span>' );
			soleil_show_layout( soleil_prepare_macros( $soleil_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
