<?php
/**
 * The template to display single post
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

// Full post loading
$full_post_loading          = soleil_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = soleil_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = soleil_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$soleil_related_position   = soleil_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$soleil_posts_navigation   = soleil_get_theme_option( 'posts_navigation' );
$soleil_prev_post          = false;
$soleil_prev_post_same_cat = soleil_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( soleil_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	soleil_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'soleil_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $soleil_posts_navigation ) {
		$soleil_prev_post = get_previous_post( $soleil_prev_post_same_cat );  // Get post from same category
		if ( ! $soleil_prev_post && $soleil_prev_post_same_cat ) {
			$soleil_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $soleil_prev_post ) {
			$soleil_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $soleil_prev_post ) ) {
		soleil_sc_layouts_showed( 'featured', false );
		soleil_sc_layouts_showed( 'title', false );
		soleil_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $soleil_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/content', 'single-' . soleil_get_theme_option( 'single_style' ) ), 'single-' . soleil_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $soleil_related_position, 'inside' ) === 0 ) {
		$soleil_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'soleil_action_related_posts' );
		$soleil_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $soleil_related_content ) ) {
			$soleil_related_position_inside = max( 0, min( 9, soleil_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $soleil_related_position_inside ) {
				$soleil_related_position_inside = mt_rand( 1, 9 );
			}

			$soleil_p_number         = 0;
			$soleil_related_inserted = false;
			$soleil_in_block         = false;
			$soleil_content_start    = strpos( $soleil_content, '<div class="post_content' );
			$soleil_content_end      = strrpos( $soleil_content, '</div>' );

			for ( $i = max( 0, $soleil_content_start ); $i < min( strlen( $soleil_content ) - 3, $soleil_content_end ); $i++ ) {
				if ( $soleil_content[ $i ] != '<' ) {
					continue;
				}
				if ( $soleil_in_block ) {
					if ( strtolower( substr( $soleil_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$soleil_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $soleil_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $soleil_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$soleil_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $soleil_content[ $i + 1 ] && in_array( $soleil_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$soleil_p_number++;
					if ( $soleil_related_position_inside == $soleil_p_number ) {
						$soleil_related_inserted = true;
						$soleil_content = ( $i > 0 ? substr( $soleil_content, 0, $i ) : '' )
											. $soleil_related_content
											. substr( $soleil_content, $i );
					}
				}
			}
			if ( ! $soleil_related_inserted ) {
				if ( $soleil_content_end > 0 ) {
					$soleil_content = substr( $soleil_content, 0, $soleil_content_end ) . $soleil_related_content . substr( $soleil_content, $soleil_content_end );
				} else {
					$soleil_content .= $soleil_related_content;
				}
			}
		}

		soleil_show_layout( $soleil_content );
	}

	// Comments
	do_action( 'soleil_action_before_comments' );
	comments_template();
	do_action( 'soleil_action_after_comments' );

	// Related posts
	if ( 'below_content' == $soleil_related_position
		&& ( 'scroll' != $soleil_posts_navigation || soleil_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || soleil_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'soleil_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $soleil_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $soleil_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $soleil_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $soleil_prev_post ) ); ?>"
			<?php do_action( 'soleil_action_nav_links_single_scroll_data', $soleil_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
