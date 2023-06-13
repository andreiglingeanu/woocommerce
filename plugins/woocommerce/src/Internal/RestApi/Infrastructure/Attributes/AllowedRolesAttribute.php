<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes;

#[\Attribute]
class AllowedRolesAttribute
{
	public $roles;

	public function __construct($roles)
	{
		$this->roles = $roles;
	}
}
