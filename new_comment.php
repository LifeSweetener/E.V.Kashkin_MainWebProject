<?php
	include("help.php");
	
    /* Выполнить подключение к базе данных: */
	if ( !($con = mysql_connect("localhost", "poetryfor-all", "[fC?Ww]Qg[+8*U0w")) )
		showError("Возникли проблемы с подключением к серверу баз данных! Попробуй еще раз.");
	$dbName = "poetry_for_all";
	if ( !mysql_select_db($dbName, $con) )
		showError("Не удалось подключиться к базе данных с именем \"$dbName\" — попробуй еще раз.");
	mysql_set_charset("utf8");
	
	/* "Достать" текст комментария и его автора (автор идентифицируется по "мылу"): */
	$comment = $_REQUEST["comment"];
	$user = $_REQUEST["email"];
	
	/* Проверить комментрий на наличие оскорбительных фраз: */
	if ( !commentCheck($comment) )
		showError("Не удалось добавить твой комментарий — никого не оскорбляй!");
	
	/* Найти и "вытащить" автора комментария из БД: */
	$query = "SELECT * FROM user WHERE email='$user'";
	$result = executeQuery($query);
	if ( !($userDB = mysql_fetch_array($result)) )
		showError("Пользователь $user на сайте не зарегистрирован! Попробуй еще раз.");
	
	/* Добавить комментарий в базу данных: */
	//$user_email = $userDB["$email"];
	$query = "INSERT INTO comment (user, text, date) VALUES (\"$user\", \"$comment\", CURDATE())";
	executeQuery($query);
	
	/* Отключиться от сервера с БД: */
	mysql_close();
	
	/* Сообщить об успешном добавлении комментария в БД: */
	echo "Твой комментарий успешно добавлен!";
?>