<?php

namespace Automattic\WooCommerce\Internal\RestApi\Controllers;

use Automattic\WooCommerce\Internal\RestApi\Infrastructure\ControllerBase;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\RestApiControllerAttribute as RestApiController;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\RestApiEndpointAttribute as RestApiEndpoint;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\AllowedRolesAttribute as AllowedRoles;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\AllowUnauthenticatedAttribute as AllowUnauthenticated;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes\DescriptionAttribute as Description;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\ResponseException;
use Automattic\WooCommerce\Internal\RestApi\Infrastructure\Responses;

use Automattic\WooCommerce\Proxies\LegacyProxy;

#[RestApiController("foo")]
#[AllowedRoles("treintaicuatror,foozer")]
#[AllowUnauthenticated(true)]
#[Description("A simple foo controller.")]
class FooController extends ControllerBase
{
	#[RestApiEndpoint("GET", "fizz/buzz")]
	#[Description('::get_fizz_description')]
	public static function get_fizz(\WP_Rest_Request $request, ?\WP_User $user) {
		throw ResponseException::for_http_status(403, 34);

		throw ResponseException::for_wp_error(402, "ooh", "aah");

		return Responses::unauthorized();
		throw ResponseException::for_http_status(402);
		return "FIZZBUZZ " . ($user == null ? "0" : $user->ID);
	}

	public static function get_fizz_description() {
		return <<<DESC
This is <b>the description</b>.
It mols.
DESC;

	}

	#[RestApiEndpoint("POST,PATCH", "/fizz/buzz")]
	#[AllowedRoles("administratorx,pepe")]
	#[AllowUnauthenticated(false)]
	#[Description("It posts a fizz.")]
	public static function post_fizz(\WP_Rest_Request $request, ?\WP_User $user) {
		return new \WP_Error('code', 'message', ['status' => 403]);
		return "FIZZBUZZPOST " . phpversion() . ' ' . self::$thing;
	}

	public static function duh() {
		echo "bah";
	}
}
