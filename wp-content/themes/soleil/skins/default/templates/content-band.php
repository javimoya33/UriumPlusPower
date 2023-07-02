<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SOLEIL
 * @since SOLEIL 1.71.0
 */

$soleil_template_args = get_query_var( 'soleil_template_args' );

$soleil_columns       = 1;

$soleil_expanded      = ! soleil_sidebar_present() && soleil_get_theme_option( 'expand_content' ) == 'expand';

$soleil_post_format   = get_post_format();
$soleil_post_format   = empty( $soleil_post_format ) ? 'standard' : str_replace( 'post-format-', '', $soleil_post_format );

if ( is_array( $soleil_template_args ) ) {
	$soleil_columns    = empty( $soleil_template_args['columns'] ) ? 1 : max( 1, $soleil_template_args['columns'] );
	$soleil_blog_style = array( $soleil_template_args['type'], $soleil_columns );
	if ( ! empty( $soleil_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $soleil_columns > 1 ) {
	    $soleil_columns_class = soleil_get_column_class( 1, $soleil_columns, ! empty( $soleil_template_args['columns_tablet']) ? $soleil_template_args['columns_tablet'] : '', ! empty($soleil_template_args['columns_mobile']) ? $soleil_template_args['columns_mobile'] : '' );
				?><div class="<?php echo esc_attr( $soleil_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $soleil_post_format ) );
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
								: array_map( 'trim', explode( ',', $soleil_template_args['meta_parts'] ) )
								)
							: soleil_array_get_keys_by_value( soleil_get_theme_option( 'meta_parts' ) );
	soleil_show_post_featured( apply_filters( 'soleil_filter_args_featured',
		array(
			'no_links'   => ! empty( $soleil_template_args['no_links'] ),
			'hover'      => $soleil_hover,
			'meta_parts' => $soleil_components,
			'thumb_bg'   => true,
			'thumb_ratio'   => '1:1',
			'thumb_size' => ! empty( $soleil_template_args['thumb_size'] )
								? $soleil_template_args['thumb_size']
								: soleil_get_thumb_size( 
								in_array( $soleil_post_format, array( 'gallery', 'audio', 'video' ) )
									? ( strpos( soleil_get_theme_option( 'body_style' ), 'full' ) !== false
										? 'full'
										: ( $soleil_expanded 
											? 'big' 
											: 'medium-square'
											)
										)
									: 'masonry-big'
								)
		),
		'content-band',
		$soleil_template_args
	) );

	?><div class="post_content_wrap"><?php

		// Title and post meta
		$soleil_show_title = get_the_title() != '';
		$soleil_show_meta  = count( $soleil_components ) > 0 && ! in_array( $soleil_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );
		if ( $soleil_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'soleil_filter_show_blog_categories', $soleil_show_meta && in_array( 'categories', $soleil_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'soleil_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						soleil_show_post_meta( apply_filters(
															'soleil_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																'cat_sep'    => false,
																),
															'hover_' . $soleil_hover, 1
															)
											);
						?>
					</div>
					<?php
					$soleil_components = soleil_array_delete_by_value( $soleil_components, 'categories' );
					do_action( 'soleil_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'soleil_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'soleil_action_before_post_title' );
					if ( empty( $soleil_template_args['no_links'] ) ) {
						the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
					} else {
						the_title( '<h4 class="post_title entry-title">', '</h4>' );
					}
					do_action( 'soleil_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $soleil_template_args['excerpt_length'] ) && ! in_array( $soleil_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$soleil_template_args['excerpt_length'] = 13;
		}
		if ( apply_filters( 'soleil_filter_show_blog_excerpt', empty( $soleil_template_args['hide_excerpt'] ) && soleil_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				soleil_show_post_content( $soleil_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'soleil_filter_show_blog_meta', $soleil_show_meta, $soleil_components, 'band' ) ) {
			if ( count( $soleil_components ) > 0 ) {
				do_action( 'soleil_action_before_post_meta' );
				soleil_show_post_meta(
					apply_filters(
						'soleil_filter_post_meta_args', array(
							'components' => join( ',', $soleil_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'soleil_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'soleil_filter_show_blog_readmore', ! $soleil_show_title || ! empty( $soleil_template_args['more_button'] ), 'band' ) ) {
			if ( empty( $soleil_template_args['no_links'] ) ) {
				do_action( 'soleil_action_before_post_readmore' );
				soleil_show_post_more_link( $soleil_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'soleil_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $soleil_template_args ) ) {
	if ( ! empty( $soleil_template_args['slider'] ) || $soleil_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
