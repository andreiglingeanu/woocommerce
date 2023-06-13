<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes;

#[\Attribute]
class RestApiEndpointAttribute
{
	public $verb;

	public $route;

	public function __construct(string $verb, string $route)
	{
		$this->verb = $verb;
		$this->route = $route;
	}
}
