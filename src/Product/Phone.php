<?php
	include_once "./src/Product/Product.php";
	
	class Phone extends Product
	{
		private string $cpu;
		private int $ram;
		private int $countSim;
		private int $hdd;
		private string $os;
		
		public function __construct($_name,$_description, $_brand, $_price, $_cpu, $_ram, $_countSim, $_hdd, $_os) {
			$this->name = $_name;
			$this->description = $_description;
			$this->brand = $_brand;
			$this->price = $_price;
			$this->cpu = $_cpu;
			$this->ram = $_ram;
			$this->countSim = $_countSim;
			$this->hdd = $_hdd;
			$this->os = $_os;
			$this->category = "Phones";
		}
		
		public function getProduct():string
		{
			parent::getProduct();
			
			return implode(', ',[
				"Название: " . $this->name,
				"Цена: " . $this->price . " RUB",
				"Описание: " . $this->description,
				"Бренд: " . $this->brand,
				"CPU: " . $this->cpu,
				"RAM: " . $this->ram . "Гб",
				"SIM: " . $this->countSim,
				"HDD: " . $this->hdd . "Гб",
				"OS: " . $this->os
			]);
		}
	}
	