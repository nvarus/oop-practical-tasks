<?php
	include_once "./src/Product/Monitor.php";
	include_once "./src/Product/Phone.php";
	include_once "./src/Product/Product.php";
	include_once "./src/Category/Category.php";
	include_once "./src/Category/MonitorCategory.php";
	include_once "./src/Category/PhoneCategory.php";
	include_once "./src/Cart/Session.php";
	include_once "./handler.php";
	include_once "./prod.php";
	include_once "./src/User/User.php";
	
	session_start();
	if (!isset($_SESSION["sessionID"])) {
		$_SESSION["sessionID"] = $session->sessionID;
		$_SESSION["sessionDateTime"] = $session->sessionDateTime;
	}
	
	foreach ($category as $cat) {
		foreach ($products as $product) {
			if ($product->category == $cat->name) {
				$cat->listProducts[] = $product;
			}
		}
	}
	
	$user1 = new User("ivan", "ivan@mail.com");
	$user2 = new User("nikolay", "nikolay@mail.com");
	$user3 = new User("semen", "semen@mail.com");
	$user4 = new User("peter", "peter@mail.com");
	$user5 = new User("sidor", "sidor@mail.com");
	
	$userList = [$user1, $user2, $user3, $user4, $user5];
	

?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
		.go-form {
			 display: flex;
			 justify-content: center;
			 align-items: center;
			 margin: 0;
		}
		.prod-line {
			border: 1px solid gray;
			display: flex;
			justify-content: space-between;
			align-items: center;
			 padding: 15px;
			 margin-bottom: 0px;
			 max-width: 750px;
			 border-radius: 5px;
     }
	  
	  .prod-line__product {
		   margin: 0;
		   flex-basis: 80%;
	  }
	  .btn {
		   border: solid 1px teal;
		   margin: 7px;
		   width: 120px;
		   background: none;
		   display: block;
	     font-weight: 600;
	     line-height: 25px;
		   cursor: pointer;
		   border-radius: 5px;
		   color: teal;
	  }
	  .btn:hover {
		   background: teal;
		   color: white;
	  }
	  
	</style>
</head>
<body>
<?php
	/** Номер и время сессии */
	$userName = (isset($_SESSION["user"])) ? $_SESSION["user"]->name : "Пользователь не выбран";
	echo "<b>UserName: </b>" . $userName;
	echo "<b> Session ID: </b>" . $_SESSION["sessionID"];
	echo "<b> Session Date:</b>" . date("d.m.y H:i:s", $_SESSION["sessionDateTime"]) . "<br>";
	
	
	
	/**
	 * Выбор пользователя:
	 * при выборе пользователя, присваивается значение userName
	 */
	echo "<form action='index.php' method='post'>";
	echo "<h3 style='color: teal;margin-bottom: 5px'>Выберите пользователя</h3>";
	foreach ($userList as $user) {
		$us = $user->name;
		echo "<button name='userName' value='$us' class='btn' style='display: inline-block; transform: scale(0.9)' >" . $us . "</button>";
	}
	echo "</form>";
	// если выбран пользователь, сохраняем объект пользователя в $_SESSION['user']
	if (isset($_POST['userName'])) {
		foreach ($userList as $user) {
			if ($user->name == $_POST['userName']) {$_SESSION['user'] = $user;}
		}
		$_SESSION["sessionID"] = $session->sessionID;
		$_SESSION["sessionDateTime"] = $session->sessionDateTime;
		// если меняем пользователя, получаем новый номер сессии и дату и сохраняем старую сессию
		if (isset($_SESSION['productList']) && count($_SESSION['productList']) != 0) {    // если список продуктов не пуст, сохраняем сессию в файл
			$session->saveSession();
		}
		
		
	}
	foreach ($userList as $user) {
		$str = $user->getUser();
		echo '<a href="session.php?userName=' . $user->name . '">' .$str. '</a></br>';
	}
	
	/**
	 * Форма для вывода кнопок с категориями товаров
	 */
	echo "<form action='index.php' method='post'>";
	foreach ($category as $cat) {
		echo "<button class='category-btn btn' name='category' value='$cat->name'>$cat->name</button>";
	}
	echo "</form>";
	
	
	/**
	 * Вывод продуктов на экран
	 */
	if (isset($_POST["category"])) {
		foreach ($category as $cat) {
			if ($cat->name == $_POST["category"]) {
				
				foreach ($cat->listProducts as $product) {
					$prod = $product->getProduct();
					$name = $product->name;
					echo "<div class='prod-line'>";
					echo "<p class='prod-line__product'>$prod</p>";
					echo "<button name='$name' class='prod-line__btn-add btn'>Add to Cart</button>";
					echo "<form class='go-form' action='cart.php'>";
					echo "<button class='prod-line__btn-go btn'>Go To Cart</button>";
					echo "</form>";
					
					echo "</div>";
				}
			}
		}
	}
	

?>
<script>
	const ajax = createAjaxObject();
	
	// создаем AJAX объект
	function createAjaxObject() {
		let ajax = null;
		try {
			ajax = new XMLHttpRequest();
			console.log("запускаю XMLHttpRequest")
		} catch (e) {
			try {
				ajax = new ActiveXObject("MicrosoftXMLHTTP");
				console.log("запускаю MicrosoftXMLHTTP")
			} catch (e) {
				alert("AJAX не поддерживается вашим браузером!")
				return false;
			}
		}
		return ajax;
	}
	
	document.querySelectorAll(".prod-line__btn-add").forEach(btn => {
		btn.addEventListener('click', (e) => {
			const prodName = e.target.name;
			ajaxRequest({"prodName": prodName});
		})
	})
	
	
	
	
	function ajaxRequest(objectValues) {
		let json = JSON.stringify(objectValues)
		if (ajax.readyState === 4 || ajax.readyState === 0) {
			ajax.open("POST", "handler.php", true);
			ajax.setRequestHeader("Content-type", 'application/json; charset=utf-8');
			ajax.send(json);
			ajax.onreadystatechange = () => {
				if (ajax.readyState === 4 && ajax.status === 200) {
					document.getElementById("result").innerHTML = ajax.responseText;
				}
			}
		}
	}
	
</script>
<div id="result"></div>
</body>
</html>
