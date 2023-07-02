<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.50
 */

$soleil_template_args = get_query_var( 'soleil_template_args' );
if ( is_array( $soleil_template_args ) ) {
	$soleil_columns    = empty( $soleil_template_args['columns'] ) ? 2 : max( 1, $soleil_template_args['columns'] );
	$soleil_blog_style = array( $soleil_template_args['type'], $soleil_columns );
} else {
	$soleil_blog_style = explode( '_', soleil_get_theme_option( 'blog_style' ) );
	$soleil_columns    = empty( $soleil_blog_style[1] ) ? 2 : max( 1, $soleil_blog_style[1] );
}
$soleil_blog_id       = soleil_get_custom_blog_id( join( '_', $soleil_blog_style ) );
$soleil_blog_style[0] = str_replace( 'blog-custom-', '', $soleil_blog_style[0] );
$soleil_expanded      = ! soleil_sidebar_present() && soleil_get_theme_option( 'expand_content' ) == 'expand';
$soleil_components    = ! empty( $soleil_template_args['meta_parts'] )
							? ( is_array( $soleil_template_args['meta_parts'] )
								? join( ',', $soleil_template_args['meta_parts'] )
								: $soleil_template_args['meta_parts']
								)
							: soleil_array_get_keys_by_value( soleil_get_theme_option( 'meta_parts' ) );
$soleil_post_format   = get_post_format();
$soleil_post_format   = empty( $soleil_post_format ) ? 'standard' : str_replace( 'post-format-', '', $soleil_post_format );

$soleil_blog_meta     = soleil_get_custom_layout_meta( $soleil_blog_id );
$soleil_custom_style  = ! empty( $soleil_blog_meta['scripts_required'] ) ? $soleil_blog_meta['scripts_required'] : 'none';

if ( ! empty( $soleil_template_args['slider'] ) || $soleil_columns > 1 || ! soleil_is_off( $soleil_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $soleil_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( soleil_is_off( $soleil_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $soleil_custom_style ) ) . "-1_{$soleil_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $soleil_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $soleil_columns )
					. ' post_layout_' . esc_attr( $soleil_blog_style[0] )
					. ' post_layout_' . esc_attr( $soleil_blog_style[0] ) . '_' . esc_attr( $soleil_columns )
					. ( ! soleil_is_off( $soleil_custom_style )
						? ' post_layout_' . esc_attr( $soleil_custom_style )
							. ' post_layout_' . esc_attr( $soleil_custom_style ) . '_' . esc_attr( $soleil_columns )
						: ''
						)
		);
	soleil_add_blog_animation( $soleil_template_args );
	?>
>
	<?php
	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}
	// Custom layout
	do_action( 'soleil_action_show_layout', $soleil_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $soleil_template_args['slider'] ) || $soleil_columns > 1 || ! soleil_is_off( $soleil_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
