<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

$soleil_template_args = get_query_var( 'soleil_template_args' );
$soleil_columns = 1;
if ( is_array( $soleil_template_args ) ) {
	$soleil_columns    = empty( $soleil_template_args['columns'] ) ? 1 : max( 1, $soleil_template_args['columns'] );
	$soleil_blog_style = array( $soleil_template_args['type'], $soleil_columns );
	if ( ! empty( $soleil_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $soleil_columns > 1 ) {
	    $soleil_columns_class = soleil_get_column_class( 1, $soleil_columns, ! empty( $soleil_template_args['columns_tablet']) ? $soleil_template_args['columns_tablet'] : '', ! empty($soleil_template_args['columns_mobile']) ? $soleil_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $soleil_columns_class ); ?>">
		<?php
	}
}
$soleil_expanded    = ! soleil_sidebar_present() && soleil_get_theme_option( 'expand_content' ) == 'expand';
$soleil_post_format = get_post_format();
$soleil_post_format = empty( $soleil_post_format ) ? 'standard' : str_replace( 'post-format-', '', $soleil_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $soleil_post_format ) );
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
			'thumb_size' => ! empty( $soleil_template_args['thumb_size'] )
							? $soleil_template_args['thumb_size']
							: soleil_get_thumb_size( strpos( soleil_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $soleil_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$soleil_template_args
	) );

	// Title and post meta
	$soleil_show_title = get_the_title() != '';
	$soleil_show_meta  = count( $soleil_components ) > 0 && ! in_array( $soleil_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $soleil_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'soleil_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'soleil_action_before_post_title' );
				if ( empty( $soleil_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'soleil_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'soleil_filter_show_blog_excerpt', empty( $soleil_template_args['hide_excerpt'] ) && soleil_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'soleil_filter_show_blog_meta', $soleil_show_meta, $soleil_components, 'excerpt' ) ) {
				if ( count( $soleil_components ) > 0 ) {
					do_action( 'soleil_action_before_post_meta' );
					soleil_show_post_meta(
						apply_filters(
							'soleil_filter_post_meta_args', array(
								'components' => join( ',', $soleil_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'soleil_action_after_post_meta' );
				}
			}

			if ( soleil_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'soleil_action_before_full_post_content' );
					the_content( '' );
					do_action( 'soleil_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'soleil' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'soleil' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				soleil_show_post_content( $soleil_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'soleil_filter_show_blog_readmore',  ! isset( $soleil_template_args['more_button'] ) || ! empty( $soleil_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $soleil_template_args['no_links'] ) ) {
					do_action( 'soleil_action_before_post_readmore' );
					if ( soleil_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						soleil_show_post_more_link( $soleil_template_args, '<p>', '</p>' );
					} else {
						soleil_show_post_comments_link( $soleil_template_args, '<p>', '</p>' );
					}
					do_action( 'soleil_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $soleil_template_args ) ) {
	if ( ! empty( $soleil_template_args['slider'] ) || $soleil_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
