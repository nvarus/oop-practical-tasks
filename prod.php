<?php
	include_once "./src/Product/Monitor.php";
	include_once "./src/Product/Phone.php";
	include_once "./src/Product/Product.php";
	$products = [
		new Phone('iPhone 7', 'Phone', 'Apple',29000, 'A9', 1, 1, 128, 'IOS'),
		new Monitor('S24E650', 'Monitor', 'Samsung',14990, 21, 60, ['VGA', 'HDMI', 'DisplayPort']),
		new Phone('Galaxy S10', 'Phone', 'Samsung',39990, 'Snapdragon 860', 3, 1, 128, 'Android'),
		new Monitor('Apple Cinema Display', 'Monitor', 'Apple',98999, 24, 144, ['HDMI', 'DisplayPort']),
		new Phone('Lumia 720', 'Phone', 'Nokia',19900, 'Snapdragon 300', 1, 1, 32, 'Windows Phone'),
	];
	
	
	include_once "./src/Category/Category.php";
	include_once "./src/Category/MonitorCategory.php";
	include_once "./src/Category/PhoneCategory.php";
	$category = [
		new MonitorCategory('Monitors'),
		new PhoneCategory('Phones')
	];
	
	
	include_once "./src/Cart/Session.php";
	
	
	
	
	
	$session = new Session();