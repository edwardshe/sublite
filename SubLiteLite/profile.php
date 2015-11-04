<?php

session_start();
//check if user is authenticated
if (isset($_SESSION['username'])){
	//session variable is set, user is authenticated
	echo "<h1>You are logged in </h1>";
	echo "<a href='index.php'>Log out</a><br>";

	echo "<a href='messages.php'>Messages</a>";

} else {

	//display error message or automatically redirect user to login.php?
	echo "<h1>You are not authenticated, please login<a href='index.php'> here</a></h1>";
}


?>