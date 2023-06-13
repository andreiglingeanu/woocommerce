<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure;

class ResponseException extends \Exception
{
	public $rest_response;

	public function __construct($rest_response, string $message = "", int $code = 0, ?Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->rest_response = $rest_response;
	}

	public static function for_http_status($status_code, $data = null) {
		return new ResponseException(new \WP_REST_Response($data, $status_code));
	}

	public static function for_wp_error($status_code, $error_code, $error_message) {
		return new ResponseException( Responses::wp_error($status_code, $error_code, $error_message ));
	}
}
