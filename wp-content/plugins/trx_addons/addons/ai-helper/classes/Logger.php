<?php
namespace TrxAddons\AiHelper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to log queries to the OpenAI API: used tokens in prompt, completion and total
 */
class Logger extends Singleton {

	var $log = array();

	/**
	 * Plugin constructor.
	 *
	 * @access protected
	 */
	protected function __construct() {
		parent::__construct();
		$saved = get_option( 'trx_addons_ai_helper_log' );
		if ( is_array( $saved ) ) {
			$this->log = $saved;
		}
	}

	/**
	 * Return an empty array with log entries for the model
	 * 
	 * @access private
	 * 
	 * @return array  Array with log entries for the model
	 */
	private function get_empty_log() {
		return array(
			'total_tokens' => 0,
			'prompt_tokens' => 0,
			'completion_tokens' => 0,
		);
	}

	/**
	 * Log a query results
	 * 
	 * @access public
	 * 
	 * @param array $response  Response from OpenAI API with completion and usage data
	 */
	public function log( $response ) {
		if ( ! empty( $response['model'] ) && ! empty( $response['usage'] ) ) {
			if ( empty( $this->log[ $response['model'] ] ) ) {
				$this->log[ $response['model'] ] = $this->get_empty_log();
			}
			foreach ( array_keys( $this->log[ $response['model'] ] ) as $k ) {
				if ( ! empty( $response['usage'][ $k ] ) ) {
					$this->log[ $response['model'] ][ $k ] += $response['usage'][ $k ];
				}
			}
		}
		update_option( 'trx_addons_ai_helper_log', $this->log );
	}

	/**
	 * Get log
	 *
	 * @access public
	 * 
	 * @param string $model  Model name
	 * @param string $key    Key to get from log
	 * 
	 * @return int|array     Value from log for the specified model and key or whole log for the specified model or whole log for all models
	 */
	public function get_log( $model = '', $key = '' ) {
		if ( empty( $model ) ) {
			return $this->log;
		} else {
			foreach( $this->log as $m => $v ) {
				if ( strpos( $m, $model ) !== false ) {
					$model = $m;
					break;
				}
			}
			if ( empty( $key ) ) {
				return ! empty( $this->log[ $model ] ) ? $this->log[ $model ] : $this->get_empty_log();
			} else {
				return ! empty( $this->log[ $model ][ $key ] ) ? $this->log[ $model ][ $key ] : 0;
			}
		}
	}
}
