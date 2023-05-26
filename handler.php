<?php
	include_once "./src/Cart/Session.php";
	include_once "./src/Category/Category.php";
	include_once "./src/Category/MonitorCategory.php";
	include_once "./src/Category/PhoneCategory.php";
	include_once "./prod.php";
	
	/**
	 * Получение данных с js через AJAX запрос
	 */
	$postData = file_get_contents('php://input');
	$data = json_decode($postData, true);
	
	/**
	 * Добавление продукта в productList класса Session
	 */
	if (isset($data['prodName'])) {
		foreach ($products as $prod) {
			if($prod->name == $data['prodName']) {
				$session->addToCart($prod);
			}
		}
	}
	
	if (isset($data['categoryName'])) {
	
	}
