<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title></title>
</head>
  
<body>
<?php
require "header.php";
require_once "include/sql_model.php";
// redirect if already logged in 
if (isset($_SESSION['userID'])) {
	header('location: unauthorised.php?logged_in');	 
}


if (isset($_POST['loginForm'])) {
		$username = trim($_POST['username']); // trim whitespace
		$password = trim($_POST['password']); 		
		$sql_model = new SQL_Model();
		$success = FALSE;
		$success = $sql_model->login($username, $password);  
		$sql_model->close();
		if ($success == TRUE) {
			$sql_model2 = new SQL_Model();			
			$sql_model2->authenticateAdmin($_SESSION['userID']);
			$sql_model2->close();			
			header('location: index.php');	
		}
}

/* OLD FIRST LOGIN CODE 
function getUser() {
	$username = trim($_POST['useNname']); // trim whitespace
	$password = trim($_POST['password']); 

	
	// do error checking here
	
	
	$user['password'] = hash('sha512', $user['password']);
	
	// echo 'User: ' . $user['userName'] . 'and Password:' . $user['password'] . '<br />';
	
	return $user; 
}
function checkDatabase($user) {
	$connection = dbConnect(); 
	 
	 $query = 
	 "SELECT userID, userName 
	  FROM users  
	  WHERE userName = '${user['userName']}' 
	  AND password = '{$user['password']}' ";
	 
	 $result = mysqli_query($connection,$query) or die('Error' . mysqli_error());
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
*/

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
        <input id="username" name="username" type="text" placeholder="Your User Name" class="form-control">
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
