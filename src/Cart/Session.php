<?php
	include_once "./src/Cart/Cart.php";
	include_once "./src/User/User.php";
	session_start();
	
	
	class Session extends Cart
	{
		public array $productList; // массив объектов класса Product
		public int $sessionID;     // число заполняется случайным значением
		public $sessionDateTime;   // заполняется в конструкторе текущей датой и временем
		public object $user;
		
		public function __construct() {
			$this->sessionID = rand(1001, 9999);
			$this->sessionDateTime = time();
		}
		
		public function getCart():array
		{
			parent::getCart();
			return $this->productList;
		}
		/**
		 * Метод принимает объект класса Product и добавляет его к productList,
		 * затем сохраняет объект Session в файл
		 */
		public function addToCart(object $product):void
		{
			parent::addToCart($product);
			$_SESSION['productList'][] = $product;
			
			echo "<pre>";
			print_r($this);
			echo "</pre>";
			
			
		}
		
		public function saveSession() :void
		{
			$this->productList = $_SESSION['productList'];
			$this->sessionID = $_SESSION['sessionID'];
			$this->sessionDateTime = $_SESSION['sessionDateTime'];
			$this->user = $_SESSION["user"];
			
			// получаем данные из файла
			$json_write = file_get_contents('./sessionList.json');
			$sessionList = [];
			if(!filesize('sessionList.json') == 0) {
				$sessionList = json_decode($json_write); // декодируем из json
			}
			$serialize = serialize($this); // сериализуем объект
			$sessionList[] = $serialize;
			
			$json_save = json_encode($sessionList, JSON_UNESCAPED_UNICODE);
			file_put_contents('sessionList.json', $json_save);
			
			unset($_SESSION['productList']);
			
			
		}
		
		/**
		 * Принимает на вход дату и сравнивает с датой в sessionDateTime
		 * если разница больше 5 минут, возвращает false, если нет - true
		 */
		public function isSessionLive() {
		
		}
	}