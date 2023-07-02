<?php
/**
 * The template to display Admin notices
 *
 * @package SOLEIL
 * @since SOLEIL 1.0.64
 */

$soleil_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$soleil_skins_args = get_query_var( 'soleil_skins_notice_args' );
?>
<div class="soleil_admin_notice soleil_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins available', 'soleil' ); ?>
	</h3>
	<?php

	// Description
	$soleil_total      = $soleil_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$soleil_skins_msg  = $soleil_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $soleil_total, 'soleil' ), $soleil_total ) . '</strong>'
							: '';
	$soleil_total      = $soleil_skins_args['free'];
	$soleil_skins_msg .= $soleil_total > 0
							? ( ! empty( $soleil_skins_msg ) ? ' ' . esc_html__( 'and', 'soleil' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $soleil_total, 'soleil' ), $soleil_total ) . '</strong>'
							: '';
	$soleil_total      = $soleil_skins_args['pay'];
	$soleil_skins_msg .= $soleil_skins_args['pay'] > 0
							? ( ! empty( $soleil_skins_msg ) ? ' ' . esc_html__( 'and', 'soleil' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $soleil_total, 'soleil' ), $soleil_total ) . '</strong>'
							: '';
	?>
	<div class="soleil_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'soleil' ), $soleil_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="soleil_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $soleil_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'soleil' );
			?>
		</a>
	</div>
</div>
