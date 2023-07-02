<?php
namespace TrxAddons\AiHelper;

if ( ! class_exists( 'Options' ) ) {

	/**
	 * Add options to the ThemeREX Addons Options
	 */
	class Options {

		/**
		 * Constructor
		 */
		function __construct() {
			add_filter( 'trx_addons_filter_options', array( $this, 'add_options' ) );
			add_filter( 'trx_addons_filter_export_options', array( $this, 'remove_token_from_export' ) );
		}

		/**
		 * Add options to the ThemeREX Addons Options
		 * 
		 * @hooked trx_addons_filter_options
		 *
		 * @param array $options  Array of options
		 * 
		 * @return array  	  Modified array of options
		 */
		function add_options( $options ) {
			$usage_tokens = '';
			$log = Logger::instance()->get_log();
			if ( is_array( $log ) ) {
				$usage_tokens = __( 'Current usage of tokens:', 'trx_addons' );
				foreach ( $log as $model => $tokens ) {
					$usage_tokens .= '<br />' . sprintf( __( 'Model <b>"%1$s"</b>: <b>%2$d</b> ( %3$d in prompts, %4$d in completions )', 'trx_addons' ), $model, $tokens['total_tokens'], $tokens['prompt_tokens'], $tokens['completion_tokens'] );
				}
			}
			trx_addons_array_insert_before( $options, 'sc_section', apply_filters( 'trx_addons_filter_options_ai_helper', array(
				'ai_helper_section' => array(
					"title" => esc_html__('AI helper', 'trx_addons'),
					'icon' => 'trx_addons_icon-android',
					"type" => "section"
				),
				'ai_helper_info' => array(
					"title" => esc_html__('AI helper', 'trx_addons'),
					"desc" => wp_kses_data( __("Settings of the AI helper.", 'trx_addons') )
							. '<br /><br />'
							. wp_kses( $usage_tokens, 'trx_addons_kses_content' ),
					"type" => "info"
				),
				'ai_helper_token_openai' => array(
					"title" => esc_html__('Open AI token', 'trx_addons'),
					"desc" => wp_kses( sprintf(
													__('Specify a token to use the OpenAI API. You can generate a token in your personal account using the link %s', 'trx_addons'),
													apply_filters( 'trx_addons_filter_openai_api_key_url',
																	'<a href="https://beta.openai.com/account/api-keys" target="_blank">https://beta.openai.com/account/api-keys</a>'
																)
												),
										'trx_addons_kses_content'
									),
					"std" => "",
					"type" => "text"
				),
				'ai_helper_model_openai' => array(
					"title" => esc_html__('Open AI model', 'trx_addons'),
					"desc" => wp_kses_data( __('Select a model to use with OpenAI API', 'trx_addons') ),
					"std" => "gpt-3.5-turbo",
					"options" => apply_filters( 'trx_addons_filter_ai_helper_list_models', Lists::get_list_ai_models() ),
					"type" => "select"
				),
				'ai_helper_temperature' => array(
					"title" => esc_html__('Temperature', 'trx_addons'),
					"desc" => wp_kses_data( __('Select a temperature to use with OpenAI API queries', 'trx_addons') ),
					"std" => 1.0,
					"min" => 0,
					"max" => 2.0,
					"step" => 0.1,
					"type" => "slider"
				),
			) ) );

			return $options;
		}

		/**
		 * Clear some addon specific options before export
		 * 
		 * @hooked trx_addons_filter_export_options
		 * 
		 * @param array $options  Array of options
		 * 
		 * @return array  	  Modified array of options
		 */
		 function remove_token_from_export( $options ) {
			if ( ! empty( $options['ai_helper_token_openai'] ) ) {
				$options['ai_helper_token_openai'] = '';
			}
			return $options;
		}
	}
}
