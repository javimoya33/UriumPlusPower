<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

$soleil_template = apply_filters( 'soleil_filter_get_template_part', soleil_blog_archive_get_template() );

if ( ! empty( $soleil_template ) && 'index' != $soleil_template ) {

	get_template_part( $soleil_template );

} else {

	soleil_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$soleil_stickies   = is_home()
								|| ( in_array( soleil_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) soleil_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$soleil_post_type  = soleil_get_theme_option( 'post_type' );
		$soleil_args       = array(
								'blog_style'     => soleil_get_theme_option( 'blog_style' ),
								'post_type'      => $soleil_post_type,
								'taxonomy'       => soleil_get_post_type_taxonomy( $soleil_post_type ),
								'parent_cat'     => soleil_get_theme_option( 'parent_cat' ),
								'posts_per_page' => soleil_get_theme_option( 'posts_per_page' ),
								'sticky'         => soleil_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $soleil_stickies )
															&& count( $soleil_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		soleil_blog_archive_start();

		do_action( 'soleil_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'soleil_action_before_page_author' );
			get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'soleil_action_after_page_author' );
		}

		if ( soleil_get_theme_option( 'show_filters' ) ) {
			do_action( 'soleil_action_before_page_filters' );
			soleil_show_filters( $soleil_args );
			do_action( 'soleil_action_after_page_filters' );
		} else {
			do_action( 'soleil_action_before_page_posts' );
			soleil_show_posts( array_merge( $soleil_args, array( 'cat' => $soleil_args['parent_cat'] ) ) );
			do_action( 'soleil_action_after_page_posts' );
		}

		do_action( 'soleil_action_blog_archive_end' );

		soleil_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'soleil_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
