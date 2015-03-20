<?php
function dbConnect () {
	$host = 'eu-cdbr-azure-west-b.cloudapp.net'; 
	$user = 'b6526a64c19791'; 
	$pass = '5d020f59'; 
	$db = 'comp3013'; 
	// to change password, go into phpymyadmin, security and set one (look at lesson 5 php2 word ntoes)
	
	$connection = mysqli_connect($host, $user, $pass, $db);
	// or die("Can't connect to MySQL server: " . mysqli_error($conx) );
	if(!$connection) {
		trigger_error('Could not connect to MySQL:' . mysqli_connect_error() );
		// trigger_error uses our built in function in config.inc.php 
	}
	
	// mysqli_select_db($conx, $db ) or die("Can't select that database: " . mysqli_error($conx) ); - doing in mysqli_connect
	
	return $connection;
}

function closeDB($connection) {
    $connection->close();
}

?>
