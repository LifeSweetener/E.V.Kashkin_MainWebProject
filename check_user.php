<?php
    /* В JavaScript нет интерфейса для работы с БД, поэтому используем всё тот же PHP: */
	include("help.php");
	
	if ( !($con = mysql_connect("localhost", "root", "")) )
		showError("Возникли проблемы с подключением к серверу баз данных! Попробуй еще раз.");
	$dbName = "poetry_for_all";
	if ( !mysql_select_db($dbName, $con) )
		showError("Не удалось подключиться к базе данных с именем \"$dbName\" — попробуй еще раз.");
	mysql_set_charset("utf8");
	
	$query = "SELECT * FROM user;";
	$result = executeQuery($query);
	
	$email = $_GET["email"];
	$password = $_GET["password"];
	
	$em = null;
	$psw = null;
	//Проходимся по всем зарегистрированным пользователям сайта, разыскивая пытающегося сейчас войти (авторизоваться):
	for ($i = 0; $user = mysql_fetch_array($result); ++$i) {
		if (($user["email"] == $email) && ($user["password"] == $password)) {
			$em = $email;
			$psw = $password;
			break;
		}
	}
	if ( ($em == null) || ($psw == null) )
		echo "Неправильный логин или пароль!<br>Попробуй еще раз.";
	else
		echo "{\"user\":{\".alias\":\"{$user['nickname']}\",\".age\":\"{$user['age']}\",\".email\":\"{$user['email']}\",\".password\":\"{$user['password']}\",\".subjects\":\"{$user['subjects']}\",\".about\":\"{$user['about']}\"}}";
?>