<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes;

#[\Attribute]
class RestApiControllerAttribute
{
	public $root_path;

	public function __construct($root_path = null)
	{
		$this->root_path = $root_path;
	}
}
