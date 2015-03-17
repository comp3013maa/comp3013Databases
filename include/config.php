<?php
function DbConnect () {
	$host = 'localhost'; 
	$user = 'root'; 
	$pass = ''; 
	$db = 'mahikhan_mentorr'; 
	// to change password, go into phpymyadmin, security and set one (look at lesson 5 php2 word ntoes)
	
	$connection = mysqli_connect($host, $user, $pass, $db);
	// or die("Can't connect to MySQL server: " . mysqli_error($conx) );
	if(!$conx) {
		trigger_error('Could not connect to MySQL:' . mysqli_connect_error() );
		// trigger_error uses our built in function in config.inc.php 
	}
	
	// mysqli_select_db($conx, $db ) or die("Can't select that database: " . mysqli_error($conx) ); - doing in mysqli_connect
	
	return $conx;
}

function closeDB($conn) {
    $conn->close();
}

?>
