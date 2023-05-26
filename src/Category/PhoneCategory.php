<?php

class PhoneCategory extends Category
{
	public function __construct($_name, $_filters = ["RAM", "CountSIM", "HDD", "OS"])
	{
		parent::__construct($_name);
		array_push($this->filters, ...$_filters);
	}
}