<html>

<head> 
	<title> Logged out </title>
</head>

<body>
<?php
require "header.php";
include_once "include/helper_functions.php";

    session_destroy(); 
    echo successMessage("Success Message", 'You have succesfully logged out. <a href="index.php">Click here </a> to go back to the index page.</p>
');
?>

</body>
</html>
