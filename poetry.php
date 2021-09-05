<html>

<head>
    <title>Регистрация</title>
    <link rel='stylesheet' type='text/css' href='StylesAutorization3.css' />
	<script defer type='text/javascript' src='JQuery/jquery.js'></script>
	<!-- Атрибут 'defer' выше говорит браузеру, что скрипт jQuery нужно загрузить в фоне, не останавливая при этом
	основной поток обработки страницы. Это позволит сделать сайт более производительным. -->
	
	<script>
		//Очистить все поля для ввода (сбросить их текущие значения):
		function clear_() {
			var jQ = jQuery.noConflict();  //поменяем стандартный символ начала кода jQuery "$" на буквосочетание "jQ"
			
			jQ("[id *= But]").attr('class', 'checkboxBut_notchecked');
			
			document.getElementById('nature').checked = false;
			document.getElementById('war').checked = false;
			document.getElementById('faith').checked = false;
			document.getElementById('love').checked = false;
			document.getElementById('labor').checked = false;
			
			jQ("[type=text]").val("");
			jQ("[type=number]").val("18");
			jQ("[type=email]").val("");
			jQ("[type=password]").val("");
			jQ("textarea").val("");
			
			/*
			document.getElementById('natureBut').className = "checkboxBut_notchecked";
			document.getElementById('warBut').className = "checkboxBut_notchecked";
			document.getElementById('faithBut').className = "checkboxBut_notchecked";
			document.getElementById('loveBut').className = "checkboxBut_notchecked";
			document.getElementById('laborBut').className = "checkboxBut_notchecked";
			document.getElementById('nature').checked = false;
			document.getElementById('war').checked = false;
			document.getElementById('faith').checked = false;
			document.getElementById('love').checked = false;
			document.getElementById('labor').checked = false;
			
			document.getElementById('alias').value = "";
			document.getElementById('age').value = 18;
			document.getElementById('email').value = "";
			document.getElementById('password').value = "";
			document.getElementById('reppassword').value = "";
			document.getElementById('about').value = "";
			*/
		}
		
		//Управление флажками (у меня настоящие флажки расположены под кнопками с более красивым фоном):
		function checkBox() {
			const button = event.currentTarget;
			
			let checkbox;
			switch(button.id) {
				case 'natureBut':
					checkbox = document.getElementById('nature');
					if (checkbox.checked)
						checkbox.checked = false;
					else
						checkbox.checked = true;
					break;
				case 'warBut':
					checkbox = document.getElementById('war');
					if (checkbox.checked)
						checkbox.checked = false;
					else
						checkbox.checked = true;
					break;
				case 'loveBut':
					checkbox = document.getElementById('love');
					if (checkbox.checked)
						checkbox.checked = false;
					else
						checkbox.checked = true;
					break;
				case 'laborBut':
					checkbox = document.getElementById('labor');
					if (checkbox.checked)
						checkbox.checked = false;
					else
						checkbox.checked = true;
					break;
				case 'faithBut':
					checkbox = document.getElementById('faith');
					if (checkbox.checked)
						checkbox.checked = false;
					else
						checkbox.checked = true;
					break;
			}
			
			if (! (button.className == "checkboxBut_checked") )
				button.className = "checkboxBut_checked";
			else
				button.className = "checkboxBut_notchecked";
		}
	</script>
</head>

