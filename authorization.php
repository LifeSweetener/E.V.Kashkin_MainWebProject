<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Авторизация</title>
		<link rel='stylesheet' type='text/css' href='StylesAutorization2.css' />
		
		<script>
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
			
			/* Обработчик события нажатия на кнопку авторизационной формы: */
			function checkUser() {
				const email = document.getElementById('email').value;  //достаём email входящего на сайт пользователя
				const password = document.getElementById('password').value;  //достаём его пароль
				
				const request = СreateRequest();  //создаем экземпляр класса XMLHttpRequest (см. функцию выше)
				const url = "check_user.php";  //указываем путь до файла на сервере, который будет обрабатывать наш запрос
				const params = "?email=" + email + "&password=" + password;  //указываем параметры, которые будем передавать
				
				//request.responseType = "json";
				//request.open("POST", url, true);  //настраиваем запрос
				request.open('GET', url + params, true);
				//request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");  //устанавливаем значение заголовка
				
				//Ждём ответа от сервера и выполняем требуемые действия по его получении:
				request.onreadystatechange = function() {
							/* Свойство readyState обозначает готовность объекта-запроса: 4-ка говорит нам, что запрос полностью инициализирован, и получен ответ от сервера.
								Св-во status определяет состояние ответа от сервера. */
							if (request.readyState == 4 && request.status == 200) {
								var answer = request.responseText;
								if (answer == "Неправильный логин или пароль!<br>Попробуй еще раз.") {
									const message = document.getElementById('messageParagraph');
									message.innerHTML = answer;
								} else {
									const user = {};
									user.alias = answer.substring(answer.indexOf(".alias")+3+6,answer.indexOf(".age")-3);
									user.age = answer.substring(answer.indexOf(".age")+3+4,answer.indexOf(".email")-3);
									user.email = answer.substring(answer.indexOf(".email")+3+6,answer.indexOf(".password")-3);
									user.password = answer.substring(answer.indexOf(".password")+3+9,answer.indexOf(".subjects")-3);
									user.subjects = answer.substring(answer.indexOf(".subjects")+3+9,answer.indexOf(".about")-3);
									if (user.subjects.indexOf("love") != -1)
										var love = "love";
									if (user.subjects.indexOf("war") != -1)
										var war = "war";
									if (user.subjects.indexOf("love") != -1)
										var nature = "nature";
									if (user.subjects.indexOf("love") != -1)
										var faith = "faith";
									if (user.subjects.indexOf("love") != -1)
										var labor = "labor";
									user.about = answer.substring(answer.indexOf(".about")+3+6,answer.indexOf("\"}}"));
									
									window.location.href = "main.php?alias=" + user.alias + "&age=" + user.age + "&email=" + user.email + "&password=" + user.password + "&love=" + love + "&war=" + war + "&nature=" + nature + "&labor=" + labor + "&faith=" + faith + "&about=" + user.about;
								}
							}
						};
				
				request.send(null);  //выполняем запрос
			}
		</script>
		
    </head>
    <body>
        <table>
			<tr>
				<td>
					<label for='email'>Твой e-mail: </label>
					<input type='email' id='email' placeholder='user@gmail.com' />
				</td>
			</tr>
			<tr>
				<td>
					<label for='password'>Твой пароль: </label>
					<input type='password' id='password' placeholder='Пароль' />
				</td>
			</tr>
			<tr height='50px'>
				<td>
					<a href='poetry.php'>Регистрация</a>
				</td>
			</tr>
			<tr>
				<td>
					<button id='button' onclick='checkUser();' >Войти</button>
				</td>
			</tr>
			<tr>
				<td>
					<p id='messageParagraph' class='message'></p>
				</td>
			</tr>
		</table>
    </body>
</html>