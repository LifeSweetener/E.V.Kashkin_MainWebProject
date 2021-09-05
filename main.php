<?php
	include("help.php");
	
	//БАЗА ДАННЫХ — достаём комментарии из неё:
	if ( !($con = mysql_connect("localhost", "root", "")) )
		showError("Возникли проблемы с подключением к серверу баз данных! Попробуй еще раз.");
	$dbName = "poetry_for_all";
	if ( !mysql_select_db($dbName, $con) )
		showError("Не удалось подключиться к базе данных с именем \"$dbName\" — попробуй еще раз.");
	mysql_set_charset("utf8");
	
	$query = "SELECT * FROM comment";
	$result = executeQuery($query);
	
	$counter = 0;
	
	//Определяем текущего пользователя, перешедшего на главную страницу нашего сайта:
	$alias = $_REQUEST["alias"];
	if ($alias == "")
		$alias = "Poet";
	$age = $_REQUEST["age"];
	$email = $_REQUEST["email"];
	$pswd = $_REQUEST["password"];
	$about = $_REQUEST["about"];
	$love = $_REQUEST["love"];
	$nature = $_REQUEST["nature"];
	$war = $_REQUEST["war"];
	$faith = $_REQUEST["faith"];
	$labor = $_REQUEST["labor"];
