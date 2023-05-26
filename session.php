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
	
	
	$userName = $_GET['userName'];
	if(!filesize('sessionList.json') == 0) {
		$json_write = file_get_contents('./sessionList.json'); // достает из файла массив
		$serialList = json_decode($json_write); // декодируем из json
		// проходим по массиву, десериализуем элементы и отбираем только объекты текущего пользователя
		$sessionList = [];
		foreach ($serialList as $item) {
			$sessionObj = unserialize($item);
			if ($userName == $sessionObj->user->name) {
				$sessionList[] = $sessionObj;
			}
		}
		$_SESSION["sessionList"] = $sessionList;
		
		foreach ($sessionList as $session) {
			echo "<span>";
			echo date("d.m.y H:i:s", $session->sessionDateTime);
			echo '<a href="cart.php?sessionID=' . $session->sessionID . '">';
			echo "\t" . "$session->sessionID";
			echo "</a><br>";
			echo "</span>";
		}
		
	} else echo "Нет сохраненных данных";

