<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

// Page (category, tag, archive, author) title

if ( soleil_need_page_title() ) {
	soleil_sc_layouts_showed( 'title', true );
	soleil_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								soleil_show_post_meta(
									apply_filters(
										'soleil_filter_post_meta_args', array(
											'components' => join( ',', soleil_array_get_keys_by_value( soleil_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', soleil_array_get_keys_by_value( soleil_get_theme_option( 'counters' ) ) ),
											'seo'        => soleil_is_on( soleil_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$soleil_blog_title           = soleil_get_blog_title();
							$soleil_blog_title_text      = '';
							$soleil_blog_title_class     = '';
							$soleil_blog_title_link      = '';
							$soleil_blog_title_link_text = '';
							if ( is_array( $soleil_blog_title ) ) {
								$soleil_blog_title_text      = $soleil_blog_title['text'];
								$soleil_blog_title_class     = ! empty( $soleil_blog_title['class'] ) ? ' ' . $soleil_blog_title['class'] : '';
								$soleil_blog_title_link      = ! empty( $soleil_blog_title['link'] ) ? $soleil_blog_title['link'] : '';
								$soleil_blog_title_link_text = ! empty( $soleil_blog_title['link_text'] ) ? $soleil_blog_title['link_text'] : '';
							} else {
								$soleil_blog_title_text = $soleil_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $soleil_blog_title_class ); ?>">
								<?php
								$soleil_top_icon = soleil_get_term_image_small();
								if ( ! empty( $soleil_top_icon ) ) {
									$soleil_attr = soleil_getimagesize( $soleil_top_icon );
									?>
									<img src="<?php echo esc_url( $soleil_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'soleil' ); ?>"
										<?php
										if ( ! empty( $soleil_attr[3] ) ) {
											soleil_show_layout( $soleil_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $soleil_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $soleil_blog_title_link ) && ! empty( $soleil_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $soleil_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $soleil_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'soleil_action_breadcrumbs' );
						$soleil_breadcrumbs = ob_get_contents();
						ob_end_clean();
						soleil_show_layout( $soleil_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
