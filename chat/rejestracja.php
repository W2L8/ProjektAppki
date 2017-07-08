<?php

	session_start();
		
	if(isset($_POST['email']))
	{
		$all_ok = true;
		
		$login = $_POST['login'];
		
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		if ((strlen($login)<3) || (strlen($login)>20))
		{
			$all_ok=false;
			$_SESSION['e_login']="Login musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($login)==false)
		{
			$all_ok=false;
			$_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$all_ok=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		if ((strlen($password1)<2) || (strlen($password1)>20))
		{
			$all_ok=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 2 do 20 znaków!";
		}
		
		if ($password1!=$password2)
		{
			$all_ok=false;
			$_SESSION['e_password']="Podane hasła nie są identyczne!";
		}
		
		$_SESSION['fr_login'] = $login;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		
		require_once "connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}else{
				
				$result = $connection->query("SELECT ID FROM uzytkownicy WHERE email='$email'");
				
				if(!$result) throw new Exception($connection->error);
				
				$how_many_mails = $result->num_rows;
				if($how_many_mails>0)
				{
					$all_ok=false;
					$_SESSION['e_email']="This e-mail is occupied!";
				}
				
				if($all_ok == true)
				{
					if($connection->query("INSERT INTO uzytkownicy VALUES (NULL, '$login', '$password1', '$email')"))
					{
						$_SESSION['completeregister']=true;
						header('Location: index.php');
					
					}else{
					throw new Exception($connection->error);
				}}
				
				$connection->close();
			}
		}
		catch(Exception $e)
		{
			echo 'Błąd! Spróbuj ponownie później!.';
			echo '<br />Developer info: '.$e;
		}
		
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
		<a href="index.php"><img src="img/logo.png" style="width: 150px; height: 150px;"></a><br />
		<form method="post">
			Login: <br />
			<input type="text" value="<?php
				if (isset($_SESSION['fr_login']))
				{
					echo $_SESSION['fr_login'];
					unset($_SESSION['fr_login']);
				}
			?>" name="login" /> <br />
			
			<?php
				if (isset($_SESSION['e_login']))
				{
					echo '<div class="error">'.$_SESSION['e_login'].'</div>';
					unset($_SESSION['e_login']);
				}
			?>
			
			E-mail: <br />
			<input type="text" value="<?php
				if (isset($_SESSION['fr_email']))
				{
					echo $_SESSION['fr_email'];
					unset($_SESSION['fr_email']);
				}
			?>" name="email" /> <br />
			
			<?php
				if (isset($_SESSION['e_email']))
				{
					echo '<div class="error">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);
				}
			?>
			
			
			Hasło: <br />
			<input type="password" value="<?php
				if (isset($_SESSION['fr_password1']))
				{
					echo $_SESSION['fr_password1'];
					unset($_SESSION['fr_password1']);
				}
			?>" name="password1" /> <br />
			
			<?php
				if (isset($_SESSION['e_password']))
				{
					echo '<div class="error">'.$_SESSION['e_password'].'</div>';
					unset($_SESSION['e_password']);
				}
			?>		
			
			Potwierdź hasło: <br />
			<input type="password" value="<?php
				if (isset($_SESSION['fr_password2']))
				{
					echo $_SESSION['fr_password2'];
					unset($_SESSION['fr_password2']);
				}
			?>" name="password2" /> <br />
			
			
			<input type="submit" value="Zarejestruj" />
				
		</form>
			
		<?php
			if(isset($_SESSION['error'])) echo $_SESSION['error'];
		?>

</body>
</html>