<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure;

use Automattic\WooCommerce\RestApiControllerAttribute as RestApiController;
use Automattic\WooCommerce\RestApiEndpointAttribute as RestApiEndpoint;
use Automattic\WooCommerce\RequiresRoleAttribute as RequiresRole;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\ResponseException;

class ControllerBase
{
	static $thing;

	public static function init(\WP_Rest_Request $request, ?\WP_User $user) {
		self::$thing = 'thong';
	}
}
