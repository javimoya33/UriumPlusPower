<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$soleil_copyright_scheme = soleil_get_theme_option( 'copyright_scheme' );
if ( ! empty( $soleil_copyright_scheme ) && ! soleil_is_inherit( $soleil_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $soleil_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$soleil_copyright = soleil_get_theme_option( 'copyright' );
			if ( ! empty( $soleil_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$soleil_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $soleil_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$soleil_copyright = soleil_prepare_macros( $soleil_copyright );
				// Display copyright
				echo wp_kses( nl2br( $soleil_copyright ), 'soleil_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
