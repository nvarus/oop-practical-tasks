<?php
	
	class User
	{
		public string $name;
		public string $email;
		public function __construct($_name, $_email) {
			$this->name = $_name;
			$this->email = $_email;
		}
		
		
		public function getUser():string {
			return "{$this->name}-{$this->email}";
		}
	}