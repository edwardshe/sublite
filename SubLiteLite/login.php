<?php
include "functions.php";
include "MongoSingleton.php";

session_start(); //start session 
$error = ""; //to store error message

if (isset($_POST['submit'])){
	if (empty($_POST['username']) || empty($_POST['password'])){
		$error = "Username or Password is invalid";
	} else {
		//Posted the login form

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
			//Found a valid username
			
			//check if password is correct for user
			// possibly speed this up by searching the result of previous query
			$salt = "sublite";
			$userQuery["password"] = crypt($password,$salt); // add password field to user query
			$cursor = $users->find($userQuery);

			if ($cursor->count() > 0){
				//valid username and password combination found, authenticate user
				$_SESSION["username"] = $username; //initialize session variable
				header("location: profile.php");

			} else { 
				//valid username but not valid password

				$error = "Forgot password? Click <a href='recover.php'>here to recover your password</a>";

			}




		} else {
			//No username in database
			//redirect to registration page
			$error = "Not a valid username. <a href='register.php'>Register?</a>";
		}
	}
}


?>