<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title></title>
</head>
  
<body>
<?php
require "header.php";
// redirect if already logged in 
if (isset($_SESSION['userID'])) {
	header('location: unauthorised.php');	 
}

function getUser() {
	$user = array();

	$user['userName'] = $_POST['userName']; 
	$user['password'] = $_POST['password'];
	
	// do error checking here
	
	
	$user['password'] = hash('sha512', $user['password']);
	
	// echo 'User: ' . $user['userName'] . 'and Password:' . $user['password'] . '<br />';
	
	return $user; 
}



function checkDatabase($user) {
	$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error' . mysql_error());
	 
	 $query = 
	 "SELECT userID, userName 
	  FROM users  
	  WHERE userName = '${user['userName']}' 
	  AND password = '{$user['password']}' ";
	 
	 $result = mysqli_query($connection,$query) or die('Error' . mysql_error());
	 // var_dump($result); // check what's in result e.g. echo for arrays
	 
	 if (mysqli_num_rows($result) == 1) { // check if succesfully logged in how many rows return 
		$row = mysqli_fetch_assoc($result); // places the results of the sql query into a row array 
		$_SESSION['userID'] = $row['userID']; 
		$_SESSION['userName'] = $row['userName'];
		// setcookie("userName", $_SESSION['userName'], time() +3600); 
		 header('location: index.php');	//redirect 
		 
		
	 }
	 	 
	 mysqli_close($connection);
	 
	 
}

checkDatabase(getUser()); 

if(!isset($_SESSION['userID'])){

echo '
<div class="well well-sm">
  <form class="form-horizontal" action="login.php" method="post">
  <fieldset>
    <legend class="text-center">Login</legend>

    <!-- Name input-->
    <div class="form-group">
      <label class="col-md-3 control-label" for="name">Username</label>
      <div class="col-md-9">
        <input id="username" name="userName" type="text" placeholder="Your User Name" class="form-control">
      </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
      <label class="col-md-3 control-label" for="password">Password</label>
      <div class="col-md-9">
      <input type="password" name="password" id="password"  placeholder="Your Password" class="form-control">
      </div>
    </div>

    <!-- Form actions -->
    <div class="form-group">
      <div class="col-md- text-center">
        <button type="submit" name="loginForm" class="btn btn-primary btn-lg">Sign In</button>
      </div> 
    </div>
  </fieldset>
  </form>
</div>';
} 
?> 

<!--
<form method= "post" action="login.php" name="loginForm"> 

	<label>Username:</label>
	<input type="text" name="userName" size="30"> <br />
	<label>Password:</label>
	<input type="password" name="password" size="30"> <br />
	<p><input type="submit" value="Login" name="login></p>
</form>';
-->

</body>
</html>
