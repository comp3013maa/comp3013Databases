<?php
//connect.php
$server = 'eu-cdbr-azure-west-b.cloudapp.net';
$username   = 'b6526a64c19791';
$password   = '5d020f59';
$database   = 'comp3013';
 
if(!mysql_connect($server, $username,  $password))
{
    exit('Error: could not establish database connection');
}
if(!mysql_select_db($database)
{
    exit('Error: could not select the database');
}
?>