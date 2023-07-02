<div class="front_page_section front_page_section_blog<?php
	$soleil_scheme = soleil_get_theme_option( 'front_page_blog_scheme' );
	if ( ! empty( $soleil_scheme ) && ! soleil_is_inherit( $soleil_scheme ) ) {
		echo ' scheme_' . esc_attr( $soleil_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( soleil_get_theme_option( 'front_page_blog_paddings' ) );
	if ( soleil_get_theme_option( 'front_page_blog_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$soleil_css      = '';
		$soleil_bg_image = soleil_get_theme_option( 'front_page_blog_bg_image' );
		if ( ! empty( $soleil_bg_image ) ) {
			$soleil_css .= 'background-image: url(' . esc_url( soleil_get_attachment_url( $soleil_bg_image ) ) . ');';
		}
		if ( ! empty( $soleil_css ) ) {
			echo ' style="' . esc_attr( $soleil_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$soleil_anchor_icon = soleil_get_theme_option( 'front_page_blog_anchor_icon' );
	$soleil_anchor_text = soleil_get_theme_option( 'front_page_blog_anchor_text' );
if ( ( ! empty( $soleil_anchor_icon ) || ! empty( $soleil_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_blog"'
									. ( ! empty( $soleil_anchor_icon ) ? ' icon="' . esc_attr( $soleil_anchor_icon ) . '"' : '' )
									. ( ! empty( $soleil_anchor_text ) ? ' title="' . esc_attr( $soleil_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_blog_inner
	<?php
	if ( soleil_get_theme_option( 'front_page_blog_fullheight' ) ) {
		echo ' soleil-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$soleil_css      = '';
			$soleil_bg_mask  = soleil_get_theme_option( 'front_page_blog_bg_mask' );
			$soleil_bg_color_type = soleil_get_theme_option( 'front_page_blog_bg_color_type' );
			if ( 'custom' == $soleil_bg_color_type ) {
				$soleil_bg_color = soleil_get_theme_option( 'front_page_blog_bg_color' );
			} elseif ( 'scheme_bg_color' == $soleil_bg_color_type ) {
				$soleil_bg_color = soleil_get_scheme_color( 'bg_color', $soleil_scheme );
			} else {
				$soleil_bg_color = '';
			}
			if ( ! empty( $soleil_bg_color ) && $soleil_bg_mask > 0 ) {
				$soleil_css .= 'background-color: ' . esc_attr(
					1 == $soleil_bg_mask ? $soleil_bg_color : soleil_hex2rgba( $soleil_bg_color, $soleil_bg_mask )
				) . ';';
			}
			if ( ! empty( $soleil_css ) ) {
				echo ' style="' . esc_attr( $soleil_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_blog_content_wrap content_wrap">
			<?php
			// Caption
			$soleil_caption = soleil_get_theme_option( 'front_page_blog_caption' );
			if ( ! empty( $soleil_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_blog_caption front_page_block_<?php echo ! empty( $soleil_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $soleil_caption, 'soleil_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$soleil_description = soleil_get_theme_option( 'front_page_blog_description' );
			if ( ! empty( $soleil_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_blog_description front_page_block_<?php echo ! empty( $soleil_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $soleil_description ), 'soleil_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_blog_output">
				<?php
				if ( is_active_sidebar( 'front_page_blog_widgets' ) ) {
					dynamic_sidebar( 'front_page_blog_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! soleil_exists_trx_addons() ) {
						soleil_customizer_need_trx_addons_message();
					} else {
						soleil_customizer_need_widgets_message( 'front_page_blog_caption', 'ThemeREX Addons - Blogger' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
