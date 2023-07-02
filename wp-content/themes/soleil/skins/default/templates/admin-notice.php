<?php
/**
 * The template to display Admin notices
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.1
 */

$soleil_theme_slug = get_option( 'template' );
$soleil_theme_obj  = wp_get_theme( $soleil_theme_slug );
?>
<div class="soleil_admin_notice soleil_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$soleil_theme_img = soleil_get_file_url( 'screenshot.jpg' );
	if ( '' != $soleil_theme_img ) {
		?>
		<div class="soleil_notice_image"><img src="<?php echo esc_url( $soleil_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'soleil' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="soleil_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'soleil' ),
				$soleil_theme_obj->get( 'Name' ) . ( SOLEIL_THEME_FREE ? ' ' . __( 'Free', 'soleil' ) : '' ),
				$soleil_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="soleil_notice_text">
		<p class="soleil_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $soleil_theme_obj->description ) );
			?>
		</p>
		<p class="soleil_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'soleil' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="soleil_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=soleil_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'soleil' );
			?>
		</a>
	</div>
</div>
