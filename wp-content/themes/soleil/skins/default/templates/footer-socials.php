<?php
/**
 * The template to display the socials in the footer
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.10
 */


// Socials
if ( soleil_is_on( soleil_get_theme_option( 'socials_in_footer' ) ) ) {
	$soleil_output = soleil_get_socials_links();
	if ( '' != $soleil_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php soleil_show_layout( $soleil_output ); ?>
			</div>
		</div>
		<?php
	}
}
