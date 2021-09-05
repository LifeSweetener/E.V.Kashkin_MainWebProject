<?php include("help.php"); ?>

<html>
	<head>
		<title>Обработка пользователя...</title>
		<link rel='stylesheet' type='text/css' href='Styles.css'/>
	</head>
	
	<?php if ( !($con = mysql_connect("localhost", "root", "")) ): ?>
		<?php showError("Возникли проблемы с подключением к серверу баз данных! Попробуй еще раз.", "poetry.php", "Обработка пользователя..."); ?>
	<?php endif; ?>
	<?php $dbName = "poetry_for_all"; ?>
	<?php if ( !mysql_select_db($dbName, $con) ): ?>
	<?php showError("Не удалось подключиться к базе данных с именем \"$dbName\" — попробуй еще раз.", "poetry.php", "Обработка пользователя..."); ?>
	<?php endif; ?>
	<?php mysql_set_charset("utf8"); ?>
	
	<?php
	$query = "SELECT * FROM user;";
	$result = executeQuery($query, "poetry.php", "Обработка пользователя...");
	
	$alias = $_POST["alias"];
	$age = $_POST["age"];
	$email = $_POST["email"];
	$pswd = $_POST["password"];
	$reppswd = $_POST["reppassword"];
	$about = $_POST["about"];
	?>
	
	<?php if ($_POST["love"]): ?>
	<?php $love = "love"; ?>
	<?php else: ?>
	<?php $love = ""; ?>
	<?php endif; ?>
	
	<?php if ($_POST["nature"]): ?>
	<?php $nature = "nature"; ?>
	<?php else: ?>
	<?php $nature = ""; ?>
	<?php endif; ?>
	
	<?php if ($_POST["war"]): ?>
	<?php $war = "war"; ?>
	<?php else: ?>
	<?php $war = ""; ?>
	<?php endif; ?>
	
	<?php if ($_POST["faith"]): ?>
	<?php $faith = "faith"; ?>
	<?php else: ?>
	<?php $faith = ""; ?>
	<?php endif; ?>
	
	<?php if ($_POST["labor"]): ?>
	<?php $labor = "labor"; ?>
	<?php else: ?>
	<?php $labor = ""; ?>
	<?php endif; ?>
	
	<?php while ($userDB = mysql_fetch_array($result)): ?>
		<?php if ($email == $userDB["email"]): ?>
		<?php showError("Такой пользователь уже зарегистрирован — попробуй еще раз", "poetry.php", "Обработка пользователя..."); ?>
		<?php endif; ?>
	<?php endwhile; ?>
	
	<?php if ( ! ( (stripos($email, "@yandex.ru")) or (stripos($email, "@ya.ru")) or (stripos($email, "@gmail.com")) or (stripos($email, "@mail.ru")) ) ): ?>
	<body class='bodyError'>
		<font style='color:#FF4500'>Неправильный электронный адрес твоей почты!</font><br><br>  Пожалуйста, повтори ввод своих данных...
	<?php elseif ( ! passwordCheck($pswd) ): ?>
	<body class='bodyError'>
		<font style='color:#FF4500'>Неправильный пароль!</font><br>
	Пароль должен содержать обязательно хотя бы одну цифру, буквы обоих регистров и иметь длину не менее 6-ти символов.<br><br>  Пожалуйста, повтори ввод своих данных...
	<?php elseif ( ! (($age > 11) and ($age < 121)) ): ?>
	<body class='bodyError'>
		<font style='color:#FF4500'>Неправильный возраст!</font><br><br>  Пожалуйста, повтори ввод своих данных...
	<?php elseif ( ($pswd != $reppswd) ): ?>
	<body class='bodyError'>
		<font style='color:#FF4500'>Ты ввёл свой пароль неодинаково в оба поля!</font><br><br>  Пожалуйста, повтори ввод своих данных...
	<?php endif; ?>
	
	<?php if (( ! ( (stripos($email, "@yandex.ru")) or (stripos($email, "@ya.ru")) or (stripos($email, "@gmail.com")) or (stripos($email, "@mail.ru")) ) ) or ( ! passwordCheck($pswd) ) or ( ($pswd != $reppswd) ) or ( ! (($age > 11) and ($age < 121)) )): ?>
	<form action='poetry.php' method='POST' class='errorForm' style='margin: 30px 25%;'>
		<div>
		<button type='submit' name='return' class='acceptButton'>Вернуться</button>
		</div>
		<div>
		<?php
			echo "
			<input type='text' name='alias' id='alias' value='$alias' style='border-color: red; font-size: 16pt;'  />
			<input type='text' name='age' id='age' value='$age' style='border-color: red; font-size: 16pt;'  /><br><br>
			<input type='text' name='email' id='email' value='$email' style='border-color: red; font-size: 16pt;' align='center'  /><br><br>
			<input type='text' name='about' id='about' value='$about' style='border-color: red; font-size: 16pt;' align='center' /><br><br>
			<input type='text' name='love' id='love' value='$love' style='border-color: red; font-size: 16pt;' />
			<input type='text' name='nature' id='nature' value='$nature' style='border-color: red; font-size: 16pt;' />
			<input type='text' name='war' id='war' value='$war' style='border-color: red; font-size: 16pt;' />
			<input type='text' name='faith' id='faith' value='$faith' style='border-color: red; font-size: 16pt;' />
			<input type='text' name='labor' id='labor' value='$labor' style='border-color: red; font-size: 16pt;' />";
	    ?>
		</div>
	</form>
		
	</body>
</html>
	
	<?php exit; ?>
	<?php endif; ?>
	
<?php
	$query = "INSERT INTO user (`nickname`, `age`, `email`, `password`, `subjects`, `about`) VALUES (" . (($alias == '') ? "\"NULL\"" : "\"$alias\"") . ", " . (($age == '') ? "\"NULL\"" : "\"$age\"") . ", " . (($email == '') ? "\"NULL\"" : "\"$email\"") . ", " . (($pswd == '') ? "\"NULL\"" : "\"$pswd\"") . ", (\"" . (($love == '') ? "none" : "$love") . ", " . (($nature == '') ? "none" : "$nature") . ", " . (($war == '') ? "none" : "$war") . ", " . (($faith == '') ? "none" : "$faith") . ", " . (($labor == '') ? "none" : "$labor") . "\"), " . (($about == '') ? "\"NULL\"" : "\"$about\"" ) . ");";
	executeQuery($query, "poetry.php", "Обработка пользователя...");
	
	mysql_close();
	
	echo "
		<a href='main.php?alias=$alias&age=$age&email=$email&password=$pswd&love=$love&nature=$nature&war=$war&faith=$faith&labor=$labor&about=$about'>Перейти на главную!</a><br><br>
	";
	echo "Всё прошло успешно — ты зарегистрирован, друг! :)<br>";
	echo "Нажми на ссылку выше, чтобы перейти на главную страницу нашего сайта.";
?>
		
	
	</body>
</html>