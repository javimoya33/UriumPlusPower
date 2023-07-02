<?php
/**
 * The Classic template to display the content
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
$soleil_expanded   = ! soleil_sidebar_present() && soleil_get_theme_option( 'expand_content' ) == 'expand';

$soleil_post_format = get_post_format();
$soleil_post_format = empty( $soleil_post_format ) ? 'standard' : str_replace( 'post-format-', '', $soleil_post_format );

?><div class="<?php
	if ( ! empty( $soleil_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( soleil_is_blog_style_use_masonry( $soleil_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $soleil_columns ) : esc_attr( $soleil_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $soleil_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $soleil_columns )
				. ' post_layout_' . esc_attr( $soleil_blog_style[0] )
				. ' post_layout_' . esc_attr( $soleil_blog_style[0] ) . '_' . esc_attr( $soleil_columns )
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

	// Featured image
	$soleil_hover      = ! empty( $soleil_template_args['hover'] ) && ! soleil_is_inherit( $soleil_template_args['hover'] )
							? $soleil_template_args['hover']
							: soleil_get_theme_option( 'image_hover' );

	$soleil_components = ! empty( $soleil_template_args['meta_parts'] )
							? ( is_array( $soleil_template_args['meta_parts'] )
								? $soleil_template_args['meta_parts']
								: explode( ',', $soleil_template_args['meta_parts'] )
								)
							: soleil_array_get_keys_by_value( soleil_get_theme_option( 'meta_parts' ) );

	soleil_show_post_featured( apply_filters( 'soleil_filter_args_featured',
		array(
			'thumb_size' => ! empty( $soleil_template_args['thumb_size'] )
				? $soleil_template_args['thumb_size']
				: soleil_get_thumb_size(
					'classic' == $soleil_blog_style[0]
						? ( strpos( soleil_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $soleil_columns > 2 ? 'big' : 'huge' )
								: ( $soleil_columns > 2
									? ( $soleil_expanded ? 'square' : 'square' )
									: ($soleil_columns > 1 ? 'square' : ( $soleil_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( soleil_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $soleil_columns > 2 ? 'masonry-big' : 'full' )
								: ($soleil_columns === 1 ? ( $soleil_expanded ? 'huge' : 'big' ) : ( $soleil_columns <= 2 && $soleil_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $soleil_hover,
			'meta_parts' => $soleil_components,
			'no_links'   => ! empty( $soleil_template_args['no_links'] ),
        ),
        'content-classic',
        $soleil_template_args
    ) );

	// Title and post meta
	$soleil_show_title = get_the_title() != '';
	$soleil_show_meta  = count( $soleil_components ) > 0 && ! in_array( $soleil_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $soleil_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'soleil_filter_show_blog_meta', $soleil_show_meta, $soleil_components, 'classic' ) ) {
				if ( count( $soleil_components ) > 0 ) {
					do_action( 'soleil_action_before_post_meta' );
					soleil_show_post_meta(
						apply_filters(
							'soleil_filter_post_meta_args', array(
							'components' => join( ',', $soleil_components ),
							'seo'        => false,
							'echo'       => true,
						), $soleil_blog_style[0], $soleil_columns
						)
					);
					do_action( 'soleil_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'soleil_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'soleil_action_before_post_title' );
				if ( empty( $soleil_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'soleil_action_after_post_title' );
			}

			if( !in_array( $soleil_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'soleil_filter_show_blog_readmore', ! $soleil_show_title || ! empty( $soleil_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $soleil_template_args['no_links'] ) ) {
						do_action( 'soleil_action_before_post_readmore' );
						soleil_show_post_more_link( $soleil_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'soleil_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $soleil_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('soleil_filter_show_blog_excerpt', empty($soleil_template_args['hide_excerpt']) && soleil_get_theme_option('excerpt_length') > 0, 'classic')) {
			soleil_show_post_content($soleil_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $soleil_template_args['more_button'] )) {
			if ( empty( $soleil_template_args['no_links'] ) ) {
				do_action( 'soleil_action_before_post_readmore' );
				soleil_show_post_more_link( $soleil_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'soleil_action_after_post_readmore' );
			}
		}
		$soleil_content = ob_get_contents();
		ob_end_clean();
		soleil_show_layout($soleil_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
