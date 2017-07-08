<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
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
	
	<div class="logo">
		<b>CHATapp</b>
	</div>
	<div class="container">
		<div class="users">
			<b><i>Zalogowani użytkownicy:</i></b>
			<br /><br />
			<?php
				require_once "connect.php";
				$conn = new mysqli($host, $db_user, $db_password, $db_name);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				$sql = "SELECT ID, login, email FROM uzytkownicy";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo "ID #".$row["ID"]."   ".$row["login"]."<br />".$row["email"]."<br /><br />";
					}
				} else {
					echo "0 results";
				}
				$conn->close();
			?> 
		</div>
		<div class="window">
			<div class="mwindow">
				<?php
				require_once "connect.php";

				$conn = new mysqli($host, $db_user, $db_password, $db_name);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

				$sql = "SELECT autor, tresc, czas FROM wiadomosci";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo $row["czas"]."<br />#".$row["autor"]." napisał: ".$row["tresc"]."<br /><br />";
					}
				} else {
					echo "0 results";
				}

				$conn->close();
				?> 
			</div>
			<div class="mbox">
				<form action="send.php" method="get">
					<textarea name="message" rows="5" style="width: 100%;"></textarea>
					<center><input type="submit"></center>
				</form>
			</div>
			
		</div>
		<div class="empty"></div>
	</div>
	
	<center><a href="logout.php">Wyloguj się!</a></center>

</body>
</html>