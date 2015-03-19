<html>

<head> 
	<title> Logged out </title>
</head>

<body>
<?php
require "header.php";
    session_destroy(); 
    echo 'logged out';  
    echo '<a href="index.php"> Go back to index </a> '; 
?>

</body>
</html>
