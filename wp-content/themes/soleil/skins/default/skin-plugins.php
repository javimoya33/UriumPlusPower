<?php
/**
 * Required plugins
 *
 * @package SOLEIL
 * @since SOLEIL 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$soleil_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'soleil' ),
	'page_builders' => esc_html__( 'Page Builders', 'soleil' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'soleil' ),
	'socials'       => esc_html__( 'Socials and Communities', 'soleil' ),
	'events'        => esc_html__( 'Events and Appointments', 'soleil' ),
	'content'       => esc_html__( 'Content', 'soleil' ),
	'other'         => esc_html__( 'Other', 'soleil' ),
);
$soleil_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'soleil' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'soleil' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $soleil_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'soleil' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'soleil' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $soleil_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'soleil' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'soleil' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $soleil_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'soleil' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'soleil' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $soleil_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'soleil' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'soleil' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $soleil_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'soleil' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'soleil' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $soleil_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'soleil' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'soleil' ),
		'required'    => false,
        'install'     => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $soleil_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'soleil' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'soleil' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $soleil_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'soleil' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $soleil_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'soleil' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $soleil_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'soleil' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'soleil' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $soleil_theme_required_plugins_groups['content'],
	),
	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'soleil' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => soleil_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $soleil_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'soleil' ),
		'description' => '',
		'required'    => false,
		'logo'        => soleil_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $soleil_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'soleil' ),
		'description' => '',
		'required'    => false,
		'logo'        => soleil_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $soleil_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'soleil' ),
		'description' => '',
		'required'    => false,
		'logo'        => soleil_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $soleil_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'soleil' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => soleil_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $soleil_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'soleil' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $soleil_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'soleil' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $soleil_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'soleil' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'soleil' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $soleil_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'soleil' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'soleil' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $soleil_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'soleil' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'soleil' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $soleil_theme_required_plugins_groups['other'],
	),
);

if ( SOLEIL_THEME_FREE ) {
	unset( $soleil_theme_required_plugins['js_composer'] );
	unset( $soleil_theme_required_plugins['booked'] );
	unset( $soleil_theme_required_plugins['the-events-calendar'] );
	unset( $soleil_theme_required_plugins['calculated-fields-form'] );
	unset( $soleil_theme_required_plugins['essential-grid'] );
	unset( $soleil_theme_required_plugins['revslider'] );
	unset( $soleil_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $soleil_theme_required_plugins['trx_updater'] );
	unset( $soleil_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
soleil_storage_set( 'required_plugins', $soleil_theme_required_plugins );
