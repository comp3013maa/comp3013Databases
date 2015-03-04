<?php
ob_start(); // ignore, prevents errors when redirecting 

/* if session not already created, create it */
if(!isset($_SESSION))  {
	session_start(); // 
}  

/* If more than an hour since last activity, destroy session */
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}

/*  if session still active - update last activity to current time  */ 
$_SESSION['LAST_ACTIVITY'] = time(); 

if( isset ($_SESSION['username']) ) {
	echo ' 
	<form method="POST" action = "logout.php" name="logoutForm">
		<p>	<input type="submit" value = "logout"> </p> 
	</form> ';
} 

?>
