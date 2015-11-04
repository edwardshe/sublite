<?php

session_start();

include "functions.php";
include "MongoSingleton.php";

$error = ""; //to store error messages when registering

if (isset($_POST['submit'])){
	//user submitted a form

	$message = $_POST['message'];

	$conn = MongoSingleton::getMongoCon();
	$db = $conn->sublitelite;
	$users = $db->users;

	$sender = $_SESSION['username'];
	$receiver = "test";


	if($message != "")
	{
		$newMessage = array('$push' => array("messages" => array("sent" => $message, "createdAt" => new MongoDate())));
		$users->update(array("username" => $sender), $newMessage);
	}
}




?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<link href = "style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="" method="POST">
	<p>Message:</p>
	<textarea id="message" name="message" placeholder="Type Message Here" rows="5" cols="40"></textarea>
	<input name="submit" type = "submit" value="Send Message">
</form>
</body>
</html>