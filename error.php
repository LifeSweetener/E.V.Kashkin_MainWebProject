
<html>
	<head>
		<title>Ошибка</title>
		<link rel='stylesheet' type='text/css' href='pStyles.css'/>
	</head>
	<body class='bodyError'>
		<form action='poetry.php' method='POST' class='errorForm'>
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
				
<?php mysql_close(); ?>
