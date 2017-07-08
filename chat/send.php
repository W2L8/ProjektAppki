<?php
	require_once "connect.php";
	$conn = mysqli_connect($host, $db_user, $db_password, $db_name);
	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$message = $_GET['message'];
	$sql = "INSERT INTO wiadomosci VALUES (NULL, 1, '$message', NOW())";

	if (mysqli_query($conn, $sql)) 
	{
		header('Location: chat.php');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);
			
	

?>