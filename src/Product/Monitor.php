<?php
	include_once "./src/Product/Product.php";
	
	class Monitor extends Product
	{
		private float $diagonal;
		private float $frequency;
		private array $ports;
		
		public function __construct($_name,$_description, $_brand, $_price, $_diagonal, $_frequency, $_ports) {
			$this->name = $_name;
			$this->description = $_description;
			$this->brand = $_brand;
			$this->price = $_price;
			$this->diagonal = $_diagonal;
			$this->frequency = $_frequency;
			$this->ports = $_ports;
			$this->category = "Monitors";
		}
		
		public function getProduct():string
		{
			parent::getProduct();
			
			return implode(', ',[
				"Название: " . $this->name,
				"Цена: " . $this->price . " RUB",
				"Описание: " . $this->description,
				"Бренд: " . $this->brand,
				"Диагональ: " . $this->diagonal . "'",
				"Частота: " . $this->frequency . "Гц",
				"Порты: " . implode(', ', $this->ports)
			]);
		}
	}