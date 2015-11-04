<?php

session_start();

include "functions.php";
include "MongoSingleton.php";

$error = ""; //to store error messages when registering

if (isset($_POST['submit'])){
	//user submitted a form

	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST["confirmpassword"])){
		
		$error = "Empty username or password field!";

	} else {

		//posted the login form with required fields

		//clean input

		$username = clean($_POST['username']);
		$password = clean($_POST['password']);

		//get instance of database
		$conn = MongoSingleton::getMongoCon();
		$db = $conn->sublitelite;
		$users = $db->users;

		//check if username is in Mongo Datbase

		$userQuery = array(
			'username' => $username
			);
		$cursor = $users->find($userQuery);

		if ($cursor->count() > 0){
			//username already exists
			$error = "$username already exists! Please try again.";
		}
		else {
			//username does not exist, create account with password
			$salt = "sublite";
			$userQuery["password"] = crypt($password,$salt);
			$result = $users->insert($userQuery);

			//initialize session and redirect user to profile
			$_SESSION['username'] = $username;
			header("location: profile.php");
		}
	}
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
	<label>Confirm Password : (Use javascript to validate this)</label>
	<input id = "confirmpassword" name="confirmpassword" placeholder="******" type = "password">
	<input name="submit" type = "submit" value=" Register ">
	<span><?php echo $error; ?></span>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>