?>
<html>
	
    <head>
        <title>Поэзия для всех</title>
		<link rel='stylesheet' type='text/css' href='Styles.css'/>
		
		<script defer type='text/javascript' src='JQuery/jquery.js'></script>
		<!-- Атрибут 'defer' выше говорит браузеру, что скрипт jQuery нужно загрузить в фоне, не останавливая при этом
		основной поток обработки страницы. Это позволит сделать сайт более производительным. -->
	
		<script>
			function getRandomInt(min, max) {
				return Math.floor(Math.random() * (max - min)) + min;
			}
			
			/* Функция создания объекта-запроса, дающая возможность спокойно
			использовать его во всех популярных браузерах: */
			function СreateRequest()
			{
				var Request = false;

				if (window.XMLHttpRequest)
				{
					//Gecko-совместимые браузеры, Safari, Konqueror
					Request = new XMLHttpRequest();
				}
				else if (window.ActiveXObject)
				{
					//Internet explorer
					try
					{
						Request = new ActiveXObject("Microsoft.XMLHTTP");
					}    
					catch (CatchException)
					{
						Request = new ActiveXObject("Msxml2.XMLHTTP");
					}
				}
 
				if (!Request)
					alert("Невозможно создать XMLHttpRequest");
    
				return Request;
			}
			
			function send_() {
				const email = document.getElementById('email').value;  //достаём email комментирующего статью пользователя
				const comment = document.getElementById('comment').value;  //достаём текст комментария
				
				const request = СreateRequest();  //создаем экземпляр класса XMLHttpRequest (см. функцию выше)
				const url = "new_comment.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос
				const params = "?email=" + email + "&comment=" + comment;  //указываем параметры, которые будем передавать
				
				//request.responseType = "json";
				//request.open("POST", url, true);  //настраиваем запрос
				request.open('GET', url + params, true);
				//request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");  //устанавливаем значение заголовка
				<?php
					$query = "SELECT * FROM comment";
					$result = executeQuery($query);
					for ($i = 1; $comment = mysql_fetch_array($result); ++$i) {}
				?>
				//Ждём ответа от сервера и выполняем требуемые действия по его получении:
				request.onreadystatechange = function() {
							/* Свойство readyState обозначает готовность объекта-запроса: 4-ка говорит нам, что запрос полностью инициализирован, и получен ответ от сервера.
								Св-во status определяет состояние ответа от сервера. */
							if (request.readyState == 4 && request.status == 200) {
								var answer = request.responseText;
								if (answer == "﻿Твой комментарий успешно добавлен!") {
									let date = new Date();
									let year = date.getFullYear()
									let month = date.getMonth()+1;
									if (month < 10)
										month = "0" + month;
									let day = date.getDate();
									if (day < 10)
										day = "0" + day;
									let i = getRandomInt(0, 2);
									if (i == 0)
										var styleAttr = "style=\"background: PaleVioletRed; color: Linen;\">";
									else
										var styleAttr = "style=\"background: HotPink; color: Linen;\">";
									
									let markup = "<tr><td class=\"common\" " + styleAttr + " Ваш комментарий " + ", " + email + " (" + day + "-" + month + "-" + year + "): </td><td class=\"common\" " + styleAttr + comment + "</td></tr>";
									
									$("#basic").append(markup);
								} else {
									$("#basic").append("<td class='common' colspan='2'><font style='color:red; font-size: 20pt;'>Комментарий не добавлен из-за проблем с сервером либо Ваших оскорбительных фраз!</font></td>");
								}
							}
						};
				
				request.send(null);  //выполняем запрос
			}
		</script>
    </head>
	
    <body class='book'>
		<table class='account_info' data-title='Обо мне'>
			<tr>
			<td>
				<?php
					echo "<a class='a-static' href='account_info.php?alias=$alias&age=$age&email=$email&about=$about&love=$love&nature=$nature&labor=$labor&war=$war&faith=$faith'>$alias</a>";
				?>
			</td>
			</tr>
		</table>
		<table>
			<thead>
				<tr align='center'>
					<th><a href='https://ru.wikipedia.org/'>Правила сайта</a></th><th><a>Коллекция стихов</a></th>
				</tr>
			</thead>
			<tbody id='basic'>
			    <tr height='50'></tr>
				<tr>
					<td class='header' colspan='2'>Немножко о поэзии</td>
				</tr>
				<tr>
					<td class='common' colspan='2'>
						<p>
						Поэзия — это прежде всего творение <font class='important'>человека</font>. Значит, всё в поэзии будет человеческим: стиль подачи,
						язык, цель обсуждения, суть и смысл произведения. Поэзия существует для человека. Для украшения его
						жизни; для того, чтобы эта сухость и привычная обыденность превратились в нечто изящное, приятное и красивое.
						В этом главная ценность всего поэтического.
						</p>
						<p>
						Поэзия пришла к нам, чтобы стереть границы между значениями слов языка и случаями из жизни человека, чтобы
						создать <font class='important'>образы</font>, охватывающие всё частное. Например, слова <font class='special'>&laquo;свет озаряет темноту пещеры&raquo;</font> можно
						применить к человеку, который сильно выделяется для кого-то среди толпы.
						<font>
						
						</font>
						</p>
						<p>
						К поэзии, с философской точки зрения, можно отнести не только прямо словесную форму выражения человеческих мыслей, но
						и музыку, картины, скульптуру, театр, кино и многое другое. Поэзия родственна и знакома каждому человеку — она находится
						в каждом из нас. Там, где есть образ, который скрывает за собой всё многообразие вещей и ситуаций, присутствует поэзия.<br><br>
						<font class='quote'>
						&laquo;Ветер, который так прекрасно замещает музыку и поэзию. Странно, что в краях, где он дует,
						ищут каких-то других средств выражения&raquo;<br><br>
						</font>
						<font class='by'>Эмиль Мишель Чоран</font>
						
						</p>
						<p>
						Поэзия ставит своей целью раскрыть для человека <font class='important'>истину</font>. Туман всегда слишком рассеян и прозрачен, чтобы не исчезнуть —
						не как твердость правды — скалы, сотворенной из любви, веры и самообладания. Поэзия всегда за то, чтобы поведать нам
						эту правду и разрушить шаткую стеклянную стену лжи. Поэтическое слово ежеминутно готово донести до нас
						истинную суть человека, смысл нашего бытия.<br><br>
						<font class='quote'>
						&laquo;Прославим поэтов, у которых один бог — красиво сказанное бесстрашное слово правды&raquo;<br><br>
						</font>
						<font class='by'>Максим Горький</font>
						<br><br>
						<img src='images/Пастернак.jpg'></img>
						</p>
						<p>
						Однозначные факты сухой, но всё равно являющейся неотъемлемой частью выражения наших мыслей, <font class='important'>прозаической речи</font>, можно
						рассказать в совсем иной форме — в виде красивых поэтических образов, которые окунут нас в другой чудесный всеобъемлющий
						мир.
						</p>
						<p>
						У поэзии есть много разных специфических форм, каждая из которых обладает своими чертами. Все они построены на трех
						главных видах поэтического искусства — <font class='important'>лирике</font>, <font class='important'>эпосе</font> и <font class='important'>драме</font>.
						</p>
						<p>
						Лирика означает проникновение в душу человека, перебор его чувств, описание внутреннего человеческого мира. Она несет субъективный,
						эмоциональный и сентиментальный характер. Эпос же наоборот — стремится показать воспринимающему внешний мир, его историю, наиболее
						значимые произошедшие события. То есть эпос включает в себя более объективный оттенок. В этом жанре смысл может доноситься необязательно от лица
						автора произведения, но и от лица сведетеля, очевидца происшествия, участника события.
						</p>
						<p>
						А драматический жанр занимает промежуточное место между лирикой и эпосом. В нем совмещаются чувства человека и его поступки во внешнем мире,
						его отношения с другими, окружающими людьми.
						</p>
						<p>
						Поэзия всегда останется вместе с нами, хотим мы того или нет. Она может изменить свой облик, свою манеру подачи, но <font class='important'>поэтический смысл вечен</font>.
						Он будет сопровождать нас всю нашу жизнь.
						<br><br>
						<img src='images/Фрост.jpg' width='1040' height='720'></img>
						</p>
					</td>
				</tr>
				<tr>
					<td class='header' colspan='2'>Обсуждение</td>
				</tr>
				<?php
					$query = "SELECT * FROM comment";
					$result = executeQuery($query);
					for ($i = 1; $comment = mysql_fetch_array($result); ++$i) {
						$email = $comment["user"];
						$date = $comment["date"];
						$text = $comment["text"];
						if ($i % 2 == 0)
							echo '<tr><td width=\'40%\' class=\'common\' style=\'background: PaleVioletRed; color: Linen;\' >' . ' Комментарий №<font style=\'color: Pink\'>' . $i . '</font>, ' . $email . ' (' . $date . '): </td><td style=\'background: PaleVioletRed; color: Linen;\' class=\'common\'>' . $text . '</td>';
						else
							echo '<tr><td class=\'common\' style=\'background: HotPink; color: Linen;\' >' . ' Комментарий №<font style=\'color: MediumVioletRed\'>' . $i . '</font>, ' . $email . ' (' . $date . '): </td><td style=\'background: HotPink; color: Linen;\' class=\'common\'>' . $text . '</td>';
					}
				?>
				<tr><td class='common' colspan='2' height='50px'></td></tr>
				<?php
					$email = $_REQUEST["email"];
					echo "
								<tr>
									<td class='common' class='email' colspan='2'><label for='comment'>Твой комментарий, </label><input type='hidden' id='email' name='email' value='$email'>$email</input></td>
								</tr>
							  ";
					$comment = $_POST["comment"];
					if ($comment)
						echo "
										<tr>
											<td class='common' colspan='2'><textarea class='input' style='padding: 3% auto;' maxlength='5000' cols='50' rows='10' name='comment' id='comment' placeholder='Введи сюда свой комментарий'>$comment</textarea></td>
										</tr>
									";
					else
						echo "
										<tr>
											<td class='common' colspan='2'><textarea class='input' style='padding: 3% auto;' maxlength='5000' cols='50' rows='10' name='comment' id='comment' placeholder='Введи сюда свой комментарий'></textarea></td>
										</tr>
									";
				?>
					<tr>
						<td class='common'></td>
						<td class='common'><button id='ok' name='ok' onclick='send_();'>Отправить</button></td>
					</tr>
			</tbody>
		</table>
    </body>

</html>