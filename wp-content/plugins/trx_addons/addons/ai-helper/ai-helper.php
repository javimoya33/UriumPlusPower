<?php
/**
 * AI Helper - a companion to write a title, an excerpt and a post content with AI technologies
 *
 * @addon ai-helper
 * @version 1.0
 *
 * @package ThemeREX Addons
 * @since v2.20.0
 */

namespace TrxAddons\AiHelper;

// Register autoloader for the addon's classes
require TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_ADDONS . 'ai-helper/autoloader.php';
Autoloader::run();

// Add options to the ThemeREX Addons Options
new Options();

// Load a Gutenberg support
if ( ( function_exists( 'trx_addons_gutenberg_is_preview' ) && trx_addons_gutenberg_is_preview() )
	|| ( wp_is_json_request() && strpos( trx_addons_get_current_url(), 'ai-helper/v1' ) !== false )
) { 
	new Gutenberg\Helper();
}

// Load a MediaSelector support
// if ( trx_addons_is_post_edit() || ( wp_is_json_request() && strpos( trx_addons_get_current_url(), 'ai-helper/v1' ) !== false ) ) {
// 	new Media\Helper();
// }
