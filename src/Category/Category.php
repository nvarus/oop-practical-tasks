<?php
	
	class Category
	{
		public string $name;
		public array $listProducts;
		protected array $filters;
		
		function __construct(string $_name, $_price = "Price")
		{
			$this->name = $_name;
			$this->filters[] = $_price;
		}
	
	}