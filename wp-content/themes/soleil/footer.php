<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package SOLEIL
 * @since SOLEIL 1.0
 */

							do_action( 'soleil_action_page_content_end_text' );
							
							// Widgets area below the content
							soleil_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'soleil_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'soleil_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'soleil_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'soleil_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$soleil_body_style = soleil_get_theme_option( 'body_style' );
					$soleil_widgets_name = soleil_get_theme_option( 'widgets_below_page' );
					$soleil_show_widgets = ! soleil_is_off( $soleil_widgets_name ) && is_active_sidebar( $soleil_widgets_name );
					$soleil_show_related = soleil_is_single() && soleil_get_theme_option( 'related_position' ) == 'below_page';
					if ( $soleil_show_widgets || $soleil_show_related ) {
						if ( 'fullscreen' != $soleil_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $soleil_show_related ) {
							do_action( 'soleil_action_related_posts' );
						}

						// Widgets area below page content
						if ( $soleil_show_widgets ) {
							soleil_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $soleil_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'soleil_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'soleil_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! soleil_is_singular( 'post' ) && ! soleil_is_singular( 'attachment' ) ) || ! in_array ( soleil_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="soleil_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'soleil_action_before_footer' );

				// Footer
				$soleil_footer_type = soleil_get_theme_option( 'footer_type' );
				if ( 'custom' == $soleil_footer_type && ! soleil_is_layouts_available() ) {
					$soleil_footer_type = 'default';
				}
				get_template_part( apply_filters( 'soleil_filter_get_template_part', "templates/footer-" . sanitize_file_name( $soleil_footer_type ) ) );

				do_action( 'soleil_action_after_footer' );

			}
			?>

			<?php do_action( 'soleil_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'soleil_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'soleil_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>