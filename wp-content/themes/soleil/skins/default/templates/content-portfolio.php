<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

$soleil_template_args = get_query_var( 'soleil_template_args' );
if ( is_array( $soleil_template_args ) ) {
	$soleil_columns    = empty( $soleil_template_args['columns'] ) ? 2 : max( 1, $soleil_template_args['columns'] );
	$soleil_blog_style = array( $soleil_template_args['type'], $soleil_columns );
    $soleil_columns_class = soleil_get_column_class( 1, $soleil_columns, ! empty( $soleil_template_args['columns_tablet']) ? $soleil_template_args['columns_tablet'] : '', ! empty($soleil_template_args['columns_mobile']) ? $soleil_template_args['columns_mobile'] : '' );
} else {
	$soleil_blog_style = explode( '_', soleil_get_theme_option( 'blog_style' ) );
	$soleil_columns    = empty( $soleil_blog_style[1] ) ? 2 : max( 1, $soleil_blog_style[1] );
    $soleil_columns_class = soleil_get_column_class( 1, $soleil_columns );
}

$soleil_post_format = get_post_format();
$soleil_post_format = empty( $soleil_post_format ) ? 'standard' : str_replace( 'post-format-', '', $soleil_post_format );

?><div class="
<?php
if ( ! empty( $soleil_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( soleil_is_blog_style_use_masonry( $soleil_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $soleil_columns ) : esc_attr( $soleil_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $soleil_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $soleil_columns )
		. ( 'portfolio' != $soleil_blog_style[0] ? ' ' . esc_attr( $soleil_blog_style[0] )  . '_' . esc_attr( $soleil_columns ) : '' )
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

	$soleil_hover   = ! empty( $soleil_template_args['hover'] ) && ! soleil_is_inherit( $soleil_template_args['hover'] )
								? $soleil_template_args['hover']
								: soleil_get_theme_option( 'image_hover' );

	if ( 'dots' == $soleil_hover ) {
		$soleil_post_link = empty( $soleil_template_args['no_links'] )
								? ( ! empty( $soleil_template_args['link'] )
									? $soleil_template_args['link']
									: get_permalink()
									)
								: '';
		$soleil_target    = ! empty( $soleil_post_link ) && false === strpos( $soleil_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$soleil_components = ! empty( $soleil_template_args['meta_parts'] )
							? ( is_array( $soleil_template_args['meta_parts'] )
								? $soleil_template_args['meta_parts']
								: explode( ',', $soleil_template_args['meta_parts'] )
								)
							: soleil_array_get_keys_by_value( soleil_get_theme_option( 'meta_parts' ) );

	// Featured image
	soleil_show_post_featured( apply_filters( 'soleil_filter_args_featured',
        array(
			'hover'         => $soleil_hover,
			'no_links'      => ! empty( $soleil_template_args['no_links'] ),
			'thumb_size'    => ! empty( $soleil_template_args['thumb_size'] )
								? $soleil_template_args['thumb_size']
								: soleil_get_thumb_size(
									soleil_is_blog_style_use_masonry( $soleil_blog_style[0] )
										? (	strpos( soleil_get_theme_option( 'body_style' ), 'full' ) !== false || $soleil_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( soleil_get_theme_option( 'body_style' ), 'full' ) !== false || $soleil_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => soleil_is_blog_style_use_masonry( $soleil_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $soleil_components,
			'class'         => 'dots' == $soleil_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $soleil_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $soleil_post_link )
												? '<a href="' . esc_url( $soleil_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $soleil_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $soleil_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $soleil_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!