<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'soleil_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'soleil_cf7_theme_setup9', 9 );
	function soleil_cf7_theme_setup9() {
		if ( soleil_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'soleil_cf7_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_cf7', 'soleil_cf7_frontend_scripts', 10, 1 );
			add_filter( 'soleil_filter_merge_styles', 'soleil_cf7_merge_styles' );
			add_filter( 'soleil_filter_merge_scripts', 'soleil_cf7_merge_scripts' );
		}
		if ( is_admin() ) {
			add_filter( 'soleil_filter_tgmpa_required_plugins', 'soleil_cf7_tgmpa_required_plugins' );
			add_filter( 'soleil_filter_theme_plugins', 'soleil_cf7_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'soleil_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('soleil_filter_tgmpa_required_plugins',	'soleil_cf7_tgmpa_required_plugins');
	function soleil_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( soleil_storage_isset( 'required_plugins', 'contact-form-7' ) && soleil_storage_get_array( 'required_plugins', 'contact-form-7', 'install' ) !== false ) {
			// CF7 plugin
			$list[] = array(
				'name'     => soleil_storage_get_array( 'required_plugins', 'contact-form-7', 'title' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'soleil_cf7_theme_plugins' ) ) {
	//Handler of the add_filter( 'soleil_filter_theme_plugins', 'soleil_cf7_theme_plugins' );
	function soleil_cf7_theme_plugins( $list = array() ) {
		return soleil_add_group_and_logo_to_slave( $list, 'contact-form-7', 'contact-form-7-' );
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'soleil_exists_cf7' ) ) {
	function soleil_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'soleil_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'soleil_cf7_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_cf7', 'soleil_cf7_frontend_scripts', 10, 1 );
	function soleil_cf7_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && soleil_need_frontend_scripts( 'cf7' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$soleil_url = soleil_get_file_url( 'plugins/contact-form-7/contact-form-7.css' );
			if ( '' != $soleil_url ) {
				wp_enqueue_style( 'soleil-contact-form-7', $soleil_url, array(), null );
			}
			$soleil_url = soleil_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
			if ( '' != $soleil_url ) {
				wp_enqueue_script( 'soleil-contact-form-7', $soleil_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'soleil_cf7_merge_styles' ) ) {
	//Handler of the add_filter('soleil_filter_merge_styles', 'soleil_cf7_merge_styles');
	function soleil_cf7_merge_styles( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.css' ] = false;
		return $list;
	}
}

// Merge custom scripts
if ( ! function_exists( 'soleil_cf7_merge_scripts' ) ) {
	//Handler of the add_filter('soleil_filter_merge_scripts', 'soleil_cf7_merge_scripts');
	function soleil_cf7_merge_scripts( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.js' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( soleil_exists_cf7() ) {
	$soleil_fdir = soleil_get_file_dir( 'plugins/contact-form-7/contact-form-7-style.php' );
	if ( ! empty( $soleil_fdir ) ) {
		require_once $soleil_fdir;
	}
}
