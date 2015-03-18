<?php
//connect.php
$server = 'eu-cdbr-azure-west-b.cloudapp.net';
$username = 'b6526a64c19791';
$password = '5d020f59';
$database = 'comp3013';
// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
?>
