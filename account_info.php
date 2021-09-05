<html>
	
    <head>
        <title>Поэзия для всех</title>
		<link rel='stylesheet' type='text/css' href='Styles.css'/>
		
		<script>
			function leave_() {
				<?php
					$alias = "";
					$age = "";
					$email = "";
					$about = "";
					
					$love = "";
					$war = "";
					$labor = "";
					$nature = "";
					$faith = "";
				?>
				window.location.href = "authorization.php";
			}
		</script>
		
		<?php
			$alias = $_REQUEST["alias"];
			$age = $_REQUEST["age"];
			$email = $_REQUEST["email"];
			$about = $_REQUEST["about"];
			
			$love = $_REQUEST["love"];
			$war = $_REQUEST["war"];
			$labor = $_REQUEST["labor"];
			$nature = $_REQUEST["nature"];
			$faith = $_REQUEST["faith"];
		?>
	</head>
	
    <body class='book'>
		<table style='background: AliceBlue;'>
			<thead>
				<tr>
					<th colspan='2'>Информация о тебе, друг</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align='center'>Псевдоним:</td><td align='center' style='font-weight: 500; font-size: 22pt; color: Green;'><?php echo "$alias"; ?></td>
				</tr>
				<tr>
					<td align='center'>Возраст:</td><td align='center' style='font-weight: 500; font-size: 22pt; color: Green;'><?php echo "$age"; ?></td>
				</tr>
				<tr>
					<td align='center'>Электронная почта:</td><td align='center' style='font-weight: 500; font-size: 22pt; color: Green;'><?php echo "$email"; ?></td>
				</tr>
				<tr>
					<td align='center'>О себе:</td><td align='center' style='font-weight: 500; font-size: 22pt; color: Green;'><?php echo "$about"; ?></td>
				</tr>
				<tr>
					<td align='center'>Основная тематика сочинений:</td><td align='center' style='font-weight: 500; font-size: 22pt; color: Green;'><?php echo ($love != "none") ? "$love " : ""; echo ($war != "none") ? "$war " : ""; echo ($nature != "none") ? "$nature " : ""; echo ($faith != "none") ? "$faith " : ""; echo ($labor != "none") ? "$labor " : ""; ?></td>
				</tr>
				<tr>
					<td align='center'>Произведения:</td><td align='center' style='font-weight: 500; font-size: 22pt; color: Green;'></td>
				</tr>
				<tr>
					<td style='text-align: center;'><button style='width: 75%; margin: 5% auto;' name='leave' id='leave' onclick='leave_();' />Выйти</td>
					<td style='text-align: center;'><a style='width: 75%; margin: 5% auto;' <?php echo "href='main.php?alias=$alias&age=$age&email=$email&about=$about&love=$love&nature=$nature&labor=$labor&war=$war&faith=$faith'"; ?>>Вернуться</a></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>