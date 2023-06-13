<?php

namespace Automattic\WooCommerce\Internal\RestApi\Infrastructure\Attributes;

#[\Attribute]
class DescriptionAttribute
{
	public $description;

	public function __construct(string $description)
	{
		$this->description = $description;
	}
}