<body class='book'>
    <h2>Регистрация на сайте <font class='site-style'>poetry-for-all.ru</font></h2>
    <form action='new_user.php' method='POST'>
        <table>
            <caption>Сообщи нам немножко о себе, пожалуйста:</caption>
            <tbody>
                <tr><td height='40'></td><td height='40'></td></tr>
                <tr>
					<?php
						if ( isset($_POST['alias']) ) {
							$alias = $_POST['alias'];
							echo " <td class='left_td' style='padding: 5% 0 5% 30%'>
											<label for=alias>Прозвище:</label>
											<input type=text name=alias id=alias placeholder='Your alias' maxlength=50 size=20 style='font-size: 16pt' value='$alias' />
										</td>";
						}
						else
							echo " <td class='left_td' style='padding: 5% 0 5% 30%'>
											<label for=alias>Прозвище:</label>
											<input type=text name=alias id=alias placeholder='Your alias' maxlength=50 size=20 style='font-size: 16pt' />
										</td>";
					?>
					<?php
						if ( isset($_POST['age']) ) {
							$age = $_POST['age'];
							echo " <td class='right_td'>
											<label for=age>Возраст: </label>
											<input type=number name=age id=age min=1 max=120 step=1 placeholder='Age' style='font-size: 16pt' value='$age' />
										</td>";
						}
						else
							echo " <td class='right_td'>
											<label for=age>Возраст: </label>
											<input type=number name=age id=age min=1 max=120 step=1 value=18 placeholder='Age' style='font-size: 16pt' />
										</td>";
					?>
                </tr>
                <tr><td height='40'></td><td height='40'></td></tr>
                <tr>
                    <td rowspan='5' class='left_td' style='padding: 5% 0 5% 30%'>
                        <label>Тематика твоих сочинений:</label>
                    </td>
					<?php
						if ( $_POST['nature'] != "" )
							echo " <td class='right_td'>
											<input type='checkbox' value='Nature' id='nature' name='nature' style='z-index: 0; width: 25px; height: 20px;' checked />Природа
											<input type='button' id='natureBut' class='checkboxBut_checked' style='margin: 0 -31%;' onclick='checkBox();' ></input>
										</td>";
						else
							echo "	<td class='right_td'>
											<input type='checkbox' value='Nature' id='nature' name='nature' style='z-index: 0; width: 25px; height: 20px;' />Природа
											<input type='button' id='natureBut' class='checkboxBut_notchecked' style='margin: 0 -31%;' onclick='checkBox();' ></input>
										</td>";
					?>
                </tr>
                <tr>
					<?php
						if ( $_POST['labor'] != "" )
							echo "	<td class='right_td'>
											<input type='checkbox' value='Labor' id='labor' name='labor' id='' style='z-index: 0; width: 25px; height: 20px;' checked />Труд
											<input type='button' id='laborBut' class='checkboxBut_checked' style='margin: 0 -20%;' onclick='checkBox();' ></input>
										</td>";
						else
							echo "	<td class='right_td'>
											<input type='checkbox' value='Labor' id='labor' name='labor' style='z-index: 0; width: 25px; height: 20px;' />Труд
											<input type='button' id='laborBut' class='checkboxBut_notchecked' style='margin: 0 -20%;' onclick='checkBox();' ></input>
										</td>";
					?>
                </tr>
                <tr>
					<?php
						if ( $_POST['love'] != "" )
							echo "	<td class='right_td'>
											<input type='checkbox' value='Love' id='love' name='love' style='z-index: 0; width: 25px; height: 20px;' checked />Любовь
											<input type='button' id='loveBut' class='checkboxBut_checked' style='margin: 0 -29%;' onclick='checkBox();' ></input>
										</td>";
						else
							echo "	<td class='right_td'>
											<input type='checkbox' value='Love' id='love' name='love' style='z-index: 0; width: 25px; height: 20px;' />Любовь
											<input type='button' id='loveBut' class='checkboxBut_notchecked' style='margin: 0 -29%;' onclick='checkBox();' ></input>
										</td>";
					?>
                </tr>
                <tr>
					<?php
						if ( $_POST['war'] != "" )
							echo "	<td class='right_td'>
											<input type='checkbox' value='War' id='war' name='war' style='z-index: 0; width: 25px; height: 20px;' checked />Война
											<input type='button' id='warBut' class='checkboxBut_checked' style='margin: 0 -24%;' onclick='checkBox();' ></input>
										</td>";
						else
							echo "	<td class='right_td'>
											<input type='checkbox' value='War' id='war' name='war' style='z-index: 0; width: 25px; height: 20px;' />Война
											<input type='button' id='warBut' class='checkboxBut_notchecked' style='margin: 0 -24%;' onclick='checkBox();' ></input>
										</td>";
					?>
                </tr>
                <tr>
					<?php
						if ( $_POST['faith'] != "" )
							echo "	<td class='right_td'>
											<input type='checkbox' value='Faith' id='faith' name='faith' style='z-index: 0; width: 25px; height: 20px;' checked />Вера
											<input type='button' id='faithBut' class='checkboxBut_checked' style='margin: 0 -20.5%;' onclick='checkBox();' ></input>
										</td>";
						else
							echo "	<td class='right_td'>
											<input type='checkbox' value='Faith' id='faith' name='faith' style='z-index: 0; width: 25px; height: 20px;' />Вера
											<input type='button' id='faithBut' class='checkboxBut_notchecked' style='margin: 0 -20.5%;' onclick='checkBox();' ></input>
										</td>";
					?>
                </tr>
                <tr><td height='40'></td><td height='40'></td></tr>
                <tr>
					<?php
						if ( isset($_POST['email']) ) {
							$email = $_POST['email'];
							echo " <td class='left_td' colspan='2'>
											<label for='email'><font color='red' size='6'><sup><b>*</b></sup></font>Электронный адрес (e-mail):</label>
											<input type='email' required placeholder='poet@gmail.com' id='email' name='email' style='font-size: 16pt' value='$email' />
									    </td>";
						}
						else
							echo " <td class='left_td' colspan='2'>
											<label for='email'><font color='red' size='6'><sup><b>*</b></sup></font>Электронный адрес (e-mail):</label>
											<input type='email' required placeholder='poet@gmail.com' id='email' name='email' style='font-size: 16pt' />
									    </td>";
					?>
                </tr>
                <tr><td height='40'></td><td height='40'></td></tr>
				<tr>
					<td class='left_td' colspan='2'>
						<label for='password'><font color='red' size='6'><sup><b>*</b></sup></font>Пароль от твоей будущей учётной записи: </label>
						<input type='password' required id='password' name='password' placeholder='Your password' min='8' max='20' size='20' maxlength='20' style='font-size: 16pt' />
					</td>
				</tr>
                <tr><td height='40'></td><td height='40'></td></tr>
				<tr>
					<td class='left_td' colspan='2'>
						<label for='reppassword'><font color='red' size='6'><sup><b>*</b></sup></font>Повтори пароль для надёжности: </label>
						<input type='password' required id='reppassword' name='reppassword' placeholder='Repeat your password' min='8' max='20' size='20' maxlength='20' style='font-size: 16pt' />
					</td>
				</tr>
                <tr><td height='40'></td><td height='40'></td></tr>
                <tr>
					<?php
						if ( isset($_POST['about']) ) {
							$about = $_POST['about'];
							echo " <td class='left_td' colspan='2'>
											<label for='about'>Расскажи о себе ещё что-нибудь, если хочешь:</label>
											<textarea placeholder='Not more than 1000 symbols, Bro :)' id='about' name='about' maxlength='1000' rows='3' style='font-size: 16pt' >$about</textarea>
										</td>";
						}
						else
							echo " <td class='left_td' colspan='2'>
											<label for='about'>Расскажи о себе ещё что-нибудь, если хочешь:</label>
											<textarea placeholder='Not more than 1000 symbols, Bro :)' id='about' name='about' maxlength='1000' rows='3' style='font-size: 16pt'></textarea>
										</td>";
					?>
                </tr>
                <tr><td height='40'></td><td height='40'></td></tr>
                <tr>
                    <td class='left_td' colspan='2'>
                        <button type='submit' name='ok' >Зарегистрироваться</button>
                        <button id='reset' name='reset' onclick='clear_();' >Заново</button>
					</td>
                </tr>
				<tr><td height='40'></td><td height='40'></td></tr>
            </tbody>
        </table>
    </form>
</body>

</html>