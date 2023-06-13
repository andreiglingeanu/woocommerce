<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes;

#[\Attribute]
class AllowUnauthenticatedAttribute
{
	public $allow_unauthenticated;

	public function __construct(bool $allow_unauthenticated)
	{
		$this->allow_unauthenticated = $allow_unauthenticated;
	}
}
