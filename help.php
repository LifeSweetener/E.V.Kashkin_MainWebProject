<?php
	/* Вспомогательные функции: */
	/* ====================================================== */
	// 1) Уведомить пользователя об ошибке и предложить вернуться к набору комментария:
	function showError($errText, $backAddrs = "main.php", $title="Обработка комментария...") {
		switch($title) {
			case "Обработка комментария...":
				$data = $_POST["comment"];
				break;
			case "Обработка пользователя...":
				$data = "\nПрозвище: " . ($_POST["alias"]) . "\nВозраст: " . ($_POST["age"]) . "\nЭлектронный адрес: " . ($_POST["email"]) . "\nО себе: " . ($_POST["about"]);
				break;
		}
		
		echo "
					<html>
					<head>
						<title>$title</title>
						<link rel='stylesheet' type='text/css' href='pStyles.css'/>
					</head>
					<body class='bodyError'>
						<form action='$backAddrs' method='POST' class='errorForm'>
							<div style='position:absolute; left:10%'>
								<p>$errText</p>
							</div>
							<div style='position:absolute; left:50%'>
								<p><input type='submit' class='acceptButton'/></p>
							</div>
							<div style='position:absolute; top:50%'>
								<p class='header'>Твои данные:</p>
								<p><input type='text' readonly value='$data'/></p>
							</div>
						</form>
					</body>
					</html>
				";
		mysql_close();
		die;
	}
	
	// 2) Безопасно выполнить SQL-скрипт:
	function executeQuery($query, $backAddrs = "main.php", $title="Обработка комментария...") {
		if (! ($result = mysql_query($query)) )
			showError("Ошибка в выполнении SQL-команды \"$query\" — попробуй еще раз.", $backAddrs, $title);
		
		return $result;
	}
	
	// 3) Проверить текст комментария на наличие нецензурных, бранных выражений:
	function commentCheck($comment) {
		return ( !( strstr($comment, "сука") or strstr($comment, "суки") or strstr($comment, "суке") or strstr($comment, "суку") or strstr($comment, "гавно") or strstr($comment, "говно") or strstr($comment, "жопа") or strstr($comment, "пенис") or strstr($comment, "хуй") or strstr($comment, "пидарас") or strstr($comment, "пидорас") or strstr($comment, "пидор") or strstr($comment, "пидр") or strstr($comment, "пидар") ) );
	}
	
	//4) Проверка надежности пароля пользователя:
	function upperAndLowerCase($pswd) {
		if (( (strpbrk($pswd, "A")) or (strpbrk($pswd, "B")) or (strpbrk($pswd, "C")) or (strpbrk($pswd, "D")) or (strpbrk($pswd, "E")) or (strpbrk($pswd, "F")) or (strpbrk($pswd, "G")) or (strpbrk($pswd, "H")) or (strpbrk($pswd, "I")) or (strpbrk($pswd, "J")) or (strpbrk($pswd, "K")) or (strpbrk($pswd, "L")) or (strpbrk($pswd, "M")) or (strpbrk($pswd, "N")) or (strpbrk($pswd, "O")) or (strpbrk($pswd, "P")) or (strpbrk($pswd, "Q")) or (strpbrk($pswd, "R")) or (strpbrk($pswd, "S")) or (strpbrk($pswd, "T")) or (strpbrk($pswd, "U")) or (strpbrk($pswd, "V")) or (strpbrk($pswd, "W")) or (strpbrk($pswd, "X")) or (strpbrk($pswd, "Y")) or (strpbrk($pswd, "Z")) ) and ( (strpbrk($pswd, "a")) or (strpbrk($pswd, "b")) or (strpbrk($pswd, "c")) or (strpbrk($pswd, "d")) or (strpbrk($pswd, "e")) or (strpbrk($pswd, "f")) or (strpbrk($pswd, "g")) or (strpbrk($pswd, "h")) or (strpbrk($pswd, "i")) or (strpbrk($pswd, "j")) or (strpbrk($pswd, "k")) or (strpbrk($pswd, "l")) or (strpbrk($pswd, "m")) or (strpbrk($pswd, "n")) or (strpbrk($pswd, "o")) or (strpbrk($pswd, "p")) or (strpbrk($pswd, "q")) or (strpbrk($pswd, "r")) or (strpbrk($pswd, "s")) or (strpbrk($pswd, "t")) or (strpbrk($pswd, "u")) or (strpbrk($pswd, "v")) or (strpbrk($pswd, "w")) or (strpbrk($pswd, "x")) or (strpbrk($pswd, "y")) or (strpbrk($pswd, "z")) ))
			return true;
		else
			return false;
	}
	
	function passwordCheck($pswd) {
		$thereAreDigits = ( (strpbrk($pswd, "0")) or (strpbrk($pswd, "1")) or (strpbrk($pswd, "2")) or (strpbrk($pswd, "3")) or (strpbrk($pswd, "4")) or (strpbrk($pswd, "5")) or (strpbrk($pswd, "6")) or (strpbrk($pswd, "7")) or (strpbrk($pswd, "8")) or (strpbrk($pswd, "9")) );
		$safeSize = (strlen($pswd) > 5);
		$thereAreAllCasesLetters = upperAndLowerCase($pswd);
		
		return ($thereAreDigits and $thereAreAllCasesLetters and $safeSize);
	}
	/* ====================================================== */
?>