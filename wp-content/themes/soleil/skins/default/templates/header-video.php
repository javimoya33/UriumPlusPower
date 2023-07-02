<?php
/**
 * The template to display the background video in the header
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.14
 */
$soleil_header_video = soleil_get_header_video();
$soleil_embed_video  = '';
if ( ! empty( $soleil_header_video ) && ! soleil_is_from_uploads( $soleil_header_video ) ) {
	if ( soleil_is_youtube_url( $soleil_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $soleil_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php soleil_show_layout( soleil_get_embed_video( $soleil_header_video ) ); ?></div>
		<?php
	}
}
