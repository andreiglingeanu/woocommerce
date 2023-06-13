<?php

namespace Automattic\WooCommerce\Internal\RestApi\Controller;

use Automattic\WooCommerce\Internal\RestApi\Infrastructure\ControllerBase;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\RestApiControllerAttribute as RestApiController;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\RestApiEndpointAttribute as RestApiEndpoint;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\DescriptionAttribute as Description;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\AllowedRolesAttribute as AllowedRoles;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\ResponseException;

#[RestApiController("/bar")]
#[Description('::controller_description')]
class BarController extends ControllerBase
{
	#[RestApiEndpoint("PATCH", "lol/rofl")]
	public static function patch_rofl($request) {
		echo "ROFL!!!";
	}

	public static function controller_description() {
		return "It's a <i>bar controller</i>\nand that's it.";
	}
}
