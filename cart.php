<?php
	include_once "./src/Product/Monitor.php";
	include_once "./src/Product/Phone.php";
	include_once "./src/Product/Product.php";
	include_once "./src/Category/Category.php";
	include_once "./src/Category/MonitorCategory.php";
	include_once "./src/Category/PhoneCategory.php";
	include_once "./src/Cart/Session.php";
	include_once "./src/User/User.php";
	include_once "./prod.php";
	
	
session_start();
if (isset($_SESSION['productList'])) {
	$productList = $_SESSION['productList'];
	foreach ($productList as $product) {
		echo "<h3>" . $product->getProduct() . "</h3>";
	}
	
} elseif (isset($_GET["sessionID"])) {
	$sessionID = $_GET["sessionID"];
	$json_write = file_get_contents('./sessionList.json'); // достает из файла массив
	$serialList = json_decode($json_write); // декодируем из json
	$productList = [];
	foreach ($serialList as $item) {
		$session = unserialize($item);
		if ($sessionID == $session->sessionID) {
			$productList = $session->productList;
		}
	}
	
	foreach ($productList as $product) {
		echo "<h3>" . $product->getProduct() . "</h3>";
	}
	
} else echo 'Ваша корзина пуста';