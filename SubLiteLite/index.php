<?php

session_destroy();

if (isset($_SESSION['username'])) {
	header("location: profile.php");
} else {
	include "login.php";

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>User System</title>
	<link href = "style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="" method="POST">
	<label>UserName :</label>
	<input id="username" name="username" placeholder="username" type="text">
	<label>Password :</label>
	<input id = "password" name="password" placeholder="******" type = "password">
	<input name="submit" type = "submit" value=" Login ">
	<span><?php echo $error; ?></span>
</form>

<a href="register.php">Register</a>
</body>
</html>
