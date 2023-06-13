<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure;

class Responses
{
	public static function internal_server_error() {
		$r = new \WP_REST_Response("cosa");
		$r->set_status(500);
		return $r;
	}

	public static function unauthorized() {
		return self::wp_error(401, 'unauthorized', 'Sorry, you are not allowed to do that');
	}

	public static function wp_error($status, $code = '', $message = '') {
		return new \WP_Error($code, $message, ['status' => $status]);
	}
}
