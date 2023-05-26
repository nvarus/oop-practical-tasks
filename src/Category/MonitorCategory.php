<?php

class MonitorCategory extends Category
{
	public function __construct($_name, $_filters = ["Diagonal", "Frequency"])
	{
		parent::__construct($_name);
		array_push($this->filters, ...$_filters);
	}
}