<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Create New User</title>
</head>
  
<body>
<?php
require "header.php";
/*
function isDataValid() {
	$errorMessage = null;
	if (!isset($_POST['firstName']) or trim($_POST['firstName']) == '')
	  $errorMessage = "You must enter your first name";
	if (!isset($_POST['lastName']) or trim($_POST['lastName']) == '')
	  $errorMessage .= "<p> You must enter your family name </p>";
	if ($errorMessage !== null)
	{
		 echo "<p>Error: $errorMessage</p>";
		//echo '<p>Error:' . $errorMessage . '</p>';
		return false;
	}
		return true;
} */ 

function getUser() {
	$user = array();
	$user['firstName'] = $_POST['firstName'];
	$user['lastName'] = $_POST['lastName'];
	$user['userName'] = $_POST['userName'];
	$user['password'] = $_POST['password'];
	$user['email'] = $_POST['email'];
	$user['groupID'] = $_POST['groupID'];
	
	$user['password'] = hash('sha512', $user['password']);
	
	return $user; 
}

function printUser($user) {
	echo "<p>First Name: ${user['firstName']}</p>";
	echo "<p>Last Name: ${user['lastName']}</p>";
	echo "<p>User Name: ${user['userName']}</p>";
	echo "<p>Email: ${user['email']}</p>";
	echo "<p>Group ID: ${user['groupID']}</p>";
}

function saveToDatabase($user) {
	$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error connecting to MySQL server.' . mysqli_error());
	$query = "INSERT INTO users (firstName, lastName, userName, password, email, groupID, joinedOn)".
	"VALUES ('${user['firstName']}','${user['lastName']}','${user['userName']}','${user['password']}',
	'${user['email']}','${user['groupID']}', NOW())";
	$result = mysqli_query($connection,$query)
	  or die('Error making saveToDatabase query' . mysqli_error());
	mysqli_close($connection);
}

// if (isDataValid()) {
	$newUser = getUser();
	saveToDatabase($newUser);
	echo "<h2>User Added </h2>";
	printUser($newUser);
?>

<p> 
  <a href="newuserform.html">Return to input form</a><br />
  <a href="index.php">Go to index</a>
</p>

</body>

</html>
