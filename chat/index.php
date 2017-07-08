<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: chat.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>CHATapp</title>
	<link rel="stylesheet" href="style.css" type="text/css" />

</head>

<body>
	
	<div class="login">
		<form action="zaloguj.php" method="post">
			
			<a href="index.php"><img src="img/logo.png" style="width: 150px; height: 150px;"></a><br />
			Login: <br /> <input type="text" name="login" /> <br />
			Hasło: <br /> <input type="password" name="haslo" /> <br />
			<input type="submit" value="Zaloguj się" />
			<br />
			lub <a href="rejestracja.php">zarejestruj</a>

		</form>
		
		<?php
			if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
		?>
	</div>

</body>
</html>