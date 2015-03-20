<?php
require "header.php";
require_once 'include/helper_functions.php';

if (!isset($_SESSION['userID'])) {
  echo errorMessage("You are not logged in", 'Please <a href="login.php"> log in </a>');	
}

if (isset($_SESSION['userID']) && isset($_GET['logged_in'])) {
  echo errorMessage('You are already logged in', 'Go back to <a href="index.php"> Home </a>');
}

if(!isset($_SESSION['admin']) && isset($_GET['admin'])) {
	echo errorMessage("Unauthorised Access", 'You cannot access admin only pages. For any issues please <a href="contact.php">contact us</a>.');
}	

require "footer.php";
?>
